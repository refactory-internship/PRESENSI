<?php

use App\Http\Controllers\API\Employee\OvertimeController;
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
    //auth routes
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('/login', [SanctumAuthController::class, 'login'])
            ->name('login');

        Route::get('/me', function () {
            return auth()->user();
        })->name('me')->middleware('auth:sanctum');

        Route::post('/logout', [SanctumAuthController::class, 'logout'])
            ->name('logout')->middleware('auth:sanctum');
    });

    Route::prefix('employee')->middleware(['auth:sanctum', 'api.attendanceAccess', 'api.employee'])->name('employee.')->group(function () {
        Route::apiResource('/attendances', AttendanceController::class);
        Route::apiResource('/overtimes', OvertimeController::class);

        Route::middleware(['api.approveAttendance', 'api.parentAccess'])->group(function () {
            Route::put('/approve-attendances/{approve_attendance}/approve', [ApproveAttendanceController::class, 'approve'])
                ->name('approve-attendances.approve');
            Route::put('/approve-attendances/{approve_attendance}/reject', [ApproveAttendanceController::class, 'reject'])
                ->name('approve-attendances.reject');

            Route::apiResource('/approve-attendances', ApproveAttendanceController::class)
                ->only(['index', 'show']);

            Route::put('/approve-overtimes/{approve_overtime}/approve', [ApproveOvertimeController::class, 'approve'])
                ->name('approve-overtimes.approve');
            Route::put('/approve-overtimes/{approve_overtime}/reject', [ApproveOvertimeController::class, 'reject'])
                ->name('approve-overtimes.reject');

            Route::apiResource('/approve-overtimes', ApproveOvertimeController::class)
                ->only(['index', 'show']);
        });
    });
});
