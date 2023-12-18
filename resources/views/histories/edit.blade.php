@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit History</h1>
    </div>

    <div class="col-lg-12">
        <form method="POST" action="/histories/{{ $history->id }}" class="mb-5">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select class="form-select" name="user_id" id="user">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id', $history->user_id) == $user->id)>{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book</label>
                <select class="form-select" name="book_id" id="book">
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" @selected(old('book_id', $history->book_id) == $book->id)>{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="borrow_from" class="form-label">Borrow From</label>
                <input type="date" class="form-control @error('borrow_from') is-invalid @enderror" id="borrow_from" name="borrow_from" value="{{ old('borrow_from', date('Y-m-d', strtotime($history->borrow_from))) }}">
                @error('borrow_from')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="borrow_until" class="form-label">Borrow Until</label>
                <input type="date" class="form-control @error('borrow_until') is-invalid @enderror" id="borrow_until" name="borrow_until" value="{{ old('borrow_until', date('Y-m-d', strtotime($history->borrow_until))) }}">
                @error('borrow_until')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update History</button>
        </form>
    </div>
@endsection