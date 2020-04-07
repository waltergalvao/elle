<?php

namespace App\Jobs;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class EnrichContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * EnrichContacts constructor.
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
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
            $data = [
                'emails' => [
                    $this->contact->email,
                ],
            ];

            if (!empty($this->contact->first_name) && !empty($this->contact->last_name)) {
                $data['name'] =  [
                    'given' => $this->contact->first_name,
                    'family' => $this->contact->last_name,
                ];
            }

            $response = Http
                ::withHeaders([
                    'Authorization' => 'Bearer ',
                ])
                ->post('https://api.fullcontact.com/v3/person.enrich', $data);

            $this->contact->fullcontact = $response->json();

            $this->contact->save();
        }, function () {
            // Could not obtain lock...
            return $this->release(10);
        });

    }
}
