<?php

namespace App\Controllers;

class AttendanceController extends BaseController
{
    public function TimeIn(): string
    {
        return view('pages/attendance/time-in');
    }

        public function TimeOut(): string
    {
        return view('pages/attendance/time-out');
    }
}
