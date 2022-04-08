<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;



class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:password_confirmation',
        ]);

        $input = $request->all();
        User::create($input);

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.user.edit', compact('user'));
    }

     public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'sometimes|same:password_confirmation',
        ]);

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
