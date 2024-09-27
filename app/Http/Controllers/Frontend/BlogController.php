<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogDetails(string $slug)
    {
        $blog=Blog::with('comments')->where('slug', $slug)->where('status',1)->firstOrFail();
         // Increment the views count
        $blog->increment('views');
        $moreBlogs=Blog::where('slug','!=' ,$slug)->where('status',1)->orderBy('id', 'desc')->take(5)->get();
        $recentBlogs=Blog::where('slug','!=' ,$slug)->where('status',1)->where('category_id', $blog->category_id)->orderBy('id', 'desc')->take(10)->get();
        $comments=$blog->comments()->paginate(5);
        $categories=BlogCategory::where('status',1)->get();
        return view('frontend.pages.blog-details', compact('blog', 'moreBlogs', 'comments','categories','recentBlogs'));
    }
    public function comment(Request $request)
    {
        $request->validate([
           'comment' => 'required|max:1000'
        ]);
        $comment = new BlogComment();
        $comment->user_id=auth()->user()->id;
        $comment->blog_id=$request->blog_id;
        $comment->comment=$request->comment;
        $comment->save();
        toastr('Comment added successfully', 'success', 'Success');
        return redirect()->back();
    }
    public function blog(Request $request)
    {
        if($request->has('search')){
            $blogs=Blog::with('category')->where('status',1)->where('title', 'like', '%'.$request->search.'%')->orderBy('id', 'desc')->paginate(12);
        }else if($request->has('category')){
            $category=BlogCategory::where('slug', $request->category)->where('status',1)->firstOrFail();
            $blogs=Blog::with('category')->where('category_id', $category->id)->where('status',1)->orderBy('id', 'desc')->paginate(12);
        }
        else{
            $blogs=Blog::with('category')->where('status',1)->orderBy('id', 'desc')->paginate(12);
        }
        return view('frontend.pages.blog', compact('blogs'));
    }
}
