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
        return new ContactCollection(Contact::all());
    }
}
