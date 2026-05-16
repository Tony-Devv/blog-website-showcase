<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show Register Form
    public function create()
    {
        return view('auth.register');
    }

    // Store User
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|min:3|max:30',
            'username' => 'required|min:3|max:30|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|regex:/^[0-9]{6,15}$/',
            'password' => 'required|min:8',
        ]);

        // Insert User
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Redirect
        return redirect()->route('login')->with('success', 'Account Created Successfully');
    }

    // show login page
    public function loginForm()
    {
        return view('auth.login');
    }

    // handle login
    public function login(Request $request)
    {
        // validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('posts.index')->with('success', 'Logged in successfully');
        }

        // failed login
        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    // handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


}
