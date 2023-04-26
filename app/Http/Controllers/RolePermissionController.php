<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    //
    public function roles (Request $request){
        // $roles = ModelsRole::all();
    
        $roles = Role::all();
        return view('admin.roles',compact('roles'));

    }

    public function storeRole(Request $request){

        $validated = $request->validate([
            'name' =>'required',
        ]);
        // $role = Role::create($validated);        
        $role = Role::create(['name' => $request->name]);
        
        return redirect()->route('roles');
    }

    public function permissions (Request $request){
        // $roles = ModelsRole::all();
    
        $permissions = Permission::all();
        return view('admin.permissions',compact('permissions'));

    }

    public function storePermission(Request $request){

        $validated = $request->validate([
            'name' =>'required',
        ]);
        // $role = Role::create($validated);        
        $role = Permission::create(['name' => $request->name]);
        return redirect()->route('permissions');

    }
    
    public function rolePermissions(Request $request){

        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.roles-permissions',compact('roles','permissions'));
        
    }
}
