<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBatchRequest;
use App\Models\Batch;
use Illuminate\Database\Eloquent\Collection;

class BatchController extends Controller
{
    /**
     * @return Batch[]|Collection
     */
    public function index()
    {
        return Batch::all();
    }

    /**
     * @param StoreBatchRequest $request
     * @return Batch
     */
    public function store(StoreBatchRequest $request)
    {
        $batch = Batch::create([
            'name' => $request->get('name'),
            'data' => $request->get('data')
        ]);

        return $batch;
    }
}
