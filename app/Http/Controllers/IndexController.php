<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Blog;
use App\Category;
use App\Expertise;
use App\Project;
use App\Publication;
use App\Discategory;
use App\Districtscord;
use App\Disdata;

use Carbon\Carbon;

use DB, Hash, Auth, Image, File, Session, Artisan;
use Purifier;

class IndexController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->only('getLogin');
        // $this->middleware('auth')->only('getProfile');
    }

    public function index()
    {
        // $blogs = Blog::orderBy('id', 'DESC')->get()->take(3);
        // $alumnis = User::where('payment_status', 1)
        //                ->where('role', 'alumni')->count();

        $projects = Project::orderBy('id', 'desc')->get()->take(4);
        $publications = Publication::orderBy('id', 'desc')->get()->take(3);

        $employeecount = User::all()->count();
        $ongoingprojectcount = Project::where('status', 0)->count();
        $completeprojectcount = Project::where('status', 1)->count();
        $publicationcount = Publication::all()->count();
        
        return view('index.index')
                            ->withProjects($projects)
                            ->withPublications($publications)
                            ->withEmployeecount($employeecount)
                            ->withOngoingprojectcount($ongoingprojectcount)
                            ->withCompleteprojectcount($completeprojectcount)
                            ->withPublicationcount($publicationcount);
    }

    public function getAbout()
    {
        $expertises = Expertise::orderBy('id', 'desc')->get()->take(5);
        return view('index.about')->withExpertises($expertises);
    }

    public function getExpertise($slug)
    {
        $expertise = Expertise::where('slug', $slug)->first();
        return view('index.singleexpertise')->withExpertise($expertise);
    }

    public function getEmployees()
    {
        $people = User::where('type', 'Employee')
                         ->where('activation_status', 1)->get();
        return view('index.people')->withPeople($people);
    }

    public function getDirectors()
    {
        $people = User::where('type', 'Director')
                         ->where('activation_status', 1)->get();
        return view('index.people')->withPeople($people);
    }

    public function getMembers()
    {
        $people = User::where('type', 'Member')
                         ->where('activation_status', 1)->get();
        return view('index.people')->withPeople($people);
    }

    public function getProjects()
    {
        $projects = Project::orderBy('id', 'desc')->get();
        return view('index.projects')->withProjects($projects);
    }

    public function getProject($slug)
    {
        $project = Project::where('slug', $slug)->first();
        $randomprojects = Project::inRandomOrder()->get()->take(7);
        return view('index.singleproject')
                            ->withProject($project)
                            ->withProjects($randomprojects);
    }

    public function getPublications()
    {
        $publications = Publication::orderBy('id', 'desc')->paginate(12);
        return view('index.publications')->withPublications($publications);
    }

    public function getPublication($code)
    {
        $publication = Publication::where('code', $code)->first();
        $randompublications = Publication::inRandomOrder()->get()->take(5);
        return view('index.singlepublication')
                            ->withPublication($publication)
                            ->withPublications($randompublications);
    }

    public function getDisasterdata()
    {   
        $discategories = Discategory::all();
        $districtscords = Districtscord::all();
        return view('index.disasterdata')
                            ->withDiscategories($discategories)
                            ->withDistrictscords($districtscords);
    }

    public function getDisasterdataAPI($discategory_id)
    {   
        $disasterdata = Disdata::where('discategory_id', $discategory_id)->first();
        if($disasterdata) {
            $disasterdata->load('discategory');
            $disasterdata->load('districtscords');
        } else {
            return 'No Data.';
        }
        
        return $disasterdata;
    }

    public function getConstitution()
    {
        return view('index.constitution');
    }

    public function getFaq()
    {
        return view('index.faq');
    }

    public function getAdhoc()
    {
        $adhocmembers = Adhocmember::orderBy('id', 'asc')->get();
        return view('index.adhoc')->withAdhocmembers($adhocmembers);
    }

    public function getExecutive()
    {
        return view('index.executive');
    }

    public function getNews()
    {
        return view('index.news');
    }

    public function getEvents()
    {
        return view('index.events');
    }

    public function getGallery()
    {
        return view('index.gallery');
    }

    public function getContact()
    {
        return view('index.contact');
    }

    public function storeFormMessage(Request $request)
    {
        // $this->validate($request,array(
        //     'name'                      => 'required|max:255',
        //     'email'                     => 'required|max:255',
        //     'message'                   => 'required',
        //     'contact_sum_result_hidden'   => 'required',
        //     'contact_sum_result'   => 'required'
        // ));

        // if($request->contact_sum_result_hidden == $request->contact_sum_result) {
        //     $message = new Formmessage;
        //     $message->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        //     $message->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        //     $message->message = htmlspecialchars(preg_replace("/\s+/", " ", $request->message));
        //     $message->save();
            
        //     Session::flash('success', 'আপনার বার্তা আমাদের কাছে পৌঁছেছে। ধন্যবাদ!');
        //     return redirect()->route('index.contact');
        // } else {
        //     return redirect()->route('index.contact')->with('warning', 'যোগফল ভুল হয়েছে! আবার চেষ্টা করুন।')->withInput();
        // }
    }

    public function getApplication()
    {
        return view('index.application');
    }

    public function getLogin()
    {
        return view('index.login');
    }

    public function getProfile($unique_key)
    {
        // $blogs = Blog::where('user_id', Auth::user()->id)->get();
        // $categories = Category::all();
        $user = User::where('unique_key', $unique_key)->first();
        return view('index.profile')->withUser($user);
        
    }

    public function storeApplication(Request $request)
    {
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'required|email|unique:users,email',
            'phone'                     => 'required|numeric',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'required|image|max:300',
            'bio'                       => 'required',
            'password'                  => 'required|min:8'
        ));

        $application = new User();
        $application->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $application->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $application->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        
        $application->designation = 'Member';
        $application->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $application->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $application->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/users/'. $filename);
            Image::make($image)->resize(250, 250)->save($location);
            $application->image = $filename;
        }
        $application->password = Hash::make($request->password);

        $application->bio    = Purifier::clean($request->bio, 'youtube');
        $application->type = 'Member';
        $application->role = 'member';
        $application->activation_status = 0;

        // generate unique_key
        $unique_key_length = 100;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $unique_key = substr(str_shuffle(str_repeat($pool, 100)), 0, $unique_key_length);
        // generate unique_key
        $application->unique_key = $unique_key;
        $application->password = Hash::make($request->password);
        $application->save();
        
        Session::flash('success', 'You have registered Successfully!');
        Auth::login($application);
        return redirect()->route('index.profile', $unique_key);
    }


    // clear configs, routes and serve
    public function clear()
    {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        echo 'Config and Route Cached. All Cache Cleared';
    }
}
