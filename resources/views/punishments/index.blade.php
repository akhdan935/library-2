@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Punishments</h1>
    </div>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if (session()->has('warning'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session('warning') }}
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
      <a href="/punishments/create" class="btn btn-primary mb-3">Create new punishment</a>
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col" width="100">#</th>
            <th scope="col">Name</th>
            <th scope="col" width="100">Action</th>
          </tr>
        </thead>
        <tbody>
            @if ($punishments->count())
            @foreach ($punishments as $punishment)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $punishment->name }}</td>
              <td>
                <a href="/punishments/{{ $punishment->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <form action="/punishments/{{ $punishment->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                </form>
              </td>
            </tr>
            @endforeach
            @else
              <tr>
                <td colspan="4" class="text-center">No punishment found.</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
@endsection