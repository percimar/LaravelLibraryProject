@extends('layouts.app')

@section('content')
<div class="container w-50 mw-30">
    <h1>Send a Message</h1>
    <p>Please fill the form below</p>
    <form class="col-lg-12" method="POST" action="{{route('contacts.store')}}">
        @csrf
        <div class="form-group">
            @if($user)
            <p type="text" class="form-control @error('email') border-danger @enderror" name="email" id="email" placeholder="Email">{{$user->email}}</p>
            <input type="hidden" class="form-control @error('email') border-danger @enderror" name="email" id="email" placeholder="Email" value="{{$user->email}}">
            @else
            <input type="text" class="form-control @error('email') border-danger @enderror" name="email" id="email" placeholder="Email" value="{{old('email')}}">
            @endif
            @error('email')
            <p class="alert text-danger">You must enter a email</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control @error('subject') border-danger @enderror" name="subject" id="subject" placeholder="Subject" value="{{old('subject')}}">
            @error('subject')
            <p class="alert text-danger">You must enter a subject</p>
            @enderror
        </div>
        <div class="form-group">
            <textarea class="form-control @error('message') border-danger @enderror}" name="message" placeholder="Message" id="message">{{old('message')}}</textarea>
            @error('message')
            <p class="alert text-danger">You must have a message</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection