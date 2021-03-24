@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>User Messages</h1>
    <br />
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Subject</th>
                <th scope="col">Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                @foreach($users as $user)
                @if($user->id == $contact->user_id)
                <td>{{$user->name}}</td>
                @endif
                @endforeach
                <td>{{$contact->subject}}</td>
                <td>{{$contact->message}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection