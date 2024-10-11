<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::post('/search', [SearchController::class, 'hotels'])->name('search.index');
Route::get('/order/{id}/rates/{hotel}', [SearchController::class, 'rates'])->name('search.rates');
Route::get('/order/{id}/room/{hash}/add', [BookingController::class, 'room'])->name('booking.room');
Route::get('/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/payment', [BookingController::class, 'payment'])->name('booking.payment');
Route::get('/success/{pnr}', [BookingController::class, 'success'])->name('booking.success');

Route::get('/manage-booking', function() {
    return view('booking.index');
})->name('booking.manage.index');
Route::post('/manage-booking', [BookingController::class, 'manage'])->name('booking.manage');

Route::get('/start', [SearchController::class, 'splash'])->name('booking.start');

Route::get('/destination/paris', function() {
    return view('search.destination.paris');
})->name('page.destination');

Route::get('/destination/orlando', function() {
    return view('search.destination.orlando');
})->name('page.destination');

Route::get('/destination/anaheim', function() {
    return view('search.destination.paris');
})->name('page.destination');
