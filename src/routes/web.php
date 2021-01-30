<?php

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

Route::get('/', 'MovieController@index');

Route::get('/movie/{slug}', 'MovieController@show');
Route::get('/get-show-time/{location_id}/movie/{movie_id}', 'MovieController@getShowTime');
Route::get('/get-available-seat/{location_id}/show/{show_id}', 'MovieController@getAvailableSeat');

Route::post('/booking-next-step', 'BookingController@create');
Route::get('/booking-next-step', 'BookingController@create');
Route::get('/booking-confirmation', 'BookingController@confirmation')->middleware('auth');
Route::get('/my-booking', 'BookingController@index')->middleware('auth');

Route::get('/booking-cancelation/{reference_number}', 'BookingController@cancel')->middleware('auth');

Route::post('/logged_in', 'CustomLoginController@authenticate')->name('logged_in');

Route::get('home', function () {
	return view('home');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
