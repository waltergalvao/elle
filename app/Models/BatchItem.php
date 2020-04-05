<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_email',
        'status',
        'error_reason',
        'acknowledged',
    ];
}
