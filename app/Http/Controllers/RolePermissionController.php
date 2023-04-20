<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    //
    public function roles (Request $request){
        // $roles = ModelsRole::all();

        return view('admin.roles');
    }

}
