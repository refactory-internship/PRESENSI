<?php

use App\Http\Controllers\API\Employee\AbsentController;
use App\Http\Controllers\API\Employee\OvertimeController;
use App\Http\Controllers\API\Parent\ApproveAbsentController;
use App\Http\Controllers\API\Parent\ApproveAttendanceController;
use App\Http\Controllers\API\Parent\ApproveOvertimeController;
use App\Http\Controllers\API\SanctumAuthController;
use App\Http\Controllers\API\Employee\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->group(function () {
    //AUTH ROUTES
    Route::prefix('auth')->name('auth.')->group(function () {
        //LOGIN
        Route::post('/login', [SanctumAuthController::class, 'login'])
            ->name('login');
        //GET USER'S PROFILE ROUTE TEST
        Route::get('/me', function () {
            return auth()->user();
        })->name('me')->middleware('auth:sanctum');
        //LOGOUT
        Route::post('/logout', [SanctumAuthController::class, 'logout'])
            ->name('logout')->middleware('auth:sanctum');
    });
    //END OF AUTH ROUTES

    //USER/EMPLOYEE ROUTES
    Route::prefix('employee')->middleware(['auth:sanctum', 'api.attendanceAccess', 'api.employee'])->name('employee.')->group(function () {
        //ATTENDANCE CRUD ROUTES
        Route::apiResource('/attendances', AttendanceController::class);
        //OVERTIME CRUD ROUTES
        Route::apiResource('/overtimes', OvertimeController::class);
        //ABSENT CRUD ROUTES
        Route::apiResource('/absents', AbsentController::class);

        //PARENT APPROVAL ROUTES
        Route::middleware(['api.approveAttendance', 'api.parentAccess'])->group(function () {
            //APPROVE/REJECT ATTENDANCE ROUTES
            Route::put('/approve-attendances/{approve_attendance}/approve', [ApproveAttendanceController::class, 'approve'])
                ->name('approve-attendances.approve');
            Route::put('/approve-attendances/{approve_attendance}/reject', [ApproveAttendanceController::class, 'reject'])
                ->name('approve-attendances.reject');

            Route::apiResource('/approve-attendances', ApproveAttendanceController::class)
                ->only(['index', 'show']);
            //END OF APPROVE/REJECT ATTENDANCE ROUTES

            //APPROVE/REJECT OVERTIME ROUTES
            Route::put('/approve-overtimes/{approve_overtime}/approve', [ApproveOvertimeController::class, 'approve'])
                ->name('approve-overtimes.approve');
            Route::put('/approve-overtimes/{approve_overtime}/reject', [ApproveOvertimeController::class, 'reject'])
                ->name('approve-overtimes.reject');

            Route::apiResource('/approve-overtimes', ApproveOvertimeController::class)
                ->only(['index', 'show']);
            //END OF APPROVE/REJECT OVERTIME ROUTES

            //APPROVE/REJECT ABSENT ROUTES
            Route::put('/approve-absents/{approve_absents}/approve', [ApproveAbsentController::class, 'approve'])
                ->name('approve-absents.approve');
            Route::put('/approve-absents/{approve_absents}/reject', [ApproveAbsentController::class, 'reject'])
                ->name('approve-absents.reject');

            Route::apiResource('/approve-absents', ApproveAbsentController::class);
            //END OF APPROVE/REJECT ABSENT ROUTES
        });
        //END OF PARENT APPROVAL ROUTES
    });
    //END OF USER/EMPLOYEE ROUTES
});
