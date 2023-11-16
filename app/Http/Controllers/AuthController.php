<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use App\Models\Role;

class AuthController extends Controller
{
    public function registerShow()
    {
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile'     =>  'required',
            'password'  =>  'required',
        ]);
        #dd($request->mobile);
        $user = User::create([
            'name'      => $request->name,
            'mobile'     =>  $request->mobile,
            'password'  =>  Hash::make($request->password),
            'created_at'    => date('Y-m-d'),
        ]);
        return redirect()->route('login.show');
    }

    public function loginShow()
    {
        return view ('auth.login');
    }

    public function loginSave(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('mobile', 'password');
        
        if(Auth::attempt($credentials))
        {
            $user = $request->user();
            #dd($user->can('pos'));    check user permission
            #$check = $user->hasRole('admin'); check user role
            #dd($check);
            #$user_permission = Permission::where('slug','pos')->first();
            #$role = Role::where('slug','admin')->first();
            #$role->permissions()->attach($user_permission);*/   add permission to role
            #$user->roles()->attach($role);    add role to user
            return redirect()->route('index');
        }else
        {
            return redirect()->back()->with('success','These credentials do not match our records');
        }
    }

}
