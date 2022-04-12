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

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $users = User::all()->count();
        $admins = Admin::all()->count();
        $pharmacies = Pharmacy::all()->count();
        $roles = Role::all()->count();
        $timetables = Timetable::distinct('date')->count('date');

        return view('dashboard.dashboard.index', compact(
            'users',
            'admins',
            'pharmacies',
            'roles',
            'timetables',
        ));
    }
}
