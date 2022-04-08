@extends('layouts.app')
@section('content')

<div class="col-12 grid-margin stretch-card">

    <div class="card-body">
        <h4 class="card-title">Dashboard</h4>

        <div class="row">
            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Users</h4>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-inline-block pt-3">
                                <div class="d-flex">
                                    <h2 class="mb-0">{{ $users }}</h2>
                                </div>
                            </div>
                            <div class="d-inline-block">
                                <div class="bg-primary px-4 py-2 rounded">
                                    <i class="mdi mdi-account-multiple text-white icon-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Managers</h4>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-inline-block pt-3">
                                <div class="d-flex">
                                    <h2 class="mb-0">{{ $admins }}</h2>
                                </div>
                            </div>
                            <div class="d-inline-block">
                                <div class="bg-warning px-4 py-2 rounded">
                                    <i class="mdi mdi-account-star text-white icon-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Pharmacies</h4>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-inline-block pt-3">
                                <div class="d-flex">
                                    <h2 class="mb-0">{{ $pharmacies }}</h2>
                                </div>
                            </div>
                            <div class="d-inline-block">
                                <div class="bg-success px-4 py-2 rounded">
                                    <i class="mdi mdi-pill text-white icon-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Roles</h4>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-inline-block pt-3">
                                <div class="d-flex">
                                    <h2 class="mb-0">{{ $roles }}</h2>
                                </div>
                            </div>
                            <div class="d-inline-block">
                                <div class="bg-danger px-4 py-2 rounded">
                                    <i class="mdi mdi-security text-white icon-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Timetables</h4>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-inline-block pt-3">
                                <div class="d-flex">
                                    <h2 class="mb-0">{{ $timetables }}</h2>
                                </div>
                            </div>
                            <div class="d-inline-block">
                                <div class="bg-info px-4 py-2 rounded">
                                    <i class="mdi mdi-calendar-clock text-white icon-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
