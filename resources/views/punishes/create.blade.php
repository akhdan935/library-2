@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Punish</h1>
    </div>

    <div class="col-lg-12">
        <form method="POST" action="/punishes" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select class="form-select" name="user_id" id="user">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="punishment" class="form-label">Punishment</label>
                <select class="form-select" name="punishment_id" id="punishment">
                    @foreach ($punishments as $punishment)
                        <option value="{{ $punishment->id }}" @selected(old('punishment_id') == $punishment->id)>{{ $punishment->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Punish</button>
        </form>
    </div>
@endsection