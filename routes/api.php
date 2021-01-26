<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'riders'], function () {
    Route::post('add', [RiderController::class, 'add']);
    Route::post('fetch', [RiderController::class, 'fetch']);
});

Route::group(['prefix' => 'branch'], function () {
    Route::post('add', [RiderController::class, 'add']);
    Route::post('fetch', [RiderController::class, 'fetch']);
    Route::post('fetch_all', [RiderController::class, 'fetch_all']);
});

Route::group(['prefix' => 'contacts'], function () {
    Route::post('store', [ContactController::class, 'store']);
    Route::post('fetch', [ContactController::class, 'fetch']);
    Route::post('update', [ContactController::class, 'update']);
});

// Parcels
Route::group(['prefix' => 'parcel'], function () {
    // Parcel Management
    Route::post('store', [ParcelController::class, 'store']);
    Route::post('fetch', [ParcelController::class, 'fetch']);
    Route::post('request_pickup', [ParcelController::class, 'request_pickup']);

    // Branch Offices/State Management
    Route::post('store_state', [ParcelController::class, 'store_state']);
    Route::post('fetch_states', [ParcelController::class, 'fetch_states']);
    Route::delete('delete_state', [ParcelController::class, 'delete_state']);
    Route::post('store_branch', [ParcelController::class, 'store_branch']);
    Route::post('fetch_branch', [ParcelController::class, 'fetch_branch']);

    // Parcel Categories Management Routes in the Parcel Route Group
    Route::group(['prefix' => 'category'], function () {
        Route::post('fetch', [ParcelController::class, 'fetch_category']);
        Route::post('store', [ParcelController::class, 'store_category']);
        Route::delete('delete', [ParcelController::class, 'delete_category']);
    });
});

// General Routes -> HomeController (Home)
Route::group(['prefix' => 'home'], function () {

});
