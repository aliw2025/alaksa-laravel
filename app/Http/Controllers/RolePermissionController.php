<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    public function editRole($id)
    {
        $roles = Role::all();
        $role = Role::find($id);
        return view('admin.roles',compact('roles','role'));
    }

    public function editPermission($id)
    {
        $permissions = Permission::all();
        $permission = Permission::find($id);
        return view('admin.permissions',compact('permissions','permission'));
    }

    public function updateRole(Request $request,$id){

        $validated = $request->validate([
            'name' =>'required',
        ]);
        // $role = Role::create($validated);        
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('roles');
    }

    public function updatePermission(Request $request,$id){

        $validated = $request->validate([
            'name' =>'required',
        ]);
        // $role = Role::create($validated);        
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();
        return redirect()->route('permissions');
    }
    public function storeRole(Request $request){

        $validated = $request->validate([
            'name' =>'required',
        ]);
        // $role = Role::create($validated);        
        $role = Role::create(['name' => $request->name]);
        return redirect()->route('roles');  
    }

    public function deleteRole($id)
    {
        
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles');
    }


    public function  deletePermission($id)
    {
        
        $role = Permission::find($id);
        $role->delete();
        return redirect()->route('permissions');
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

    public function storeRolePermission(Request $request){


        $role = Role:: find($request->role);

        $role->givePermissionTo($request->permission);

        return redirect()->route('roles-permissions');

        
    }
    public function unassignRolePermission(Request $request){

        $role = Role:: find($request->role_id);
        $role->revokePermissionTo($request->permission_id);
        return redirect()->route('roles-permissions');

    }
    //  get role permissions ajax call
    public function getRolePermissions(Request $request){

        $role = Role:: find($request->id);

        return $role->permissions;

    }
    //  get user roles ajax call
    public function getUserRoles(Request $request){

        $user = User:: find($request->id);
        return $user->roles;
    }
   
    //  user roles index page
    public function userRoles(Request $request)
    {
        $users  = User::all();
        $roles = Role ::all();
        return view('admin.user-roles',compact('users','roles'));
    }

    // store user roles
    public function storeUserRoles(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->user);
        
        $user->assignRole($request->role);
        return redirect()->route('user-roles');
        
    }
    public function unassignUserRoles(Request $request)
    {
        $user = User :: find($request->user_id);
        $user->removeRole($request->role_id);
        return redirect()->route('user-roles');

    }
    
}
