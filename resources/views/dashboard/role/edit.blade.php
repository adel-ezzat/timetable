@extends('layouts.app')
@section('content')
<div class="col-12 grid-margin stretch-card">

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Role</h4>
         
            <form method="POST" action="{{ route('role.update-ajax') }}">
                @csrf

                {{ Form::hidden('id', $role->id) }}

            <div class="form-group">
                <label>Role Name</label>
                {!! Form::text('role', $role->name, array('placeholder' => 'role name','class' => 'form-control')) !!}

              </div>

            <div class="row">
                @foreach ( $permissions as $permission)
                <div class="col-md-3">
                <div class="form-check">
                    <label class="form-check-label">
                        {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $rolePermissions) ? true : false, array('class' => 'name')) }}  {{ $permission->name }}
                        <i class="input-helper">
                      </i>
                    </label>
                  </div>
                </div>
                @endforeach
            </div>
             @if ($role->id != 1)
                <button type="submit" class="btn btn-primary mr-2">Update</button>
             @endif
            </form>


            </div>
        </div>
        @endsection
