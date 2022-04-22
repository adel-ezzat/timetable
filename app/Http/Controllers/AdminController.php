<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminCheckRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;

class AdminController extends Controller
{
    public function __construct()
    {
        $permissionName = 'Managers';
        $this->middleware('auth:admin', ['except' => ['login', 'check']]);
        $this->middleware("permission:Show $permissionName", ['only' => ['index']]);
        $this->middleware("permission:Add $permissionName", ['only' => ['create', 'store']]);
        $this->middleware("permission:Edit $permissionName", ['only' => ['edit','update']]);
        $this->middleware("permission:Delete $permissionName", ['only' => ['destroy']]);
    }

    public function getAllRoles()
    {
        return Role::all()->pluck('name', 'id');
    }

    public function getCurrentRole($model)
    {
        return $model->roles;
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

    public function store(AdminStoreRequest $request)
    {
        $input = $request->all();
        $admin = Admin::create($input);
        $admin->assignRole($request->input('role_id'));

        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $currentRole = $this->getCurrentRole($admin);
        $allRolesExceptCurrent = Role::whereNotIn('name', [$currentRole->first()->name])->get();
        return view('dashboard.admin.edit', compact('admin', 'currentRole', 'allRolesExceptCurrent'));
    }

    public function update(AdminUpdateRequest $request)
    {
        $input = $request->all();
        $admin = Admin::find($request->id);
        $admin->update($input);
        $admin->syncRoles($request->input('role_id'));

        return redirect()->route('admin.index');
    }

    public function login()
    {
        return view('dashboard.admin.login');
    }

    function check(AdminCheckRequest $request)
    {
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
