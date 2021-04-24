<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceService;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function create()
    {
        return view('admin.qrcode.create');
    }

    public function generateQRCode()
    {
        $token = '';
        for ($i = 0; $i < 5; $i++) {
            $token .= chr(rand(ord('a'), ord('z')));
        }

        DB::table('qr_tokens')->truncate();
        DB::table('qr_tokens')->insert([
            'token' => $token,
        ]);

        return QrCode::size(300)->generate(route('web.employee.QRCode.save-attendance', $token));
    }

    public function saveAttendance(Request $request, $token)
    {
        $tokenFromDB = DB::table('qr_tokens')
            ->where('token', $token)
            ->value('token');

        if ($token === $tokenFromDB) {
            $this->attendanceService->storeUsingQRCode($request);
            return redirect()->route('web.employee.attendances.index')->with('message', 'Attendance Created Using QR Code!');
        } else {
            return redirect()->route('web.employee.attendances.index')->with('danger', 'QR Code Expires!');
        }
    }
}
