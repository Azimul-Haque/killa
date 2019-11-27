<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Attendance;

class AttendanceController extends Controller
{
    public function test(Request $request) 
    {
    	$visit = new Attendance;
    	$visit->data = json_encode($request->all());
    	$visit->save();

    	$visits = Attendance::orderBy('id', 'desc')->get();
    	
    	return 200;
    	// return view('attendance.index')->withVisits($visits);
    }
}
