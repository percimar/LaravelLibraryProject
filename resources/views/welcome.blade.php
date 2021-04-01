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

    <!-- <div class="item4">Right</div> -->
    <!-- <div class="item5">Footer</div> -->
  </div>
  @endsection