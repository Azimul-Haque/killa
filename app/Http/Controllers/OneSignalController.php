<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Charioteer;
use Session;
use OneSignal;

class OneSignalController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->only('getLogin');
        // $this->middleware('auth')->only('getProfile');
    }

    public function index()
    {
        $charioteers = Charioteer::orderBy('id', 'desc')->paginate(10);

        return view('dashboard.charioteer.index')
                            ->withCharioteers($charioteers);
    }

    public function storeQA(Request $request)
    {
        $this->validate($request,array(
            'question'       => 'required|max:255',
            'answer'         => 'required|max:255'
        ));

        $charioteer = new Charioteer();
        $charioteer->question = $request->question;
        $charioteer->answer = $request->answer;
        

        $charioteer->save();

        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.onesignal');
    }

    public function updateQA(Request $request, $id)
    {
        $this->validate($request,array(
            'question'       => 'required|max:255',
            'answer'         => 'required|max:255'
        ));

        $charioteer = Charioteer::findOrFail($id);
        $charioteer->question = $request->question;
        $charioteer->answer = $request->answer;
        

        $charioteer->save();

        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.onesignal');
    }

    public function delQA($id)
    {
        // $adhocmember = Adhocmember::find($id);
        // $image_path = public_path('images/committee/adhoc/'. $adhocmember->image);
        // if(File::exists($image_path)) {
        //     File::delete($image_path);
        // }
        // $adhocmember->delete();

        // Session::flash('success', 'Deleted Successfully!');
        // return redirect()->route('dashboard.committee');
    }

    public function sendPush()
    {
        $charioteer = Charioteer::inRandomOrder()->first();

        
        OneSignal::sendNotificationToAll(
            '----------------------------------------------------------------------------------------------' . $charioteer->answer,
            $url = null, 
            $data = null,
            $buttons = null, 
            $schedule = null,
            $headings = $charioteer->question
        );

        Session::flash('success', 'Sent Successfully!');
        return redirect()->route('dashboard.onesignal');
    }
}