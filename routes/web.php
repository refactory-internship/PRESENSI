<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DeactivatedEmployeeController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TimeSettingController;
use App\Http\Controllers\UserController;
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

Route::get('/getCities/{id}', [LocationController::class, 'getCities'])->name('city');
Route::get('/getDistricts/{id}', [LocationController::class, 'getDistricts'])->name('district');
Route::get('/getVillages/{id}', [LocationController::class, 'getVillages'])->name('village');

Route::get('/getDivision/{id}', [UserController::class, 'getDivision'])->name('division');
Route::get('/getShift/{id}', [UserController::class, 'getShift'])->name('shift');
Route::get('/getParent/{office}/{division}', [UserController::class, 'getParent'])->name('parent');

Route::prefix('web')->name('web.')->middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('admin')->name('admin.')->middleware('web.admin')->group(function () {
        Route::resource('/offices', OfficeController::class);
        Route::resource('/divisions', DivisionController::class);
        Route::resource('/calendars', CalendarController::class)
            ->only(['create', 'store']);
        Route::resource('/roles', RoleController::class);
        Route::resource('/time-settings', TimeSettingController::class)
            ->except(['show']);
        Route::resource('users', UserController::class);

        Route::get('/deactivated', [DeactivatedEmployeeController::class, 'bin'])->name('deactivated-employees');
        Route::put('/deactivated/{id}', [DeactivatedEmployeeController::class, 'restore'])->name('deactivated-employees.restore');
        Route::delete('/deactivated/{id}', [DeactivatedEmployeeController::class, 'destroy'])->name('deactivated-employees.destroy');
    });
});
