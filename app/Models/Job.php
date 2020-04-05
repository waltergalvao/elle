<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
        'is_voluntary',
        'company_id',
        'location_id',
    ];

    /**
     * @return BelongsTo
     */
    public function company() {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsTo
     */
    public function location() {
        return $this->belongsTo(Location::class);
    }
}
