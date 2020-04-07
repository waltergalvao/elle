<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'domain',
        'linkedin_url',
        'twitter_url',
        'instagram_url',
        'facebook_url',
    ];

    /**
     * @return HasMany
     */
    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    /**
     * @return HasMany
     */
    public function locations() {
        return $this->hasMany(Location::class);
    }
}
