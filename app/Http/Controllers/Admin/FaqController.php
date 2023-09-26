<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FaqController extends Controller
{

    public function postFaq(Request $request, $id = null)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();

        return view('admin.faqs', compact('faqs'));
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
            'question' => 'required',
            'answer' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong, try again!!');
        };

        $faq = new Faq;

        $faq->question = $request->question;
        $faq->answer = $request->answer;

        $faq->save();

        return back()->with('success', 'Faq Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $faq = Faq::find($id);

        $faq->question = $request->question;
        $faq->answer = $request->answer;

        $faq->save();

        return back()->with('success', 'Faq Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);

        $faq->delete();

        return back()->with('success', 'Faq deleted successfully');
    }
}
