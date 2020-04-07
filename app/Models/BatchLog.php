<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_email',
        'error',
        'status',
        'acknowledged',
    ];
}
