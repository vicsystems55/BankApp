<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;

use App\User;

use App\Like;

use DB;

use Auth;

class BlogController extends Controller
{
    public function index()
    {
            # code...
            return view('create_post');
    }

    public function create(Request $request)
    {
            # code...
            
            $replaced = str_replace(' ', '_', $request->title);

            Blog::create([
                'title' => $request->title,
                'body' => $request->body,
                'slug' => $replaced,
                'likes' => 0,
                'unlikes' => 0,
                'user_id' => Auth::user()->id

            ]);

            return redirect('/create_post')->with('message', 'Post created');
    }

    
    public function blog()
    {
        # code...
        $user_id = Auth::user()->id;
        $blogs = Blog::all();
        $likes = DB::table('likes')->where('user_id', Auth::user()->id)->get();

        // $likeArr=array_reduce($likes->toArray());

      

       

        return view('blog',[
            'blogs' => $blogs,
            'likes' => $likes
        ]);

    }

    public function like(Request $request)
    {
        # code...
        $liked_post = DB::table('blogs')->where('id', $request->post_id)->increment('likes', 1);

        Like::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id
        ]);
        return back()->with('likes_message' , 'like recorded');
    }

}
