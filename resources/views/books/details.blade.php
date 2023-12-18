@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-6">
            <div class="card" style="width: 100%;">
                <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top" alt="{{ $book->title }}">
                <div class="card-body">
                  <h5 class="card-title">{{ $book->title }}</h5>
                  <p class="card-text">Created at : {{ date('D, d M Y', strtotime($book->created_at)) }}</p>
                  <p class="card-text">Author : {{ $book->author->name }}</p>
                  <p class="card-text">Publisher : {{ $book->publisher->name }}</p>
                  <p class="card-text">Category : {{ $book->category->name }}</p>
                  <a href="/books" class="btn btn-primary">Go back</a>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection