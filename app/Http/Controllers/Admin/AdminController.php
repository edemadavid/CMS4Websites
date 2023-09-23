<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Faq;
use App\Models\Services;
use App\Models\Team;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }


    // Function to display the About page
    public function getAbout()
    {
        $about = Services::where('page', 'aboutpage')->get();

        return view('admin.about', compact('about'));
    }

    // Function to update the About page
    public function postAbout(Request $request, $id)
    {
        $service = Services::find($id);

        $service->h1 = $request->h1;
        $service->p = $request->p;
        $service->icon = $request->icon;

        $file = $request->file('file');
        $filename = date('YmdHi') . "-services." . $request->file->extension();
        $path = public_path() . '/images/services';

        $service->image = $request->image;


        $saved = $service->save();

        if ($saved) {
            $file->move(public_path('images/services'), $filename);
        }

        return back()->with('success', 'About updated successfully');
    }

    public function getTeams()
    {
        $teams = Team::all();

        return view('admin.teams', compact('teams'));
    }

    public function postTeam(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:teams',
            'position' => 'required',
            'bio' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong, try again!!');
        };

        $validator = $validator->validated();

        $name = Str::slug($request->name);

        //Checks and validated file
        $file = $request->file('file');
        $extention = $request->file->extension();

        $filename = $name . "." . $extention;

        if ($id == null) {

            $team = new Team;

            $team->name = $request->name;
            $team->position = $request->position;
            $team->photo = $filename;
            $team->bio = $request->bio;
            $team->facebook_link = $request->facebook_link;
            $team->linkedin_link = $request->linkedin_link;

            $saved = $team->save();

            if ($saved) {
                $file->move(public_path('images/teams'), $filename);
            }

            return back()->with('success', 'Team Added successfully');
        } elseif ($id) {
            $team = Team::find($id);

            $oldPhoto = $team->photo;

            if ($request->file('file')) {
                $name = Str::slug($request->name);
                //Checks and validated file
                $file = $request->file('file');
                $extention = $request->file->extension();

                $filename = $name . "." . $extention;
            } else {
                $filename = $oldPhoto;
            }

            $team->name = $request->name;
            $team->position = $request->position;
            $team->photo = $filename;
            $team->bio = $request->bio;
            $team->facebook_link = $request->facebook_link;
            $team->linkedin_link = $request->linkedin_link;

            $saved = $team->save();

            if ($saved && $request->file('file')) {

                $path = public_path() . '/images/teams';
                $oldPhoto = $path . '/' . $oldPhoto;

                if (is_file($oldPhoto)) {
                    unlink($oldPhoto);
                }

                $file->move(public_path('images/teams'), $filename);
            }

            return back()->with('success', 'Team Update successfully');
        }
    }

    // Function to display services
    public function getServices()
    {
        $services = Services::where('page', 'aboutpage')->get();

        return view('admin.services', compact('services'));
    }

    // Function to update services
    public function postService(Request $request, $id=null)
    {

        $service = Services::find($id);

        $service->h1 = $request->h1;
        $service->p = $request->p;

        $service->save();

        return back()->with('success', 'Service updated successfully');
    }

    public function getTestimonials()
    {
        $testimonials = Testimonials::all();

        return view('admin.testimonials', compact('testimonials'));
    }

    public function postTestimonials(Request $request, $id=null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:testimonials',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong, try again!!');
        };

        $validator = $validator->validated();

        $name = Str::slug($request->name);

        if ($id == null) {
            //Checks and validated file
            if ($request->file('file')){
                $file = $request->file('file');

                $extension = $request->file->extension();

                $filename = $name . "." . $extension;

            } else {
                $filename = '';
            }

            $testimonial = new Testimonials;

            $testimonial->name = $request->name;
            $testimonial->photo = $filename;
            $testimonial->message = $request->message;

            // dd($testimonial);

            $saved = $testimonial->save();

            if ($saved && $request->file('file')) {
                $file->move(public_path('images/testimonials'), $filename);
            }

            return back()->with('success', 'Testimonial Added successfully');
        }
        elseif ($id) {
            $testimonial = Testimonials::find($id);
            $oldPhoto = $testimonial->photo;


            if ($request->file('file')) {
                $name = Str::slug($request->name);
                //Checks and validated file
                $file = $request->file('file');
                $extension = $request->file->extension();

                $filename = $name . "." . $extension;

            } else {
                $filename = $oldPhoto;
            }

            $testimonial->name = $request->name;
            $testimonial->message = $request->message;
            $testimonial->photo = $filename;


            $saved = $testimonial->save();

            if ($saved && $request->file('file')) {

                $path = public_path() . '/images/testimonials';
                $oldPhoto = $path . '/' . $oldPhoto;

                if (is_file($oldPhoto)) {
                    unlink($oldPhoto);
                }

                $file->move(public_path('images/testimonials'), $filename);
            }

            return back()->with('success', 'Testimonial updated successfully');

        }
    }

    public function getFaq()
    {
        $faq = Faq::all();

        return view('admin.faqs', compact('faq'));
    }

    public function postFaq(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong, try again!!');
        };

        if($id=null){
            $faq = new Faq;

            $faq->question = $request->question;
            $faq->answer = $request->answer;

            $faq->save();

            return back()->with('success', 'Faq Added Successfully');
        }
        elseif ($id){

            $faq = Faq::find($id);

            $faq->question = $request->question;
            $faq->answer = $request->answer;

            $faq->save();

            return back()->with('success', 'Faq Updated Successfully');
        }

    }

    public function getClients()
    {
        $clients = Client::all();

        return view('admin.clients', compact('clients'));
    }

    public function postClients(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:clients',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong, try again!!');
        };

        $validator = $validator->validated();

        $name = Str::slug($request->title);

        //Checks and validated file
        $file = $request->file('file');
        $extention = $request->file->extension();

        $filename = $name . "." . $extention;

        if ($id == null) {

            $client = new Client;

            $client->name = $request->name;
            $client->position = $request->position;
            $client->image = $filename;

            $saved = $client->save();

            if ($saved) {
                $file->move(public_path('images/clients'), $filename);
            }

            return back()->with('success', 'Client Added successfully');
        } elseif ($id) {
            $client = Team::find($id);

            $oldPhoto = $client->image;

            if ($request->file('file')) {
                $name = Str::slug($request->name);
                //Checks and validated file
                $file = $request->file('file');
                $extention = $request->file->extension();

                $filename = $name . "." . $extention;
            } else {
                $filename = $oldPhoto;
            }

            $client->name = $request->name;
            $client->position = $request->position;
            $client->photo = $filename;

            $saved = $client->save();

            if ($saved && $request->file('file')) {

                $path = public_path() . '/images/clients';
                $oldPhoto = $path . '/' . $oldPhoto;

                if (is_file($oldPhoto)) {
                    unlink($oldPhoto);
                }

                $file->move(public_path('images/clients'), $filename);
            }

            return back()->with('success', 'Client Update successfully');
        }
    }
}
