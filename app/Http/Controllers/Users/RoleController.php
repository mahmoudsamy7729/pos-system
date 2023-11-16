<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionsCategories;
use App\Models\RolesPermissions;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('users.roles-list',compact('roles'));
    }

    public function create()
    {
        return view('users.create-role');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description'   =>  'required',
        ]);
        $role = Role::create([
            'name'  =>  $request->name,
            'slug'  =>  $request->slug,
            'description'   =>  $request->description,
            'created_at'    =>  date('Y-m-d'),
        ]);
        return redirect()->route('roles.show');
    }

    public function role_permissions($role_id)
    {
        $role = Role::find($role_id);
        $modules = PermissionsCategories::with('permissions')->get();
        $permissions = RolesPermissions::with('permissionName')->select('permission_id')->where('role_id',$role_id)->get();
        $IDS = $permissions->pluck('permission_id')->toArray();
        return view('users.roles-permissions',compact('modules','IDS','role'));
    }

    public function SavePermissions(Request $request , $role_id)
    {
        $role = Role::find($role_id);
        #dd($role);
        $request->validate([
            'permission'     =>  'nullable'
        ]);
        if($request->permission == null)
        {
            $request->permission = [];
        }
        $slugs = [];
        $permissions = RolesPermissions::with('permissionName')->select('permission_id')->where('role_id',$role_id)->get();
        foreach($permissions as $permission)
        {
            array_push($slugs, $permission->permissionName->slug);
        }        
        foreach($slugs as $slug)
        {
            if(!in_array($slug,$request->permission))
            {
                $permission = Permission::where('slug',$slug)->first();
                $detach_permission = RolesPermissions::where('role_id',$role_id)->where('permission_id',$permission->id)->delete();
            }
        }
        foreach($request->permission as $per)
        {
            
            if(!in_array($per,$slugs))
            {
                $permission = Permission::where('slug',$per)->first();
                $role->permissions()->attach($permission);
            }
        }
        return redirect()->route('role.permissions', ['role_id' => $role_id]);

        
    }
}
