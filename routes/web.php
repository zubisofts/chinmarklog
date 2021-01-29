<?php

use Illuminate\Support\Facades\Route;


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
    return Inertia\Inertia::render('HomePage');
})->name('tracking');

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
    })->name('feedback');
    
    Route::get('/Manage-Offices', function () {
        return Inertia\Inertia::render('BranchPage');
    })->name('branch');
    
    Route::get('/Tester', ['App\Http\Controllers\NotificationController', 'fetch']);
    
});
