<?php

namespace App\Models;

use App\Enums\BatchLogStatus;
use App\Jobs\ProcessBatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'data' => 'array',
        'is_processed' => 'boolean',
    ];

    /**
     * @return HasMany
     */
    public function logs()
    {
        return $this->hasMany(BatchLog::class);
    }

    /**
     * @return void
     */
    public function process() {
        ProcessBatch::dispatchNow($this);
    }

    /**
     * @param array $options
     * @return bool|void
     */
    public function save(array $options = []) {
        parent::save($options);
        $this->process();
    }

    /**
     * @return boolean
     */
    public function markAsProcessed() {
        $this->is_processed = true;
        return $this->save();
    }

    /**
     * @param string $contactEmail
     * @return Model
     */
    public function logImported(string $contactEmail) {
        return $this->logs()->create([
            'contact_email' => $contactEmail,
            'status' => BatchLogStatus::IMPORTED,
        ]);
    }

    /**
     * @param string $contactEmail
     * @return Model
     */
    public function logDuplicate(string $contactEmail) {
        return $this->logs()->create([
            'contact_email' => $contactEmail,
            'status' => BatchLogStatus::DUPLICATE,
        ]);
    }

    /**
     * @param string $contactEmail
     * @param string $errorMessage
     * @return Model
     */
    public function logError(string $contactEmail = null, string $errorMessage = null) {
        return $this->logs()->create([
            'contact_email' => $contactEmail,
            'status' => BatchLogStatus::ERROR,
            'error' => $errorMessage,
        ]);
    }
}
