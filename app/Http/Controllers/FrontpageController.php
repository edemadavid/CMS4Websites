<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontpageController extends Controller
{
     // Function to handle the home page (GET)
     public function index()
     {
         return view('frontpage.index');
     }

     // Function to handle the about page (GET)
     public function about()
     {
         return view('frontpage.about');
     }

     // Function to handle the team page (GET)
     public function team()
     {
         return view('frontpage.team');
     }

     // Function to handle the services page (GET)
     public function services()
     {
         return view('frontpage.services');
     }

     // Function to handle the projects page (GET)
     public function projects()
     {
         return view('frontpage.projects');
     }

     // Function to handle the contact page (GET)
     public function contact()
     {
         return view('frontpage.contact');
     }

     // Function to handle submitting the contact form (POST)
     public function postContact()
     {
         return back();
     }
}
