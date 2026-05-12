<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // VIEW ALL POSTS
    public function index()
    {
        return response()->json(Post::with('user')->latest()->get());
    }

    // ADD POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:10000',
            'image' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post
        ]);
    }

    // UPDATE POST
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:10000',
            'image' => 'nullable|string',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post updated successfully'
        ]);
    }

    // DELETE POST
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}