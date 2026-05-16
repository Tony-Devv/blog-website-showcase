<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'description', 'user_id'];

        public function user()
        {
            // Make sure you have "use App\Models\User;" at the top
            return $this->belongsTo(User::class);
        }
}