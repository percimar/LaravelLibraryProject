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
                @if($user->role == 'admin')
                    <tr>     
                        <td>{{$contact->email}}</td>         
                        <td>{{$contact->subject}}</td>
                        <td>{{$contact->message}}</td>
                    </tr>
                @endif
                @if($user->role == 'member') 
                    @if($user->email == $contact->email)
                        <tr>
                                <td>{{$contact->email}}</td> 
                                <td>{{$contact->subject}}</td>
                                <td>{{$contact->message}}</td>
                        </tr>
                    @endif   
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection