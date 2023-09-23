<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
   function getSlider() {

        return view('admin.slider');
   }
}
