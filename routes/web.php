<?php

use App\Http\Controllers\Employee\AbsentController;
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
use App\Http\Controllers\Employee\LeaveController;
use App\Http\Controllers\Employee\OvertimeController;
use App\Http\Controllers\Parent\ApproveAbsentController;
use App\Http\Controllers\Parent\ApproveAttendanceController;
use App\Http\Controllers\Parent\ApproveLeaveController;
use App\Http\Controllers\Parent\ApproveOvertimeController;
use App\Http\Controllers\ProfileController;
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

//LOCATION DEPENDENT DROPDOWN AXIOS ROUTES
Route::get('/getCities/{id}', [LocationController::class, 'getCities'])
    ->name('city');
Route::get('/getDistricts/{id}', [LocationController::class, 'getDistricts'])
    ->name('district');
Route::get('/getVillages/{id}', [LocationController::class, 'getVillages'])
    ->name('village');

//PARENT DEPENDENT DROPDOWN AXIOS ROUTES
Route::get('/getDivision/{id}', [UserController::class, 'getDivision'])
    ->name('division');
Route::get('/getShift/{id}', [UserController::class, 'getShift'])
    ->name('shift');
Route::get('/getParent/{office}/{division}', [UserController::class, 'getParent'])
    ->name('parent');

Route::prefix('web')->name('web.')->middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');
    //PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])
        ->name('profile.password');
    Route::put('/profile/password/{user}', [ProfileController::class, 'updatePassword'])
        ->name('profile.password-update');

    //ADMIN MASTER-CRUD ROUTES
    Route::prefix('admin')->name('admin.')->middleware('web.admin')->group(function () {
        //OFFICE CRUD ROUTES
        Route::resource('/offices', OfficeController::class);
        //DIVISION CRUD ROUTES
        Route::resource('/divisions', DivisionController::class);
        //CALENDAR CRUD ROUTES
        Route::resource('/calendars', CalendarController::class)
            ->only(['create', 'store']);
        //ROLES CRUD ROUTES
        Route::resource('/roles', RoleController::class);
        //TIME SETTING CRUD ROUTES
        Route::resource('/time-settings', TimeSettingController::class)
            ->except(['show']);
        //USER/EMPLOYEE CRUD ROUTES
        Route::resource('/users', UserController::class);

        //DEACTIVATED EMPLOYEE ROUTES
        Route::get('/deactivated', [DeactivatedEmployeeController::class, 'bin'])
            ->name('deactivated-employees');
        Route::put('/deactivated/{id}', [DeactivatedEmployeeController::class, 'restore'])
            ->name('deactivated-employees.restore');
        Route::delete('/deactivated/{id}', [DeactivatedEmployeeController::class, 'destroy'])
            ->name('deactivated-employees.destroy');

        //QRCODE ROUTES
        Route::get('/QRCode/create', [QRCodeController::class, 'create'])
            ->name('QRCode.create');
        Route::get('/QRCode/generate', [QRCodeController::class, 'generateQRCode'])
            ->name('QRCode.generate');
    });
    //END OF ADMIN MASTER-CRUD ROUTES

    //USER/EMPLOYEE ROUTES
    Route::prefix('employee')->name('employee.')->middleware(['web.employee', 'web.attendanceAccess'])->group(function () {
        //ATTENDANCE ROUTES
        Route::resource('/attendances', AttendanceController::class);
        //OVERTIME ROUTES
        Route::resource('/overtimes', OvertimeController::class);
        //ABSENT ROUTES
        Route::resource('/absents', AbsentController::class);
        //LEAVE ROUTES
        Route::resource('/leaves', LeaveController::class);

        //PARENT APPROVAL ROUTES
        Route::middleware(['web.approveAttendance', 'web.parentAccess'])->group(function () {
            //APPROVE/REJECT ATTENDANCE ROUTES
            Route::put('/approve-attendance/{approve_attendance}/approve', [ApproveAttendanceController::class, 'approve'])
                ->name('approve-attendances.approve');
            Route::put('/approve-attendance/{approve_attendance}/reject', [ApproveAttendanceController::class, 'reject'])
                ->name('approve-attendances.reject');

            Route::resource('/approve-attendances', ApproveAttendanceController::class)
                ->only(['index', 'show']);
            //END OF APPROVE/REJECT ATTENDANCE ROUTES

            //APPROVE/REJECT OVERTIME ROUTES
            Route::put('/approve-overtimes/{approve_overtime}/approve', [ApproveOvertimeController::class, 'approve'])
                ->name('approve-overtimes.approve');
            Route::put('/approve-overtimes/{approve_overtime}/reject', [ApproveOvertimeController::class, 'reject'])
                ->name('approve-overtimes.reject');

            Route::resource('/approve-overtimes', ApproveOvertimeController::class)
                ->only(['index', 'show']);
            //END OF APPROVE/REJECT OVERTIME ROUTES

            //APPROVE/REJECT ABSENT ROUTES
            Route::put('/approve-absents/{approve_absent}/approve', [ApproveAbsentController::class, 'approve'])
                ->name('approve-absents.approve');
            Route::put('/approve-absents/{approve_absent}/reject', [ApproveAbsentController::class, 'reject'])
                ->name('approve-absents.reject');

            Route::resource('/approve-absents', ApproveAbsentController::class)
                ->only(['index', 'show']);
            //END OF APPROVE/REJECT ABSENT ROUTES

            //APPROVE/REJECT LEAVE ROUTES
            Route::put('/approve-leaves/{approve_leaves}/approve', [ApproveLeaveController::class, 'approve'])
                ->name('approve-leaves.approve');
            Route::put('/approve-leaves/{approve_leaves}/reject', [ApproveLeaveController::class, 'reject'])
                ->name('approve-leaves.reject');

            Route::resource('/approve-leaves', ApproveLeaveController::class)
                ->only(['index', 'show']);
            //END OF APPROVE/REJECT LEAVE ROUTES
        });
        //END OF PARENT APPROVAL ROUTES
    });
    //END OF USER/EMPLOYEE ROUTES
});
