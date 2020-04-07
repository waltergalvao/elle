<?php
namespace App\Sheets;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContactExport implements FromView
{
    public function view(): View
    {
        $contacts = Contact
            ::whereNotNull('fullcontact')
            ->with('company')
            ->where('fullcontact', 'NOT LIKE', '%Profile not found%')
            ->get();

        return view('sheets.contacts', [
            'contacts' => $contacts
        ]);
    }
}
