<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'website',
    ];

    /**
     * @return MorphMany
     */
    public function socialNetworks() {
        return $this->morphMany(SocialNetwork::class, 'owner');
    }

    /**
     * @return HasMany
     */
    public function locations() {
        return $this->hasMany(Location::class);
    }
}
