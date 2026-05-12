<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    public function show(Post $post)
    {
       
       if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
            return redirect()->route('posts.index')->with('error', 'You are not authorized to view this post.');
        }

        $post->load('user');
        
        return view('posts.show', compact('post'));
    }

    // This is where you will add the photo update method later
    public function update(Request $request, Post $post)
    {
        // Logic goes here
    }
}