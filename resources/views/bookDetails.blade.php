@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <img src={{$book->image}} />
    <br /><br />
    <h1>{{$book->title}}</h1>
    <h2>{{$book->publication}}</h2>
    <br />
    <h3>Written by: {{$book->author}}</h3>
    <h3>Under: {{$book->category}}</h3>
    <br />
    <a href={{route('reserve', $book->id)}} class="btn btn-primary">Reserve</a>
</div>
@endsection