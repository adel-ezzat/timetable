<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{

    public function __construct()
    {
        $permissionName = 'Users';
        $this->middleware('auth:admin');
        $this->middleware("permission:Show $permissionName", ['only' => ['index']]);
        $this->middleware("permission:Add $permissionName", ['only' => ['create', 'store']]);
        $this->middleware("permission:Edit $permissionName", ['only' => ['edit','update']]);
        $this->middleware("permission:Delete $permissionName", ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $input = $request->all();
        User::create($input);

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.user.edit', compact('user'));
    }

     public function update(UserUpdateRequest $request)
    {
        $input = $request->all();
        $user = User::find($request->id);
        $user->update($input);

        return redirect()->route('user.index');
    }

    public function destroy(Request $request)
    {
        $model = User::whereIn('id', $request['data'])->delete();
        if ($model) {
            $arr = ['msg' => 'Deleted successfully', 'icon' => 'success'];
        } else {
            $arr = ['msg' => 'Something went wrong!', 'icon' => 'danger'];
        }

        return response()->json($arr, 200);
    }   
}
