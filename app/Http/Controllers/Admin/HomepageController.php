<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    // Function to display sliders
    function getSlider()
    {
        $homeSlider = Slider::all();

        return view('admin.homepage.slider', compact('homeSlider'));
    }

    // Function to update sliders
    public function postSlider(Request $request, $id)
    {
        $slider = Slider::find($id);

        $oldPhoto = $slider->photo;

        if ($request->file('file')) {

            $file = $request->file('file');
            $extention = $request->file->extension();

            $filename = "slider".$id."." . $extention;

        } else {
            $filename = $oldPhoto;
        }

        $slider->h1 = $request->h1;
        $slider->h2 = $request->h2;
        $slider->p = $request->p;
        $slider->photo = $filename;

        $saved = $slider->save();

        if ($saved && $request->file('file')) {

            $path = public_path() . '/images';
            $oldPhoto = $path . '/' . $oldPhoto;

            if ($oldPhoto) {
                // unlink($oldPhoto);
            }

            $file->move(public_path('images'), $filename);

        }

        return back()->with('success', 'Slider updated successfully');
    }

    // Function to display services
    public function getServices()
    {
        $services = Services::where('page', 'homepage')->get();

        return view('admin.homepage.services', compact('services'));
    }

    // Function to update services
    public function postService(Request $request, $id)
    {

        $service = Services::find($id);

        $service->h1 = $request->h1;
        $service->p = $request->p;

        $service->save();

        return back()->with('success', 'Service updated successfully');
    }


    // Function to display the About page
    public function getAbout()
    {
        $about = Services::where('page', 'homepage')->get();

        return view('admin.homepage.about', compact('about'));
    }

    // Function to update the About page
    public function postAbout(Request $request, $id)
    {
        $service = Services::find($id);

        $service->h1 = $request->h1;
        $service->p = $request->p;
        $service->icon = $request->icon;

        $service->save();

        return back()->with('success', 'About updated successfully');
    }
}
