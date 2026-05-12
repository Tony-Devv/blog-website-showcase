<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    
    
    public function show(Post $post)
{
       $post->load('user'); 
    
       return view('posts.show', compact('post')); 
}
   
}