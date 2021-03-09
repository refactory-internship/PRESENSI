<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/getCities/{id}', [\App\Http\Controllers\LocationController::class, 'getCities'])->name('city');
Route::get('/getDistricts/{id}', [\App\Http\Controllers\LocationController::class, 'getDistricts'])->name('district');
Route::get('/getVillages/{id}', [\App\Http\Controllers\LocationController::class, 'getVillages'])->name('village');

Route::prefix('web')->name('web.')->middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/offices', \App\Http\Controllers\OfficeController::class);
    Route::resource('/divisions', \App\Http\Controllers\DivisionController::class);
    Route::resource('/calendars', \App\Http\Controllers\CalendarController::class)
    ->except(['index']);
});
