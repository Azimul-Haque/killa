<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Adhocmember;
use App\User;
use App\Expertise;
use App\Project;
use App\Publication;

use Carbon\Carbon;
use DB, Hash, Auth, Image, File, Session;
use Purifier;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    public function getCommittee()
    {
        $adhocmembers = Adhocmember::orderBy('id', 'desc')->get();
        return view('dashboard.committee')->withAdhocmembers($adhocmembers);
    }

    public function storeCommittee(Request $request)
    {
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'sometimes|email',
            'phone'                     => 'sometimes|numeric',
            'designation'               => 'required|max:255',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'gplus'                     => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'sometimes|image|max:400'
        ));

        $adhocmember = new Adhocmember();
        $adhocmember->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $adhocmember->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $adhocmember->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        $adhocmember->designation = htmlspecialchars(preg_replace("/\s+/", " ", $request->designation));
        $adhocmember->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $adhocmember->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $adhocmember->gplus = htmlspecialchars(preg_replace("/\s+/", " ", $request->gplus));
        $adhocmember->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/committee/adhoc/'. $filename);
            Image::make($image)->resize(400, 400)->save($location);
            $adhocmember->image = $filename;
        }

        $adhocmember->save();
        
        Session::flash('success', 'Saved Successfully!');
        return redirect()->route('dashboard.committee');
    }

    public function updateCommittee(Request $request, $id) {
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'sometimes|email',
            'phone'                     => 'sometimes|numeric',
            'designation'               => 'required|max:255',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'gplus'                     => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'sometimes|image|max:400'
        ));

        $adhocmember = Adhocmember::find($id);
        $adhocmember->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $adhocmember->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $adhocmember->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        $adhocmember->designation = htmlspecialchars(preg_replace("/\s+/", " ", $request->designation));
        $adhocmember->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $adhocmember->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $adhocmember->gplus = htmlspecialchars(preg_replace("/\s+/", " ", $request->gplus));
        $adhocmember->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload
        if($adhocmember->image == null) {
            if($request->hasFile('image')) {
                $image      = $request->file('image');
                $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
                $location   = public_path('/images/committee/adhoc/'. $filename);
                Image::make($image)->resize(400, 400)->save($location);
                $adhocmember->image = $filename;
            }
        } else {
            if($request->hasFile('image')) {
                $image_path = public_path('images/committee/adhoc/'. $adhocmember->image);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $image      = $request->file('image');
                $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
                $location   = public_path('/images/committee/adhoc/'. $filename);
                Image::make($image)->resize(400, 400)->save($location);
                $adhocmember->image = $filename;
            }
        }
            
        $adhocmember->save();
        
        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.committee');
    }

    public function deleteCommittee($id)
    {
        $adhocmember = Adhocmember::find($id);
        $image_path = public_path('images/committee/adhoc/'. $adhocmember->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $adhocmember->delete();

        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.committee');
    }

    public function getNews()
    {
        return view('dashboard.index');
    }

    public function getEvents()
    {
        return view('dashboard.index');
    }

    public function getGallery()
    {
        return view('dashboard.index');
    }

    public function getBlogs()
    {
        return view('dashboard.index');
    }

    public function getMembers()
    {
        $members = User::where('activation_status', 1)->orderBy('id', 'desc')->paginate(20);
        return view('dashboard.members')->withMembers($members);
    }

    public function createMember()
    {
        return view('dashboard.createmember');
    }

    public function storeMember(Request $request)
    {
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'required|email|unique:users,email',
            'phone'                     => 'required|numeric',
            'designation'               => 'sometimes|max:255',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'required|image|max:300',
            'bio'                       => 'required',
            'type'                      => 'required',
            'password'                  => 'required|min:8'
        ));

        $member = new User();
        $member->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $member->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $member->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        
        $member->designation = htmlspecialchars(preg_replace("/\s+/", " ", $request->designation));
        $member->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $member->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $member->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/users/'. $filename);
            Image::make($image)->resize(250, 250)->save($location);
            $member->image = $filename;
        }
        $member->password = Hash::make($request->password);

        $member->bio    = Purifier::clean($request->bio, 'youtube');
        $member->type = $request->type;
        $member->role = 'member';
        $member->activation_status = 1;

        // generate unique_key
        $unique_key_length = 100;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $unique_key = substr(str_shuffle(str_repeat($pool, 100)), 0, $unique_key_length);
        // generate unique_key
        $member->unique_key = $unique_key;
        $member->password = Hash::make($request->password);
        $member->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.members');
    }

    public function deleteMember($id)
    {
        //
    }

    public function getExpertises()
    {
        $expertises = Expertise::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.expertises')->withExpertises($expertises);
    }

    public function createExpertise()
    {
        return view('dashboard.createexpertise');
    }

    public function storeExpertise(Request $request)
    {
        $this->validate($request,array(
            'title'                      => 'required|max:255',
            'description'                => 'required',
            'image'                     => 'required|image|max:500'
        ));

        $expertise = new Expertise();
        $expertise->title = $request->title;
        $expertise->description = Purifier::clean($request->description, 'youtube');
        

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = preg_replace('/[^A-Za-z0-9\-]/', '', $request->title).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/expertises/'. $filename);
            Image::make($image)->resize(1000, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $expertise->image = $filename;
        }

        $expertise->slug = preg_replace('/[^A-Za-z0-9\-]/', '_', strtolower($request->title)).'_'.time();
        $expertise->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.expertises');
    }

    public function getProjects()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.projects')->withProjects($projects);
    }

    public function createProject()
    {
        return view('dashboard.createproject');
    }

    public function storeProject(Request $request)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'status'                  => 'required|max:255',
            'starts'                  => 'required|max:255',
            'ends'                    => 'required|max:255',
            'body'                    => 'required',
            'image'                   => 'required|image|max:500'
        ));

        $project = new Project();
        $project->title = $request->title;
        $project->status = $request->status;
        $project->starts = new Carbon($request->starts);
        $project->ends = new Carbon($request->ends);
        $project->body = Purifier::clean($request->body, 'youtube');
        

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = preg_replace('/[^A-Za-z0-9\-]/', '', $request->title).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/projects/'. $filename);
            Image::make($image)->resize(1000, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $project->image = $filename;
        }

        $project->slug = preg_replace('/[^A-Za-z0-9\-]/', '_', strtolower($request->title)).'_'.time();
        $project->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.projects');
    }

    public function getPublications()
    {
        $publications = Publication::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.publications')->withPublications($publications);
    }

    public function createPublication()
    {
        $members = User::all();
        return view('dashboard.createpublication')->withMembers($members);
    }

    public function storePublication(Request $request)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'publishing_date'         => 'required|max:255',
            'member_ids'              => 'required|max:255',
            'body'                    => 'required',
            'image'                   => 'required|image|max:500',
            'attachment'              => 'required|mimes:doc,docx,ppt,pptx,png,jpeg,jpg,pdf,gif|max:1000'
        ));

        $publication = new Publication();
        $publication->title = $request->title;
        $publication->code = random_string(10);
        $publication->publishing_date = new Carbon($request->publishing_date);

        // file upload
        if($request->hasFile('attachment')) {
            $newfile = $request->file('attachment');
            $filename   = $publication->code.'_file_'.time() .'.' . $newfile->getClientOriginalExtension();
            $location   = public_path('/files/');
            $newfile->move($location, $filename);
            $publication->file = $filename;
        }
        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = $publication->code.'_'.time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/publications/'. $filename);
            Image::make($image)->resize(200, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $publication->image = $filename;
        }
        $publication->body = Purifier::clean($request->body, 'youtube');

        $publication->save();
        // associate members
        // foreach ($request->member_ids as $key => $value) {
        //     $publication->users()->attach($value);
        // }
        $publication->users()->sync($request->member_ids, false);

        
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.publications');
    }

    public function getApplications()
    {
        $applications = User::where('activation_status', 0)
                            ->where('role', 'member')
                            ->paginate(20);
        return view('dashboard.applications')->withApplications($applications);
    }

    public function approveApplication(Request $request, $id)
    {

        $application = User::findOrFail($id);
        $application->activation_status = 1;
        $application->save();

        Session::flash('success', 'Approved Successfully!');
        return redirect()->route('dashboard.applications');
    }

    public function deleteApplication($id)
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
}
