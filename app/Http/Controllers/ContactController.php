<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

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
     * @param string $contactId
     * @return ContactResource
     */
    public function get(string $contactId)
    {
        $contact = Contact::with('company')->find($contactId);

        return new ContactResource($contact);
    }

    /**
     * @param string $contactId
     * @param Request $request
     * @return ContactResource
     */
    public function update(string $contactId, Request $request)
    {
        $contact = Contact::findOrFail($contactId);
        $contact->fill($request->all());
        $contact->save();

        return new ContactResource($contact);
    }
}
