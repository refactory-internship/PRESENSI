<?php


namespace App\Http\Services;


use App\Enums\ApprovalStatus;
use App\Enums\AttendanceApprover;
use App\Models\Attendance;
use App\Models\User;
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

        if ($user->isAutoApproved === true) {
            $approvedBy = AttendanceApprover::SYSTEM;
            $approverId = null;
            $approvalStatus = ApprovalStatus::APPROVED;
        } else {
            $approvedBy = AttendanceApprover::PARENT;
            $approverId = $user->parent->id;
            $approvalStatus = null;
        }

        return Attendance::query()->create([
            'user_id' => $user->id,
            'calendar_id' => $calendar->id,
            'approvedBy' => $approvedBy,
            'approverId' => $approverId,
            'isQRCode' => true,
            'task_plan' => 'Needs To Be Updated',
            'clock_in_time' => date('H:i:s', strtotime($timeToday)),
            'note' => 'Attendance was created by scanning QR Code',
            'clock_out_time' => null,
            'isFinished' => false,
            'approvalStatus' => $approvalStatus
        ]);
    }
}
