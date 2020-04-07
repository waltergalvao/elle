<?php

namespace App\Http\Resources;

use App\Enums\BatchLogStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'is_processed' => $this->resource->is_processed,
            'created_at' => $this->resource->created_at,
        ];

        if ($this->resource->logs) {
            $data['logs']['acknowledge'] = $this->resource->logs->where('status', '!=', BatchLogStatus::IMPORTED)->toArray();
            $data['logs']['imported'] = $this->resource->logs->where('status', BatchLogStatus::IMPORTED)->count();
        }

        return $data;
    }
}
