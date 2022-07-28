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
        $post = Post::where('slug', $slug)->first();
        
        return view('show')->with([
            'post'=> $post
        ]);

    }

    public function create()
    {
        return view('create');
    }

    public function store(PostRequest $request)
    {
        $this->validate($request,[
            'title'=>'required|min:3|max:100',
            'body'=>'required|min:10|max:1000'
        ]);

        if ($request->has('image')){
            $file = $request->image;
            $image_name = time() .'_'. $file->getClientOriginalName(); 
            $file->move('uploads',$image_name);
        }
 
        Post::create([
            'title'=>$request->title,
            'body' =>$request->body,
            'slug'=>Str::slug($request->title),
            'image'=> $image_name,
            'user_id'=>auth()->id()

        ]);

        return redirect()->route('home')->with([
            'success' => 'Article ajouté '
        ]);
    }

    public function edit($slug)
    {
        $post= Post::where('slug', $slug)->first();
        return view('edit')->with([
            'post'=>$post
        ]);
    }

    public function update(PostRequest $request ,$slug)
    {
        $post = Post::where('slug', $slug)->first();

        if($request->has('image')){
            $file = $request->image;
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move('uploads', $image_name);

            if(file_exists(public_path('uploads/') . $post->image));
            {
                unlink(public_path('uploads/') . $post->image);
            }
            
            $post->image = $image_name;
        }

        $post->update([ 
            'title'=>$request->title,
            'body' =>$request->body,
            'slug'=>Str::slug($request->title),
            'image'=> $post->image,
            'user_id'=> auth()->user()->id
        ]);
        
        return redirect()->route('home')->with([
            'success'=>'Article modifié'
        ]);
    } 

    public function delete($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if(file_exists(public_path('uploads/') . $post->image))
        {
            unlink(public_path('uploads/') . $post->image);
        }

        $post->delete();
        
        Alert::success('Congrats', 'You\'ve Successfully Registered');

        return redirect()->route('home')->with([
            'success'=>'Article Supprimé'
        ]);
    } 
}