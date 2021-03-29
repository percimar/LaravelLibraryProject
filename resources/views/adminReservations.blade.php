@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Reservations</h1>
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
                <th scope="col">Book ISBN</th>
                <th scope="col">Book Title</th>
                <th scope="col">User Name</th>
                <th scope="col">User Email</th>
                <th scope="col">Reserve Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $r)
                <tr>
                        <td>{{$r->book->isbn}}</td> 
                        <td>{{$r->book->title}}</td>
                        <td>{{$r->user->name}}</td>
                        <td>{{$r->user->email}}</td>
                        <td>{{$r->reserve_date}}</td>
                        <td><a class="btn btn-primary" href={{ route('borrow', $r->id) }}>Borrow</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection