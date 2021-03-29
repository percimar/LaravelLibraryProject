@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Users</h1>
    @if(null !== session('alert'))
    <br />
    <div class="alert alert-primary" role="alert">
        {{session('alert') ?? '' }}
    </div>
    @endif
    <br />
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                        <td>{{$user->name}}</td> 
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td><a class="btn btn-primary" href="/users/{{$user->id}}/edit">Change Role</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection