<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::where('page', 'aboutpage')->get();

        return view('admin.services', compact('services'));
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

        // $service = Services::find($id);

        $service = new Services;

        $service->h1 = $request->h1;
        $service->page = 'aboutpage';
        $service->p = $request->p;

        $service->save();

        return back()->with('success', 'Service updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $service = Services::find($id);

        $service->h1 = $request->h1;
        $service->p = $request->p;

        $service->save();

        return back()->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Services::find($id);

        $service->delete();


        return back()->with('success', 'Service deleted successfully');
    }
    
}
