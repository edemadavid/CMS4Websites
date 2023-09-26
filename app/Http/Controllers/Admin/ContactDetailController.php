<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use Illuminate\Http\Request;

class ContactDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = ContactDetail::first();

        return view('admin.contact.details', compact('contact'));
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
        $contacts = contactDetail::first();

        if ($contacts) {

            $contacts->email = $request->email;
            $contacts->address = $request->address;
            $contacts->tel = $request->tel;
            $contacts->map = $request->map;

            $contacts->facebook = $request->facebook;
            $contacts->instagram = $request->instagram;
            $contacts->linkedin = $request->linkedin;
            $contacts->twitter = $request->twitter;

            $contacts->save();

        } else {
            $contacts = new ContactDetail;

            $contacts->email = $request->email;
            $contacts->address = $request->address;
            $contacts->tel = $request->tel;
            $contacts->map = $request->map;

            $contacts->facebook = $request->facebook;
            $contacts->instagram = $request->instagram;
            $contacts->linkedin = $request->linkedin;
            $contacts->twitter = $request->twitter;

            $contacts->patch();

        }

        return back()->with('success, Cantact Details have been updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactDetail $contactDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactDetail $contactDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactDetail $contactDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactDetail $contactDetail)
    {
        //
    }
}
