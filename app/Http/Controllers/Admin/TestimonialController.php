<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TestimonialController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonials::all();

        return view('admin.testimonials', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        //Checks and validated file
        if ($request->file('file')) {
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

    /**
     * Display the specified resource.
     */
    public function show(Testimonials $testimonials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonials $testimonials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimonial = Testimonials::find($id);

        $testimonial->delete();


        return back()->with('success', 'Testimonial deleted successfully');
    }
}
