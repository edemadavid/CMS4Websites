<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCat;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogCatController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogCategories = BlogCat::with('blog')->get();

        // $blogCategories = BlogCat::all();

        return (view('admin.blog.blogCategories', compact('blogCategories')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|unique:blog_cats',
            'desc' => ''
        ]);

        // $skills = IconBars::where('page','=','skills');
        $blogCategory = new BlogCat();

        $blogCategory->title = $request->title;
        $blogCategory->desc = $request->desc;

        $blogCategory->save();

        return redirect()->route('blog.categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCat  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCat $blogCategory, $id)
    {
        $blogCategory = BlogCat::find($id);

        $blogs = BlogPost::where('category_id','=', $id)->get();

        return view('admin.blog.catblogs', compact('blogCategory', 'blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCat  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCat $blogCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCat  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCat $blogCategory, $id)
    {
        $blogCategory = BlogCat::find($id);

        $blogCategory->title = $request->title;
        $blogCategory->desc = $request->desc;

        $blogCategory->save();

        return redirect()->route('admin.blogcategories.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCat  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCat $blogCategory, $id)
    {
        $blogCategory = BlogCat::find($id);

        $blogs = BlogPost::where('category_id','=',$id)->with('blogComments')->get();

        // dd($blogs);
        foreach ($blogs as $blog) {

            $blog->delete();
        };

        $blogCategory->delete();

        return redirect()->route('admin.blogcategories.index');
    }
}
