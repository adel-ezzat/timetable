<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{

    public function getAllRoles()
    {
        return Role::all()->pluck('name', 'id');
    }

    public function getCurrentRole($model)
    {
        return $model->roles->pluck('name', 'id');
    }

    public function index()
    {
        $admins = Admin::all();
        return view('dashboard.admin.index', compact('admins'));
    }

    public function create()
    {
        $roles = $this->getAllRoles();
        return view('dashboard.admin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirmation',
            'role_id' => 'required'
        ]);

        $input = $request->all();
        $admin = Admin::create($input);
        $admin->assignRole($request->input('role_id'));

        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $currentRole = $this->getCurrentRole($admin);
        $allRolesExceptCurrent = Role::whereNotIn('name', [$currentRole[1]])->get();
        return view('dashboard.admin.edit', compact('admin', 'currentRole', 'allRolesExceptCurrent'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'sometimes|same:password_confirmation',
            'role_id' => 'required'
        ]);

        $input = $request->all();
        $admin = Admin::find($request->id);
        $admin->update($input);
        $admin->assignRole($request->input('role_id'));

        return redirect()->route('admin.index');
    }

    function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'This email is not exists in admins table'
        ]);

        $creds = $request->only('email', 'password');
        Auth::guard('admin')->attempt($creds);
        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('admin.login');
        }
    }


    public function destroy(Request $request)
    {
        $model = Admin::whereIn('id', $request['data'])->delete();
        if ($model) {
            $arr = ['msg' => 'Deleted successfully', 'icon' => 'success'];
        } else {
            $arr = ['msg' => 'Something went wrong!', 'icon' => 'danger'];
        }

        return response()->json($arr, 200);
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}