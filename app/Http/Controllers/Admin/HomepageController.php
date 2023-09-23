<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    // Function to display sliders
    function getSlider()
    {

        return view('admin.homepage.slider');
    }

    // Function to update sliders
    public function postSlider(Request $request)
    {

        return back();
    }

    // Function to display services
    public function getServices()
    {

        return view('admin.homepage.services');
    }

    // Function to update services
    public function postService(Request $request)
    {

        return back();
    }

    // Function to display the About page
    public function getAbout()
    {

        return view('admin.homepage.about');
    }

    // Function to update the About page
    public function postAbout(Request $request)
    {

        return back();
    }
}
