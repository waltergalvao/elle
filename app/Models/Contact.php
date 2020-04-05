<?php

namespace App\Models;

use SocialNetwork;
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
        'email',
    ];

    /**
     * @return MorphMany
     */
    public function socialNetworks() {
        return $this->morphMany(SocialNetwork::class, 'owner');
    }
}
