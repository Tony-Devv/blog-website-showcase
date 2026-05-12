<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // These match your table columns exactly
    // app/Models/Post.php
        protected $fillable = ['title', 'image', 'description', 'user_id'];

        public function user()
        {
            // Make sure you have "use App\Models\User;" at the top
            return $this->belongsTo(User::class);
        }
}