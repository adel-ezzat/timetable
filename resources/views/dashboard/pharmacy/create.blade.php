@extends('layouts.app')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Pharmacy</h4>
         
            <form method="POST" action="{{ route('pharmacy.store') }}">
                @csrf

            <div class="form-group">
                <label>Pharmacy Name</label>
                <input type="text" class="form-control" name="name" placeholder="pharmacy name" required>
              </div>
                
                <button type="submit" class="btn btn-primary mr-2">Create</button>
            </form>

            </div>
        </div>
        @endsection
