<?php


namespace App\Http\Services;


use App\Enums\ApprovalStatus;
use App\Enums\AttendanceApprover;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QRCodeService
{
    private $dateTimeService;

    public function __construct(DateTimeService $dateTimeService)
    {
        $this->dateTimeService = $dateTimeService;
    }

    public function generateToken()
    {
        $token = '';
        for ($i = 0; $i < 5; $i++) {
            $token .= chr(rand(ord('a'), ord('z')));
        }

        DB::table('qr_tokens')->truncate();
        DB::table('qr_tokens')->insert([
            'token' => $token
        ]);

        return $token;
    }

    public function stopQRCode()
    {
        return DB::table('qr_tokens')->truncate();
    }

    public function getTokenFromDB($token)
    {
        return DB::table('qr_tokens')
            ->where('token', $token)
            ->value('token');
    }

    public function saveQRAttendance()
    {
        $user = User::query()->find(auth()->id());
        $timeToday = $this->dateTimeService->getCurrentDate();
        $calendar = $this->dateTimeService->getDateFromDatabase();
        $ipAddress = geoip()->getLocation(getenv(('HTTP_CLIENT_IP')));
        $gps_lat = $ipAddress->lat;
        $gps_long = $ipAddress->lon;

        if ($user->isAutoApproved === true) {
            $approvedBy = AttendanceApprover::SYSTEM;
            $approverId = null;
            $approvalStatus = ApprovalStatus::APPROVED;
        } else {
            $approvedBy = AttendanceApprover::PARENT;
            $approverId = $user->parent->id;
            $approvalStatus = null;
        }

        cache()->forget('attendance.all');

        return Attendance::query()->create([
            'user_id' => $user->id,
            'calendar_id' => $calendar->id,
            'approvedBy' => $approvedBy,
            'approverId' => $approverId,
            'isQRCode' => true,
            'gps_lat' => $gps_lat,
            'gps_long' => $gps_long,
            'task_plan' => json_encode(array('Needs To Be Updated')),
            'clock_in_time' => date('H:i:s', strtotime($timeToday)),
            'note' => 'Attendance was created by scanning QR Code',
            'clock_out_time' => null,
            'isFinished' => false,
            'approvalStatus' => $approvalStatus
        ]);
    }

    public function checkUserAttendanceExistToday()
    {
        $today_date = Carbon::now()->toDateString();
        $user = User::query()
            ->with('attendance')
            ->where('id', auth()->id())
            ->first();
        $user_latest_attendance = Attendance::query()
            ->where('user_id', $user->id)
            ->where('isQRCode', true)
            ->latest()
            ->first();

        if (!is_null($user_latest_attendance)) {
            $attendance_created_at = Carbon::parse($user_latest_attendance->created_at)->toDateString();
            if ($today_date == $attendance_created_at) {
                return true;
            }
        }

        return false;
    }
}
