@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Send a Message</h1>
    <p>Please fill the form below</p>
    <form class="col-lg-8" method="POST" action="{{route('contacts.store')}}">
        @csrf
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control @error('subject') border-danger @enderror"
            name="subject"
            id="subject"
            value="{{old('subject')}}">
            @error('subject')
                <p class="alert text-danger">You must enter a subject</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea 
            class="form-control @error('message') border-danger @enderror}"
            name="message" 
            id="message" >{{old('message')}}</textarea>
            @error('message')
                <p class="alert text-danger">You must have a message</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection