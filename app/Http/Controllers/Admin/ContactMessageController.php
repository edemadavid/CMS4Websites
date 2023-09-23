<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactMessages = ContactMessage::distinct('email')->latest()->get();

        // dd($contactMessages);
        return view('admin.contact.message', compact('contactMessages'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'phone_no'=> 'required',

        ]);

        $message = new ContactMessage;

        $message->full_name = $request->name;
        $message->email = $request->email;
        $message->phone_no = $request->phone_no;
        $message->message = $request->message;


        $saved = $message->save();

        if ($saved ){
            return true;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage, $id)
    {
        $contactMessage = ContactMessage::find($id);

        $messages = ContactMessage::where('email', $contactMessage->email)->get();
        // dd($messages);

        return view('admin.contact.showMessage', compact('messages', 'contactMessage'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        //
    }
}
