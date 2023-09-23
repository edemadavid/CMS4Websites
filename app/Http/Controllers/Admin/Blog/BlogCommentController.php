<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendingComments = BlogComment::where('is_approved','=','0')->with('blog')->get();
        $approvedComments = BlogComment::where('is_approved','=','1')->with('blog')->get();
        $rejectedComments = BlogComment::where('is_approved','=','2')->with('blog')->get();

        return (view('admin.blog.comments', compact('pendingComments', 'approvedComments', 'rejectedComments')));

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
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'

        ]);

        $comment = new BlogComment;
        $comment->blog_id = $request->blogId;
        $comment->full_name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->message;
        $comment->is_approved = 0;


        $saved = $comment->save();

        if ($saved ){
            return back()->with('success', 'Your comment has been received, awaiting approval');
        }

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogComment  $blogComments
     * @return \Illuminate\Http\Response
     */
    public function approve ($id)
    {
        $comment = BlogComment::find($id);

        $comment->is_approved = 1;

        $comment->save();

        return redirect()->route('blog.comments');

    }

    public function reject ($id)
    {
        $comment = BlogComment::find($id);

        $comment->is_approved = 2;

        $comment->save();

        return redirect()->route('blog.comments');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogComment  $blogComments
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogComment $blogComments)
    {
        //
    }
}
