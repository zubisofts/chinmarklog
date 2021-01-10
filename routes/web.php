<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return Inertia\Inertia::render('HomePage');
})->name('home');

Route::get('/about', function () {
    return Inertia\Inertia::render('HomePage');
})->name('about');

Route::get('/services', function () {
    return Inertia\Inertia::render('HomePage');
})->name('services');

Route::get('/faq', function () {
    return Inertia\Inertia::render('HomePage');
})->name('faq');

Route::get('/reviews', function () {
    return Inertia\Inertia::render('HomePage');
})->name('reviews');

Route::get('/contact', function () {
    return Inertia\Inertia::render('HomePage');
})->name('contact');

Route::get('/tracking', function () {
    return Inertia\Inertia::render('HomePage');
})->name('tracking');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
