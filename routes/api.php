<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'riders'], function () {
    Route::post('add', [RiderController::class, 'add']);
    Route::post('fetch', [RiderController::class, 'fetch']);
    Route::post('fetch_photo', [RiderController::class, 'fetch_photo']);
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
    Route::post('asign_rider', [ParcelController::class, 'asign_rider']);
    Route::post('check_trackid', [ParcelController::class, 'check_trackid']);

    // Request Quotes 
    Route::post('request_quote', [ParcelController::class, 'request_quote']);
    Route::post('fetch_quote_request', [ParcelController::class, 'fetch_quote_request']);


    // Branch Offices/State Management
    Route::post('store_state', [ParcelController::class, 'store_state']);
    Route::post('fetch_states', [ParcelController::class, 'fetch_states']);
    Route::delete('delete_state', [ParcelController::class, 'delete_state']);
    Route::post('store_branch', [ParcelController::class, 'store_branch']);
    Route::post('fetch_branch', [ParcelController::class, 'fetch_branch']);

    // Pickup Reuest/Management
    Route::group(['prefix' => 'pickup'], function () {
        Route::post('/list', [ParcelController::class, 'pick_list']);
        Route::post('asign_rider', [ParcelController::class, 'asign_pickup_rider']);
    });

    // Parcel Categories Management Routes in the Parcel Route Group
    Route::group(['prefix' => 'category'], function () {
        Route::post('fetch', [ParcelController::class, 'fetch_category']);
        Route::post('store', [ParcelController::class, 'store_category']);
        Route::delete('delete', [ParcelController::class, 'delete_category']);
    });

    // Rider Parcel Route For Vue.js
    // /parcel/rider_parcel/fetch_list
    Route::group(['prefix' => 'rider_parcel'], function () {
        Route::post('fetch_list', [ParcelController::class, 'fetch_rider_parcel_list']);
        Route::post('decline', [ParcelController::class, 'decline_parcel']);
        Route::post('confirm', [ParcelController::class, 'confirm_parcel']);
    });
});

// General Routes -> HomeController (Home)
Route::group(['prefix' => 'home'], function () {

});

Route::post('login', [HomeController::class, 'login']);
Route::get('register', [HomeController::class, 'register']);
// Route::get('check-users', [HomeController::class, 'checkUsers']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/check-users', [HomeController::class, 'checkUsers']);
    Route::get('/logout', [HomeController::class, 'logout']);
    Route::post('/parcel_list', [HomeController::class, 'parcel_list']);
    Route::post('/decline', [HomeController::class, 'decline_parcel']);
    Route::post('/confirm', [HomeController::class, 'confirm_parcel']);
    Route::post('/update_parcel_status', [HomeController::class, 'update_parcel_status']);
});
