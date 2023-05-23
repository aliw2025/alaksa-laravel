<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{

    public function userPassCreate(Request $request)
    {
        
        return view('admin.change_pass_user');
    }

    //
    public function userPassPost(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return view('admin.change_pass_user')->with('message', 'Your password has been changed successfully.');
    
        // return redirect()->route('user-password-change')->with('message', 'Your password has been changed successfully.');
    }

    public function adminPassPost(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::find($request->user_id);
        

        $user->password = Hash::make($request->password);
        $user->save();

        return view('admin.change_pass_admin',compact('user'))->with('message', 'Your password has been changed successfully.');
    }
    public function adminPassCreate($id)
    {
        $user = User::find($id);
        return view('admin.change_pass_admin',compact('user'));
    }
}
