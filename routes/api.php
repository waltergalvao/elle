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
    Route::get('contacts/{companyId}', [ContactController::class, 'get'])->name('contacts.get');
    Route::put('contacts/{companyId}', [ContactController::class, 'update'])->name('contacts.get');

    // Companies
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('companies/{companyId}', [CompanyController::class, 'get'])->name('companies.get');
    Route::put('companies/{companyId}', [CompanyController::class, 'update'])->name('companies.get');
});
