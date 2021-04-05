@extends('layouts.app')

@section('content')
<div class="container w-50 mw-30">
    <h1>Add a Book</h1>
    <p>Please fill the form below</p>
    <form class="col-lg-12" method="POST" action="{{route('books.store')}}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control @error('title') border-danger @enderror" type="text" name="title" id="title" placeholder="Title" value="{{old('title')}}">
            @error('title')
            <p class="alert text-danger">You must enter a Title</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="number" class="form-control @error('isbn') border-danger @enderror" name="isbn" id="isbn" placeholder="ISBN" value="{{old('isbn')}}">
            @error('isbn')
            <p class="alert text-danger">You must enter an ISBN</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input class="form-control @error('author') border-danger @enderror" type="text" name="author" id="author" placeholder="Author" value="{{old('author')}}">
            @error('author')
            <p class="alert text-danger">You must enter a Author</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control @error('category') border-danger @enderror" id="category" name="category">
                <option value="">Select Category</option>
                @foreach ($categories as $cat)
                @if ($cat == old('category'))
                <option selected>
                    @else
                <option>
                    @endif
                    {{$cat}}
                </option>
                @endforeach
            </select>
            @error('category')
            <p class="alert text-danger">You must choose a category</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="pages">Page Count</label>
            <input type="number" class="form-control @error('pages') border-danger @enderror" name="pages" id="pages" placeholder="Page Count" value="{{old('pages')}}">
            @error('pages')
            <p class="alert text-danger">You must enter a Page Count</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="publication">Date of Publication</label>
            <input class="form-control @error('publication') border-danger @enderror" type="date" name="publication" id="publication" value="{{old('publication')}}">
            @error('publication')
            <p class="alert text-danger">You must enter a valid publication date.</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection