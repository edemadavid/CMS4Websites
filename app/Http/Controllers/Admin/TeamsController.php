<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeamsController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();

        return view('admin.teams', compact('teams'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'bio' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong, try again!!');
        };

        $validator = $validator->validated();

        $name = Str::slug($request->name);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
