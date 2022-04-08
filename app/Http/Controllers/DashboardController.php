<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pharmacy;
use App\Models\Timetable;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __invoke()
    {
        $users = User::all()->count();
        $admins = Admin::all()->count();
        $pharmacies = Pharmacy::all()->count();
        $roles = Role::all()->count();
        $timetables = Timetable::distinct('user_id')->count('user_id');

        return view('dashboard.dashboard.index', compact(
            'users',
            'admins',
            'pharmacies',
            'roles',
            'timetables',
        ));
    }
}
