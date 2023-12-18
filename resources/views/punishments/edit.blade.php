@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Punishment</h1>
    </div>

    <div class="col-lg-12">
        <form method="POST" action="/punishments/{{ $punishment->id }}" class="mb-5">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $punishment->name) }}" autofocus>
                @error('name')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Punishment</button>
        </form>
    </div>
@endsection