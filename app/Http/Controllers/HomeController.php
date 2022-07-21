<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;

class HomeController extends  controller
{
    //
    public function index()
    {
        $posts=Post::paginate(6);
        
        return view('home')->with([
            'posts'=>$posts
            
        ]);
    }

    public function show ($slug){
        $post= Post::where('slug', $slug)->first();
        return view('show')->with([
            'post'=>$post
        ]);

    }

    public function create()
    {
        return view('create');
    }

    public function store(PostRequest $request)
    {
        Post::create([
            'title'=>$request->title,
            'body' =>$request->body,
            'slug'=>Str::slug($request->title),
            'image'=>"https://via.placeholder.com/650x480.png/008822?text=new post",

        ]);
        return redirect()->route('home')->with([
            'success' => 'Article ajouté '
        ]);
    }
    public function edit ($slug){
        $post= Post::where('slug', $slug)->first();
        return view('edit')->with([
            'post'=>$post
        ]);

    }
} 
