<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
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
        $about = About::where('page', 'aboutpage')->first();

        return view('admin.about', compact('about'));
    }

    // Function to update the About page
    public function postAbout(Request $request, $id)
    {
        $service = About::find($id);

        $service->h1 = $request->content;

        $service->save();

        return back()->with('success', 'About updated successfully');
    }

}
