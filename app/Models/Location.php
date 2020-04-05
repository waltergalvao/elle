<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'phone_number',
        'city',
        'country',
        'address',
    ];

    /**
     * @return BelongsTo
     */
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
