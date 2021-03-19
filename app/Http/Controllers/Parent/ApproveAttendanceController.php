<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApproveAttendanceController extends Controller
{
    public function index()
    {
        return response()->json('can approve attendance');
    }
}
