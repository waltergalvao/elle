<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SocialNetwork extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'url',
    ];

    /**
     * @return MorphTo
     */
    public function owner() {
        return $this->morphTo();
    }
}
