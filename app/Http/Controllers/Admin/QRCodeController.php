<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function create()
    {
        return view('admin.qrcode.create');
    }

    public function generateQRCode()
    {
        $qr_code = QrCode::size(200)->generate('google.com/test');
        return view('admin.qrcode.show', compact('qr_code'));
    }
}
