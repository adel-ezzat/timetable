@extends('layouts.app')

@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Manager</h4>

            <form method="POST" action="{{ route('admin.update-ajax') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $admin->id }}">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name', $admin->name) }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('Email Address') }}</label>


                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email', $admin->email) }}" autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label>{{ __('Password') }}</label>


                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label>
                        {{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label">Role</label>
                        <select class="form-control" name="role_id">
                            @foreach ($currentRole as $role)
                            <option value="{{ $role->id }} " selected> {{ $role->name }} </option>
                            @endforeach

                            @foreach ($allRolesExceptCurrent as $id => $role)
                            <option value=" {{ $role->id }}"> {{ $role->name }} </option>
                            @endforeach
                        </select>
                </div>


                <button type="submit" class="btn btn-primary mr-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
