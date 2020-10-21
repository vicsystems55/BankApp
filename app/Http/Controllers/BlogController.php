<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;

use App\User;

use App\Like;

use App\Follower;

use DB;

use Auth;

class BlogController extends Controller
{
    public function all()
    {
        $blog = Blog::all();
        
        return response()->json([
            "message" => "student record created",
            'user' => $blog
        ], 201);
    }


    public function index()
    {
            # code...
            return view('create_post');
    }

    public function authors()
    {
            # code...

            $user_data = User::all();

            return view('authors',[
                'user_data' => $user_data
            ]);
    }

    public function single_author($id)
    {
            # code...
            $user_data = User::find($id);

            $follower_data = DB::table('followers')->where('author_id', $id)->get();

           

            return view('single_author',[
                'user_data' => $user_data,
                'follower_data' => $follower_data
            ]);
    }

    public function follow(Request $request)
    {
        # code...
        $user_id = Auth::user()->id;

        $follow_data = new Follower;

        $follow_data->author_id = $request->author_id;
        $follow_data->user_id = $user_id;
        $follow_data->save();

        $user_data = DB::table('users')->where('id', $request->author_id)->increment('followers', 1);


        return back()->with('message', 'following recorded');
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
