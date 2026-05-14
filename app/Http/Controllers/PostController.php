<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /* =========================
        VIEW ALL POSTS
    ========================= */
    public function index()
    {
        $posts = Post::with('user')
            ->when(Auth::check(), function ($query) {
                return $query->where('user_id', '!=', Auth::id());
            })
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    /* =========================
        SHOW SINGLE POST
    ========================= */
    public function show(Post $post)
    {

        $post->load('user');

        return view('posts.show', compact('post'));
    }

    /* =========================
        CREATE POST (STORE)
    ========================= */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('posts', 'public');
        }

        $validated['user_id'] = Auth::id();

        Post::create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully');
    }

    /* =========================
        EDIT PAGE
    ========================= */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.create', compact('post'));
    }

    /* =========================
        UPDATE POST
    ========================= */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // handle image update
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /* =========================
        DELETE POST
    ========================= */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }

    
}