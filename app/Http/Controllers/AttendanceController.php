<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Attendance;

class AttendanceController extends Controller
{
    public function test() 
    {
    	$visit = new Attendance;
    	$visit->ip = Request::ip();
    	$visit->save();

    	$visits = Attendance::orderBy('id', 'desc')->get();
    	
    	return view('attendance.index')->withVisits($visits);
    }
}
