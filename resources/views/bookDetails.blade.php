@extends('layouts.app')

@section('content')
    <div class="col-lg-8 m-auto">
        <img src={{ $book->image }} />
        <br /><br />
        <h1>{{ $book->title }}</h1>
        <h2>{{ $book->publication }}</h2>
        <br />
        <h3>Written by: {{ $book->author }}</h3>
        <h3>Under: {{ $book->category }}</h3>
        <br />
        <a href={{ route('reserve', $book->id) }} class="btn btn-primary">Reserve</a>
        <br /><br />
        @if ($isreviewallowed)
            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Leave a review</label>
                    <textarea class="form-control @error('review') border-danger @enderror" name="review" id="review"
                        placeholder="Review"></textarea>
                    @error('review')
                        <p class="alert text-danger">You must enter a review</p>
                    @enderror
                    <input type="hidden" name="book_id" value={{ $book->id }} />
                    <input type="hidden" name="user_id" value={{ $user }} />
                </div>
                <button type="submit" class="btn btn-primary">Leave Review</button>
            </form>
        @endif
        @if (count($reviews) > 0)
            <br /><br /><h2>Reviews</h2><br />
        @endif
        @foreach ($reviews as $review)
            <div class="card" style="border-bottom: 1px solid; margin: 20px 0px;">
                <div class="card-body">
                    <h5>By {{ $review->from }}</h5>
                    <p class=" card-text text-muted">{{$review->review_date}}</p>
                    <p class="card-text">{{ $review->review}}</p>
                    @role('admin')
                        <form method="POST" action={{route('reviews.destroy',['review'=>$review->id])}}>
                            @csrf
                            @method('delete')
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn btn-danger" value="Delete" />
                            </div>
                        </form>
                    @endrole
                </div>
            </div>
        @endforeach
    </div>
@endsection
