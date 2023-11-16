<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
    public function index()
    {
        
        $roles = Role::all();
        return view('users.create-user',compact('roles'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:users',
            'role'   =>  'required',
            'password'   =>  'required',
        ], [
            'mobile.unique' =>  __('error phone unique'),
        ]);
        dd($request->name);
        $role = Role::where('slug',$request->role)->first();
        $user = User::create([
            'name'  =>  $request->name,
            'mobile'    =>  $request->mobile,
            'password'  =>  Hash::make($request->password),
            'created_at'    => date('Y-m-d'),
        ]);
        $user->roles()->attach($role);
        return redirect()->route('users.show');
    }
}
