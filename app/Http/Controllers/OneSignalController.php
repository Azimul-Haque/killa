<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Charioteer;
use App\Charioteerreport;

use Session, Auth;
use OneSignal;

class OneSignalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('sendPush', 'broadcast', 'postQstnAPI');
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
            'answer'         => 'required|max:255',
            'option1'        => 'required|max:255',
            'option2'        => 'required|max:255',
            'option3'        => 'required|max:255'
        ));

        $charioteer = new Charioteer();
        $charioteer->question = $request->question;
        $charioteer->answer = $request->answer;
        $charioteer->incanswer = $request->option1 .','. $request->option2 .','. $request->option3;

        $charioteer->save();

        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.onesignal');
    }

    public function updateQA(Request $request, $id)
    {
        $this->validate($request,array(
            'question'       => 'required|max:255',
            'answer'         => 'required|max:255',
            'option1'        => 'required|max:255',
            'option2'        => 'required|max:255',
            'option3'        => 'required|max:255'
        ));

        $charioteer = Charioteer::findOrFail($id);
        $charioteer->question = $request->question;
        $charioteer->answer = $request->answer;
        $charioteer->incanswer = $request->option1 .','. $request->option2 .','. $request->option3;
        
        $charioteer->save();

        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.onesignal');
    }

    public function approveQA(Request $request, $id)
    {
        $this->validate($request,array(
            'question'       => 'required|max:255',
            'answer'         => 'required|max:255'
        ));

        $charioteer = Charioteer::findOrFail($id);
        $charioteer->status = 1;
        $charioteer->question = $request->question;
        $charioteer->answer = $request->answer;
        

        $charioteer->save();

        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.onesignal');
    }

    public function unapproveQA(Request $request, $id)
    {
        $charioteer = Charioteer::findOrFail($id);
        $charioteer->status = 0;
        $charioteer->save();

        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.onesignal');
    }

    public function delQA($id)
    {
        $charioteer = Charioteer::findOrFail($id);
        $charioteer->delete();

        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.onesignal');
    }

    public function sendPush()
    {
        $charioteer = Charioteer::inRandomOrder()
                                ->where('status', 1)
                                ->first();
        $charioteer->count = $charioteer->count + 1;
        $charioteer->save();

        OneSignal::sendNotificationToAll(
            "উত্তর দেখতে নোটিফিকেশনে ক্লিক করুন",
            $url = null, 
            $data = array("answer" => $charioteer->answer),
            $buttons = null, 
            $schedule = null,
            $headings = $charioteer->question
        );

        Session::flash('success', 'Sent Successfully!');
        if(Auth::check()) {
            return redirect()->route('dashboard.onesignal');
        } else {
            return '200';
        }
        
    }

    public function broadcast($api_key, $last_id)
    {
        if($api_key == 'rifat2020') {
            $questions = Charioteer::where('id', '>', $last_id)
                                   ->where('status', 1)
                                   ->orderBy('id', 'asc')->get();
            print(json_encode($questions));
        }
    }

    public function testJson()
    {
        // $arrayaa = ['aaa', 'bbb', 'ccc'];
        // $arrayaas = serialize($arrayaa);
        
        // $unaaa = unserialize($arrayaas);
        $testaa = "A,B,C";
        $tesarray = explode(",", $testaa);
        dd($tesarray);
    }

    public function postQstnAPI(Request $request)
    {
        $this->validate($request,array(
            'question'       => 'required|max:255',
            'answer'         => 'required|max:255'
        ));

        $charioteer = new Charioteer;
        $charioteer->status = 0; // as users send this...
        $charioteer->question = $request->question;
        $charioteer->answer = $request->answer;
        $charioteer->save();

        return response()->json([
            'success' => true,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
    }

    public function reportQstnAPI(Request $request)
    {
        $this->validate($request,array(
            'question'       => 'required|max:255',
            'answer'         => 'required|max:255'
            'report'         => 'sometimes|max:255'
        ));

        $report = new Charioteerreport;
        $report->question = $request->question;
        $report->answer = $request->answer;
        $report->report = $request->report;
        $report->save();

        return response()->json([
            'success' => true
        ]);
    }
}
