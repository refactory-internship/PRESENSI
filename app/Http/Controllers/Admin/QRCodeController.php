<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceService;
use App\Http\Services\QRCodeService;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stevebauman\Location\Facades\Location;

class QRCodeController extends Controller
{
    private $qrCodeService;

    public function __construct(QRCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function create()
    {
        return view('admin.qrcode.create');
    }

    public function generateQRCode()
    {
        $token = $this->qrCodeService->generateToken();
        return QrCode::size(300)->generate(route('web.employee.QRCode.save-attendance', $token));
    }

    public function saveAttendance($token)
    {
        $tokenFromDB = $this->qrCodeService->getTokenFromDB($token);

        if ($token === $tokenFromDB) {
            $this->qrCodeService->saveQRAttendance();
            return redirect()->route('web.employee.attendances.index')->with('message', 'Attendance Created Using QR Code!');
        } else {
            return redirect()->route('web.employee.attendances.index')->with('danger', 'QR Code Expires!');
        }
    }

    public function locationTest()
    {
        $ipAddress = '50.50.50.50';
        $locationData = Location::get($ipAddress);
        dd($locationData);
    }
}
