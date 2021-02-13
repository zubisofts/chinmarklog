<?php

use Illuminate\Support\Facades\Route;


Route::get('/services-worker', function () {
    return asset('/service-worker.js');
});

Route::get('/', function () {
    return Inertia\Inertia::render('HomePage');
})->name('home');

Route::get('/about', function () {
    return Inertia\Inertia::render('AboutPage');
})->name('about');

Route::get('/services', function () {
    return Inertia\Inertia::render('ServicesPage');
})->name('services');

Route::get('/faq', function () {
    return Inertia\Inertia::render('FaqPage');
})->name('faq');

Route::get('/reviews', function () {
    return Inertia\Inertia::render('HomePage');
})->name('reviews');

Route::get('/contact', function () {
    return Inertia\Inertia::render('ContactPage');
})->name('contact');

Route::get('/tracking', function () {
    return Inertia\Inertia::render('TrackingPage');
})->name('tracking');

Route::get('/parceldetails', function () {
    return Inertia\Inertia::render('ParcelDetailsPage');
})->name('perceldetails');

// Action Buttons Routes
Route::get('/request-quote', function () {
    return Inertia\Inertia::render('QuotePage');
})->name('quote');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/Riders-Management', function () {
        return Inertia\Inertia::render('RidersPage');
    })->name('riders');

    Route::get('/Manage-Parcels', function () {
        return Inertia\Inertia::render('ParcelPage');
    })->name('parcels');

    Route::get('/Manage-Feedbacks', function () {
        return Inertia\Inertia::render('FeedbackPage');
    })->name('feedbacks');
    
    Route::get('/Manage-Offices', function () {
        return Inertia\Inertia::render('BranchPage');
    })->name('branch');

    Route::get('/Parcels', function () {
        return Inertia\Inertia::render('RiderParcelPage');
    })->name('rider_parcel');
    
    Route::get('/Manage-Instant-Pickups', function () {
        return Inertia\Inertia::render('PickupRequestPage');
    })->name('pickups');
    
    Route::get('/Instant-Pickups', function () {
        return Inertia\Inertia::render('RiderPickupPage');
    })->name('pickups');
    
    Route::get('/Manage-Requested-Quotes', function () {
        return Inertia\Inertia::render('QuoteFeedbackPage');
    })->name('quote_feedback');
    
    Route::get('/Tester', ['App\Http\Controllers\NotificationController', 'fetch']);
    
});
