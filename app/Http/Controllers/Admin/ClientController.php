<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function getClients()
    {
    }

    public function postClients(Request $request, $id = null)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        return view('admin.clients', compact('clients'));
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
            'title' => 'required|unique:clients',
            // 'file' => 'required',
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

        $client = new Client;

        $client->title = $request->title;
        $client->image = $filename;

        $saved = $client->save();

        if ($saved) {
            $file->move(public_path('images/clients'), $filename);
        }

        return back()->with('success', 'Client Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();


        return back()->with('success', 'Client deleted successfully');
    }
}
