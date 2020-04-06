<?php

use App\Http\Controllers\BatchController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => []
], function () {
    // Batches
    Route::get('batches', [BatchController::class, 'index']);
    Route::post('batches', [BatchController::class, 'store']);
});
