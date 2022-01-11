<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\QRCodeService;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    private $qrCodeService;

    public function __construct(QRCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function saveAttendance($token)
    {
        $tokenFromDB = $this->qrCodeService->getTokenFromDB($token);
        $today_attendance_exist = $this->qrCodeService->checkUserAttendanceExistToday();

        if ($today_attendance_exist) {
            return response()->json([
                'message' => 'Sorry, but you had submitted your attendance for today'
            ], 400);
        }

        if ($token === $tokenFromDB) {
            $this->qrCodeService->saveQRAttendance();
            return response()->json([
               'message' => 'Attendance Created Using QR Code!'
            ]);
        } else {
            return response()->json([
               'message' => 'QR Code Expired!'
            ]);
        }
    }
}
