<?php

use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\DeactivatedEmployeeController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\QRCodeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TimeSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\OvertimeController;
use App\Http\Controllers\Parent\ApproveAttendanceController;
use App\Http\Controllers\Parent\ApproveOvertimeController;
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

Route::get('/getCities/{id}', [LocationController::class, 'getCities'])
    ->name('city');
Route::get('/getDistricts/{id}', [LocationController::class, 'getDistricts'])
    ->name('district');
Route::get('/getVillages/{id}', [LocationController::class, 'getVillages'])
    ->name('village');

Route::get('/getDivision/{id}', [UserController::class, 'getDivision'])
    ->name('division');
Route::get('/getShift/{id}', [UserController::class, 'getShift'])
    ->name('shift');
Route::get('/getParent/{office}/{division}', [UserController::class, 'getParent'])
    ->name('parent');

Route::prefix('web')->name('web.')->middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    Route::prefix('admin')->name('admin.')->middleware('web.admin')->group(function () {
        Route::resource('/offices', OfficeController::class);
        Route::resource('/divisions', DivisionController::class);
        Route::resource('/calendars', CalendarController::class)
            ->only(['create', 'store']);
        Route::resource('/roles', RoleController::class);
        Route::resource('/time-settings', TimeSettingController::class)
            ->except(['show']);
        Route::resource('/users', UserController::class);

        Route::get('/deactivated', [DeactivatedEmployeeController::class, 'bin'])
            ->name('deactivated-employees');
        Route::put('/deactivated/{id}', [DeactivatedEmployeeController::class, 'restore'])
            ->name('deactivated-employees.restore');
        Route::delete('/deactivated/{id}', [DeactivatedEmployeeController::class, 'destroy'])
            ->name('deactivated-employees.destroy');

        Route::get('/QRCode/create', [QRCodeController::class, 'create'])
            ->name('QRCode.create');
        Route::get('/QRCode/generate', [QRCodeController::class, 'generateQRCode'])
            ->name('QRCode.generate');
    });

    Route::prefix('employee')->name('employee.')->middleware(['web.employee', 'web.attendanceAccess'])->group(function () {
        Route::resource('/attendances', AttendanceController::class);
        Route::resource('/overtimes', OvertimeController::class);

        Route::middleware(['web.approveAttendance', 'web.parentAccess'])->group(function () {
            Route::put('/approve-attendance/{approve_attendance}/approve', [ApproveAttendanceController::class, 'approve'])
                ->name('approve-attendances.approve');
            Route::put('/approve-attendance/{approve_attendance}/reject', [ApproveAttendanceController::class, 'reject'])
                ->name('approve-attendances.reject');

            Route::resource('/approve-attendances', ApproveAttendanceController::class)
                ->only(['index', 'show']);

            Route::put('/approve-overtimes/{approve_overtime}/approve', [ApproveOvertimeController::class, 'approve'])
                ->name('approve-overtimes.approve');
            Route::put('/approve-overtimes/{approve_overtime}/reject', [ApproveOvertimeController::class, 'reject'])
                ->name('approve-overtimes.reject');

            Route::resource('/approve-overtimes', ApproveOvertimeController::class)
                ->only(['index', 'show']);
        });
    });
});
