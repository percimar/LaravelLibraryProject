@extends('layouts.app')

@section('content')
<div class="container w-50 mw-30">
    <h1>Request a Book</h1>
    <p>Please fill the form below</p>
    <form class="col-lg-12" method="POST" action="{{route('request.store')}}">

        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control @error('title') border-danger @enderror" type="text" name="title" id="title" placeholder="Title" value="{{old('title')}}">
            @error('title')
            <p class="alert text-danger">You must enter a Title</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input class="form-control @error('author') border-danger @enderror" type="text" name="author" id="author" placeholder="Author" value="{{old('author')}}">
            @error('author')
            <p class="alert text-danger">You must enter a Author</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Request</button>

    </form>
</div>
@endsection