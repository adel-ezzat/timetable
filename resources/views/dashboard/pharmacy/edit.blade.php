@extends('layouts.app')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Pharmacy</h4>
         
            <form method="POST" action="{{ route('pharmacy.update-ajax') }}">
                @csrf
                {{ Form::hidden('id', $pharmacy->id) }}

            <div class="form-group">
                <label>Pharmacy Name</label>
                {{-- <input type="text" class="form-control" name="name" placeholder="pharmacy name" required> --}}
                {!! Form::text('name', $pharmacy->name, array('placeholder' => 'pharmacy name','class' => 'form-control', 'required')) !!}

              </div>
                
                <button type="submit" class="btn btn-primary mr-2">Update</button>
            </form>

            </div>
        </div>
        @endsection
