<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Http\Requests\Role\RoleStoreRequest;

class RoleController extends Controller
{

    public function __construct()
    {
        $permissionName = 'Roles And Permissions';
        $this->middleware('auth:admin');
        $this->middleware("permission:Show $permissionName", ['only' => ['index']]);
        $this->middleware("permission:Add $permissionName", ['only' => ['create', 'store']]);
        $this->middleware("permission:Edit $permissionName", ['only' => ['edit','update']]);
        $this->middleware("permission:Delete $permissionName", ['only' => ['destroy']]);
    }

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

    public function store(RoleStoreRequest $request)
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

    public function update(RoleUpdateRequest $request)
    {
        $role = Role::find($request->id);
        $role->name = $request->input('role');
        $role->save();
        $role->syncPermissions($request->input('permission'));
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
