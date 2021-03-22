<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function create()
    {
        return view('admin.qrcode.create');
    }

    public function generateQRCode()
    {

    }
}
