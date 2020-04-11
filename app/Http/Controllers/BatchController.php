<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBatchRequest;
use App\Http\Resources\BatchCollection;
use App\Http\Resources\BatchResource;
use App\Models\Batch;

class BatchController extends Controller
{
    /**
     * @return BatchCollection
     */
    public function index()
    {
        return new BatchCollection(Batch::all());
    }

    /**
     * @param string $batchId
     * @return BatchResource
     */
    public function get(string $batchId)
    {
        $batch = Batch::with('logs')->find($batchId);

        return new BatchResource($batch);
    }

    /**
     * @param StoreBatchRequest $request
     * @return BatchResource
     */
    public function store(StoreBatchRequest $request)
    {
        $batch = new Batch([
            'name' => $request->get('name'),
            'data' => $request->get('data')
        ]);

        $batch->save();

        return new BatchResource($batch);
    }
}
