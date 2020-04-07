<?php

namespace App\Jobs;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class EnrichCompany implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Contact
     */
    private $company;

    /**
     * EnrichContacts constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }


    /**
     * Execute the job.
     *
     * @return void
     * @throws \Illuminate\Contracts\Redis\LimiterTimeoutException
     */
    public function handle()
    {
        Redis::throttle('key')->allow(500)->every(60)->then(function () {
            if ($this->company->domain) {
                $response = Http
                    ::withHeaders([
                        'Authorization' => 'Bearer ',
                    ])
                    ->post('https://api.fullcontact.com/v3/company.enrich', [
                        'domain' => $this->company->domain
                    ]);
            } else {
                $response = Http
                    ::withHeaders([
                        'Authorization' => 'Bearer ',
                    ])
                    ->post('https://api.fullcontact.com/v3/company.search', [
                        'companyName' => $this->company->name
                    ]);
            }

            $this->company->fullcontact = $response->json();
            $this->company->save();
        }, function () {
            // Could not obtain lock...
            return $this->release(10);
        });
    }
}
