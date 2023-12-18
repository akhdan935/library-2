@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Histories</h1>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if (session()->has('danger'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('danger') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive">
      <a href="/histories/create" class="btn btn-primary mb-3">Create new history</a>
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Book</th>
            <th scope="col">Borrow From</th>
            <th scope="col">Borrow Until</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @if ($histories->count())
            @foreach ($histories as $history)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $history->user->username }}</td>
              <td>{{ $history->book->title }}</td>
              <td>{{ date("D, d M Y", strtotime($history->borrow_from)) }}</td>
              <td>{{ date("D, d M Y", strtotime($history->borrow_until)) }}</td>
              <td>
                <a href="/histories/{{ $history->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <form action="/histories/{{ $history->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                </form>
              </td>
            </tr>
            @endforeach
            @else
              <tr>
                <td colspan="4" class="text-center">No history found.</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
@endsection