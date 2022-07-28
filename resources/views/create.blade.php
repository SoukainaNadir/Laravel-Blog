@extends('master.layout')

@section('title')
    Publier   
@endsection

@section('style')
    <style>
        body{
            background-color:rgb(235, 134, 134);
        }
    </style>
@endsection

@section('content')
    <div class="row my-4 ">
        <div class="col-md-8 mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul> 
                </div>
            @endif
            <div class="card" style="margin-top: 0px">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter une publication
                    </h3> 
                </div>
                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Titre</label>
                            <input type="text" class="form-control" name="title" placeholder="Titre"> </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" >Description</label>
                            <textarea type="password" class="form-control" name="body" rows="3" placeholder="Description"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="file" class="form-check-input" name="image">
                            <label class="form-check-label" for="exampleCheck1">Image</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>                
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>    
        
    </script>
@endsection