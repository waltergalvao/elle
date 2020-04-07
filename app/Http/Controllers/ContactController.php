<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactCollection;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * @return ContactCollection
     */
    public function index()
    {
        $contacts = Contact
            ::orderBy('is_work_email', 'DESC')
            ->orderBy('first_name')
            ->get();

        return new ContactCollection($contacts);
    }

    /**
     * @param string $companyId
     * @return CompanyResource
     */
    public function get(string $contactId)
    {
        $contact = Contact::with('company')->find($contactId);

        return new ContactResource($contact);
    }

    /**
     * @param string $companyId
     * @param Request $request
     * @return ContactResource
     */
    public function update(string $companyId, Request $request)
    {
        $contact = Contact::findOrFail($contactId);
        $contact->fill($request->all());
        $contact->save();

        return new ContactResource($contact);
    }
}
