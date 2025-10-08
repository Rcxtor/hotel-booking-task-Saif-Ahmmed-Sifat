<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

// Home page route
route::get('/', [WelcomeController::class, 'index'])->name('welcome'); 

// Bokking page route
route::get('/book', [BookingController::class, 'index'])->name('booking.index');

route::post('/book/check', [BookingController::class, 'check'])->name('booking.check');

route::get('/book/store/{room_category}', [BookingController::class, 'book'])->name('booking.book');

route::post('/book/store/', [BookingController::class, 'store'])->name('booking.store');

// route::get('/book/thanks', [BookingController::class, 'invoice'])->name('booking.invoice');
Route::get('/book/thanks/{booking}', [BookingController::class, 'invoice'])->name('booking.invoice');







