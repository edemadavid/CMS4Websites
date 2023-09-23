<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function getAbout()
    {
        return view('admin.about');
    }

    public function postAbout(Request $request, $id)
    {
        return back();
    }

    public function getTeams()
    {
        return view('admin.teams');
    }

    public function postTeam(Request $request, $id)
    {
        return back();
    }

    public function getServices()
    {
        return view('admin.services');
    }

    public function postServices(Request $request, $id)
    {
        return back();
    }

    public function getTestimonials()
    {
        return view('admin.testimonials');
    }

    public function postTestimonials(Request $request, $id)
    {
        return back();
    }

    public function getFaq()
    {
        return view('admin.faqs');
    }

    public function postFaq(Request $request, $id)
    {
        return back();
    }

    public function getClients()
    {
        return view('admin.clients');
    }

    public function postClients(Request $request, $id)
    {
        return back();
    }
}
