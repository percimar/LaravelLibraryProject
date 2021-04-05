@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Users Books Requests</h1>
    <br />
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th>title</th>
                <th>author</th>
                <th style="width: 10px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>{{$request->title}}</td>
                <td>{{$request->author}}</td>
                <td class="test text-center">
                    <a class="btn btn-success" href="{{ route('books.createBookFromRequest', [$request->title, $request->author]) }}">Accept</a><span style="width: 10px;"></span>
                    <form method="POST" action={{ route('request.destroy', $request) }}>
                        @csrf
                        @method('delete')
                        <input type="submit" href="#" class="btn btn-danger p-2 d-inline-flex" value="Decline" />
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection