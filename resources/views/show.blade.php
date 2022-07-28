@extends('master.layout')

@section('style')
    <style>
        body{
            background-color:rgb(220, 203, 203);

        }
    </style>
@endsection

@section('title')
    {{$post->title}}
@endsection


@section('content')
    <div class="row " style="justify-content: center;">
        <div class="col-md-8">
            <div class="row" style="justify-content: center">
                <div class="col-md-4">
                    <div class="card mb-12 mt-5 ">
                        <div class="card" style=" height:500px;">
                            <img class="card-img-top" src="{{asset('uploads/' . $post->image)}}" alt="{{ $post->image }}">
                                <div class="card-body ">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p class="card-text"> {{ $post->body, 100}} </p>
                                </div>
                        </div>
                        @if (auth()->user()->id == $post->user_id )  
                            <a href="{{ route('post.edit',$post->slug) }}" class="btn btn-warning">
                                Modifier
                            </a>
                            <form id = "{{ $post->id }}" action="{{ route('post.delete',$post->slug )}}" method="post">
                                @csrf
                                @method('Delete')
                            </form>
                            <button 
                                onclick="event.preventDefault();
                                    alert()->question('Title','Lorem Lorem Lorem')"
                                class ="btn btn-danger" type="submit">
                                Supprimer
                            </button>
                        @endif
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection

@section('script')
    <script>    
        
    </script>
@endsection

