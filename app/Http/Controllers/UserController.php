<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show registration form
    public function userList()
    {
        return view('user.user-list');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'user', // default usertype
        ]);

        return redirect('/login')->with('success', 'Account created. You can now login.');
    }

    // View user profile
    public function profile()
    {
        return view('user.profile', [
            'user' => auth()->user()
        ]);
    }
}
