<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'data',
        'is_processed',
    ];

    /**
     * @var array
     */
    public $casts = [
        'data' => 'array'
    ];

    public function process() {

    }
}
