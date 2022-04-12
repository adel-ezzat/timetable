@extends('layouts.app')

@section('content')
<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit User</h4>

            <form method="POST" action="{{ route('user.update-ajax') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('Email Address') }}</label>


                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email', $user->email) }}"  autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label>{{ __('Password') }}</label>


                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label>
                        {{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                </div>


                <button type="submit" class="btn btn-primary mr-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
