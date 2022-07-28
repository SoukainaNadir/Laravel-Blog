@extends('master.layout')
 

@section('style')
    <style>
        body{
            background-color:rgb(220, 203, 203);

        }
    </style>
@endsection

@section('title')
    Accueil
@endsection


@section('content')
    <div class="row " style="justify-content: center; margin-top:60px">
        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                
            @endif
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4">
                        <div class="card mb-4 mt-5 ">
                            <div class="card" style=" height:450px;">
                                <img class="card-img-top" src="{{asset('uploads/'.$post->image)}}" alt="Card image cap">
                                    <div class="card-body ">
                                        <h5 class="card-title">{{$post->title}}</h5>
                                        <h6 class="card-title">{{$post->user ? $post->user->name : null}}</h6>
                                        <p class="card-text"> {{ Str::limit($post->body, 100)}} </p>
                                        <a href="{{route('post.show', $post->slug)}}" class="btn btn-primary">voir</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="justify-content: center ;display : flex; my-4 ">
                {{$posts ->links()}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>    
        
    </script>
@endsection

