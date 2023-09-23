<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCat;
use App\Models\BlogComment;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::with('blogCategory')->get();

        return (view('admin.blog.blogs', compact('blogs')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCat::all();

        return view('admin.blog.newBlog', compact('categories'));
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
            'title' => 'required|unique:blogs',
            'category' => 'required|numeric',
            'blog_content' => 'required',
            'file'=> 'required'
        ]);

        $file = $request->file('file');

        $filename = date('YmdHi') . "-blog." . $request->file->extension();

        $path = public_path() . '/images/blogs';

        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        // dd($request);

        $blog = new BlogPost;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->category_id = $request->category;
        $blog->contents = $request->blog_content;
        $blog->image = $filename;
        $blog->status = $status;

        $saved = $blog->save();

        if ($saved) {
            $file->move(public_path('images/blog'), $filename);
        }


        return redirect()->route('blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blog, $id)
    {
        $blog = BlogPost::with('blogCategory')->find($id);

        return view('admin.blog.eachBlog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blog, $id)
    {
        if ($request->isMethod('get')) {

            $categories = BlogCat::all();

            $blog = BlogPost::with('blogCategory')->find($id);

            return view('admin.blog.editBlog', compact('categories', 'blog'));
        }

        if ($request->isMethod('post')) {

            $blog = BlogPost::with('blogCategory')->find($id);

            $path = public_path() . '/images/blog';

            $oldPhoto = $path . '/' . $blog->image;


            $request->validate([
                'title' => 'required',
                'category' => 'required|numeric',
                'blog_content' => 'required'

            ]);

            $file = $request->file('file');

            if ($file) {

                $filename = date('YmdHi') . "-blog." . $request->file->extension();

                $path = public_path() . '/images/blog';
            } else {

                $filename = $blog->image;
            }



            if ($request->status == 'on') {
                $status = 1;
            } else {
                $status = 0;
            }

            $blog->title = $request->title;
            $blog->slug = Str::slug($request->title);
            $blog->category_id = $request->category;
            $blog->contents = $request->blog_content;
            $blog->image = $filename;
            $blog->status = $status;

            $saved = $blog->save();

            if ($saved && $file) {

                unlink($oldPhoto);

                $file->move(public_path('images/blog'), $filename);
            }


            return redirect()->route('blog.show', $blog->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blog, $id)
    {
        $blog = BlogPost::find($id);
        $comments = BlogComment::where('blog_id','=',$id)->get();


        $path = public_path() . '/images/blog';
        $oldPhoto = $path . '/' . $blog->image;
        unlink($oldPhoto);



        $blog->delete();
        foreach ($comments as $comment){
            $comment->delete();
        };


        return redirect()->route('blog');
    }
}
