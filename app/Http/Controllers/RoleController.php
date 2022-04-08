<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('dashboard.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $role = Role::create(['name' => $request->input('role')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('dashboard.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'role' => 'required',
            'id' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::find($request->id);
        $role->name = $request->input('role');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        // return redirect()->route('role.index')
        //     ->with('success', 'Role updated successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $model = Role::whereIn('id', $request['data'])->delete();

        if ($model) {
            $arr = ['msg' => 'Deleted successfully', 'icon' => 'success'];
        } else {
            $arr = ['msg' => 'Something went wrong!', 'icon' => 'danger'];
        }

        return response()->json($arr, 200);
    }
}
