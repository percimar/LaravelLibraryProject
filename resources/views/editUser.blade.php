@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Change {{$user->name}}'s Role</h1>
    <form class="col-lg-8" method="POST" action="/users/{{$user->id}}">
        @method('PUT')
        @csrf
        <div class="form-group mb-2">
            <label for="name">Username</label>
            <input type="text" class="form-control"
            name="name"
            id="name"
            value="{{$user->name}}"
            disabled>
        </div>
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="text" class="form-control"
            email="email"
            id="email"
            value="{{$user->email}}"
            disabled>
        </div>
        <div class="form-group mb-2">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role">
                @foreach ($roles as $role)
                    @if ($role == $user->role)
                    <option selected>
                    @else
                    <option>
                    @endif
                    {{$role}}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
