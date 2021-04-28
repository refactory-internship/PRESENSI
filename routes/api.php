<?php

use App\Http\Controllers\API\Employee\AbsentController;
use App\Http\Controllers\API\Employee\LeaveController;
use App\Http\Controllers\API\Employee\OvertimeController;
use App\Http\Controllers\API\Parent\ApproveAbsentController;
use App\Http\Controllers\API\Parent\ApproveAttendanceController;
use App\Http\Controllers\API\Parent\ApproveLeaveController;
use App\Http\Controllers\API\Parent\ApproveOvertimeController;
use App\Http\Controllers\API\PasswordController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\QRCodeController;
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

        //RESET PASSWORD ROUTES
        //SEND RESET PASSWORD EMAIL
        Route::post('/password', [PasswordController::class, 'sendEmailToAdmin'])
            ->name('password.email');
        //RESET PASSWORD
        Route::get('/password/{id}/{token}', [PasswordController::class, 'resetPassword'])
            ->name('password.reset');
        //END RESET PASSWORD ROUTES

        Route::middleware('auth:sanctum')->group(function () {
            //LOGOUT
            Route::post('/logout', [SanctumAuthController::class, 'logout'])
                ->name('logout');

            //PROFILE ROUTES
            Route::get('/profile', [ProfileController::class, 'show'])
                ->name('profile');
            Route::put('/profile/{user}', [ProfileController::class, 'update'])
                ->name('profile.update');
            Route::put('/profile/password/{user}', [ProfileController::class, 'updatePassword'])
                ->name('profile.password-update');
            //END PROFILE ROUTES
        });
    });
    //END OF AUTH ROUTES

    //USER/EMPLOYEE ROUTES
    Route::prefix('employee')->middleware(['auth:sanctum', 'api.attendanceAccess', 'api.employee'])->name('employee.')->group(function () {
        //STORE ATTENDANCE USING QRCODE
        Route::get('/QRCode/save_attendance/{token}', [QRCodeController::class, 'saveAttendance'])
            ->name('QRCode.save-attendance');

        //ATTENDANCE CRUD ROUTES
        Route::apiResource('/attendances', AttendanceController::class);
        //OVERTIME CRUD ROUTES
        Route::apiResource('/overtimes', OvertimeController::class);
        //ABSENT CRUD ROUTES
        Route::apiResource('/absents', AbsentController::class);
        //LEAVE CRUD ROUTES
        Route::resource('/leaves', LeaveController::class);

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
            Route::put('/approve-absents/{approve_absent}/approve', [ApproveAbsentController::class, 'approve'])
                ->name('approve-absents.approve');
            Route::put('/approve-absents/{approve_absent}/reject', [ApproveAbsentController::class, 'reject'])
                ->name('approve-absents.reject');

            Route::apiResource('/approve-absents', ApproveAbsentController::class);
            //END OF APPROVE/REJECT ABSENT ROUTES

            //APPROVE/REJECT LEAVE ROUTES
            Route::put('/approve-leaves/{approve_leave}/approve', [ApproveLeaveController::class, 'approve'])
                ->name('approve-leaves.approve');
            Route::put('/approve-leaves/{approve_leave}/reject', [ApproveLeaveController::class, 'reject'])
                ->name('approve-leaves.reject');

            Route::apiResource('/approve-leaves', ApproveLeaveController::class);
            //END OF APPROVE/REJECT ABSENT ROUTES
        });
        //END OF PARENT APPROVAL ROUTES
    });
    //END OF USER/EMPLOYEE ROUTES
});
