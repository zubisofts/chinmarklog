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

Route::group(['prefix' => 'parcel'], function () {
    Route::post('request_pickup', [ParcelController::class, 'request_pickup']);

    // Parcel Categories Management Routes in the Parcel Route Group
    Route::group(['prefix' => 'category'], function () {
        Route::post('fetch', [ParcelController::class, 'fetch_category']);
    });
});
