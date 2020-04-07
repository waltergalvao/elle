<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'is_generic_email',
        'email',
    ];

    /**
     * @return MorphMany
     */
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
