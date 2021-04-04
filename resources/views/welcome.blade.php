@extends('layouts.app')

@section('content')

<div class="grid-container">
  <div class="item2">
    Categories
    <div id="loadCategories">
    </div>
  </div>

  <div class="item3">
    <input class="searchInput" id="searchBooks" placeholder="Type to Search..." />

    <table class="w-100 center">
      <thead>
        <tr>
          <th>Cover</th>
          <th>Title</th>
          <th>Author</th>
          <th>Category</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="loadBooks">
        <tr>
        </tr>
      </tbody>
    </table>

    <!-- <div class="item5">Footer</div> -->
  </div>
  <div class="item4 pr-4 pl-4">
  Did you know? La Biblioteca offers study rooms free of cost! 
  They are perfect if you need a quiet, distraction free place to work or study. 
  All you need to do is book it in advance. <br/>
  <a class="btn btn-primary" href={{route('rooms.index')}}>Reserve Now</a>
  </div>
</div>

  @endsection