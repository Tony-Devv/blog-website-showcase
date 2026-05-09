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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:100',
        ]);

        // Insert User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
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

            return redirect('/posts.index')->with('success', 'Logged in successfully');
        }

        // failed login
        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }


}
