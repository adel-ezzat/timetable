@extends('layouts.app')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create role</h4>
         
            <form method="POST" action="{{ route('role.store') }}">
                @csrf

            <div class="form-group">
                <label>Role Name</label>
                <input type="text" class="form-control" name="role" placeholder="role name" required>
              </div>

            <div class="row">
                @foreach ( $permissions as $permission)
                <div class="col-md-3">
                <div class="form-check">
                    <label class="form-check-label">
                        {{Form::checkbox('permission[]', $permission->id )}} {{ $permission->name }} <i class="input-helper">
                      </i>
                    </label>
                  </div>
                </div>
                @endforeach
            </div>
                
                <button type="submit" class="btn btn-primary mr-2">Create</button>
            </form>

            </div>
        </div>
        @endsection
