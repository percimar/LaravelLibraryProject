@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Reservation History</h1>
    <br />
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Book ISBN</th>
                <th scope="col">Book Title</th>
                <th scope="col">Reserve Date</th>
                <th scope="col">Expired Date</th>
                <th scope="col">Borrow Date</th>
                <th scope="col">Returned Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $r)
                <tr>
                        <td>{{$r->book->isbn}}</td> 
                        <td>{{$r->book->title}}</td>
                        <td>{{$r->reserve_date}}</td>
                        @if($r->status == "expired")
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
                        <td>{{$r->status}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection