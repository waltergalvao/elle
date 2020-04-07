<?php

namespace App\Jobs;

use App\Models\Batch;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ProcessBatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Batch
     */
    private $batch;

    /**
     * Create a new job instance.
     *
     * @param Batch $batch
     */
    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        collect($this->batch->data)
            ->unique('email')
            ->each(function ($data) {
                $this->importContact(
                    Arr::get($data, 'email'),
                    Arr::get($data, 'first_name'),
                    Arr::get($data, 'last_name')
                );
            });

        $this->batch->markAsProcessed();
    }

    /**
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     */
    private function importContact(string $email = null, string $firstName = null, string $lastName = null) {
        if ($email === null) {
            $this->batch->logError(null, 'A row without email was found');
            return;
        }

        if (Contact::where('email', $email)->exists()) {
            $this->batch->logDuplicate($email);
            return;
        }

        if ($this->emailIsValid($email) === false) {
            $this->batch->logError($email, 'Invalid email');
            return;
        }

        Contact::create([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName
        ]);

        $this->batch->logImported($email);
    }

    /**
     * @param $email
     * @return bool
     */
    private function emailIsValid($email) {
        $validator = Validator::make(
            ['email' => $email],
            ['email' => 'email']
        );

        return $validator->fails() === false;
    }

    private function isWorkEmail()

}
