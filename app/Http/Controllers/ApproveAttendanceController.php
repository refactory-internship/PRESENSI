<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApproveAttendanceController extends Controller
{
    public function index()
    {
        return response()->json('can approve attendance');
    }
}
