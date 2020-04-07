<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email_provider',
        'linkedin_url',
        'is_work_email',
        'email',
        'notes',
        'fullcontact',
        'company_id',
    ];

    /**
     * @var array
     */
    public $casts = [
        'is_work_email' => 'bool',
        'fullcontact' => 'array',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($contact) {
            $emailPieces = explode('@', $contact->email);
            $contact->email = strtolower($contact->email);
            $contact->email_provider = $emailPieces[1];
            $contact->is_work_email = in_array($contact->email_provider, [
                'hotmail.com',
                'gmail.com',
                'live.com',
                'me.com',
                'hotmail.com',
                'yahoo.com',
                'shaw.ca',
            ]) === false;
        });
    }

    /**
     * @return BelongsTo
     */
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
