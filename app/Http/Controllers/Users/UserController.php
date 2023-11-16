<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        #dd($users);
        return view('users.users-list',compact('users'));
    }

    public function get_billers_ajax()
    {
        $users = User::select('id','name')->get();
        return response()->json([
            'users' => $users,
        ]);
    }
}
