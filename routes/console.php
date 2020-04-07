<?php

use App\Jobs\EnrichCompany;
use App\Jobs\EnrichContact;
use App\Models\Company;
use App\Models\Contact;
use App\Sheets\ContactExport;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('contacts:enrich', function () {
    $contacts = Contact
        ::whereNull('fullcontact')
        ->orderBy('id', 'ASC')
        ->limit(1000)
        ->get();

    foreach ($contacts as $contact) {
        EnrichContact::dispatch($contact);
    }
})->describe('Enrich Contacts');


Artisan::command('contacts:export', function () {
    Excel::store(new ContactExport(), 'contacts.csv');
})->describe('Enrich Contacts');


Artisan::command('contacts:create_companies', function () {
    $contacts = Contact::all();

    foreach ($contacts as $contact) {
        $companyName = $contact->fullcontact['organization'] ?? null;
        $domain = null;

        if ($contact->is_work_email) {
            $domain = $contact->email_provider;
        }

        if (!$companyName && !$domain) {
            continue;
        }

        if ($domain) {
            $data = [
                'domain' => $domain,
            ];

            if ($companyName) {
                $data['name'] = $companyName;
            }

            $company = Company::updateOrCreate(
                [
                    'domain' => $domain
                ],
                $data
            );
        } else {
            $company = Company::updateOrCreate(
                [
                    'name' => $companyName
                ],
                [
                    'name' => $companyName
                ]
            );
        }

        $contact->company_id = $company->id;
        $contact->save();
    }
})->describe('Create companies');


Artisan::command('companies:enrich', function () {
    $contacts = Company
        ::whereNull('fullcontact')
        ->whereNull('domain')
        ->orderBy('id', 'ASC')
        ->get();

    foreach ($contacts as $contact) {
        EnrichCompany::dispatch($contact);
    }
})->describe('Enrich Contacts');
