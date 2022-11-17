<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;


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

//all listing
Route::get('/', [ListingController::class, 'index']);

//show create form
Route::get('/listings/create',[ListingController::class, 'create']);

//store listing
Route::post('/listings/',[ListingController::class, 'store']);

//show edit form
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit']);

//update listing
Route::put('listings/{listing}',[ListingController::class, 'update']);

//single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);




