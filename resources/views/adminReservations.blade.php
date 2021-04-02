@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Reservations</h1>
    <a href="{{route('returnedBooks')}}">View Reservation History</a>
    <p>Today: {{today()->toDateString()}}</p>
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Book ISBN</th>
                <th scope="col">Book Title</th>
                <th scope="col">User</th>
                <th scope="col">Reserve Date</th>
                <th scope="col">Expiry Date</th>
                <th scope="col">Borrow Date</th>
                <th scope="col">Due Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $r)
                <tr>
                        <td>{{$r->book->isbn}}</td> 
                        <td>{{$r->book->title}}</td>
                        <td>{{$r->user->email}}</td>
                        <td>{{$r->reserve_date}}</td>
                        @if($r->status == "reserved")
                        <td>{{$r->due_date}}</td>
                        @else
                        <td></td>
                        @endif
                        @if(isset($r->borrow_date))
                        <td>{{$r->borrow_date}}</td>
                        <td>{{$r->due_date}}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        @if($r->status == "reserved")
                        <td><a class="btn btn-primary" href={{ route('borrow', $r->id) }}>Check Out</a></td>
                        @else
                        <td><a class="btn btn-primary" href={{ route('return', $r->id) }}>Return</a></td>
                        @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection