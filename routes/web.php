<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/api/viewSheet', [\App\Sheets\ContactExport::class, 'view'])->where('path', '^((?!api).)*$');
Route::get('{path}', [HomeController::class, 'index'])->where('path', '^((?!api).)*$');
