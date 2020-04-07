<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => []
], function () {
    // Batches
    Route::get('batches', [BatchController::class, 'index'])->name('batches.index');
    Route::get('batches/{batchId}', [BatchController::class, 'get'])->name('batches.get');
    Route::post('batches', [BatchController::class, 'store'])->name('batches.store');

    // Contacts
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');

    // Companies
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
});
