<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;



class UserPostController extends Controller {
    /* =========================
        GET ALL POSTS FOR A USER
    ========================= */

    public function index() {
        $user = auth()->user();
        $posts = $user->posts()
            ->with('user')
            ->get();

        return view('users.posts', compact('user', 'posts'));
    }


    
}