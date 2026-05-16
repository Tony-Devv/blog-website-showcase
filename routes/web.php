<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('posts.index');
    }
    return redirect()->route('login');
});

/* AUTH */
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.check');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

/* POSTS */


Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    Route::get('/posts/create', function () {return view('posts.create');})->name('posts.create');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/user/posts', [UserPostController::class, 'index'])->name('users.posts');

    
    Route::get('/news', [NewsController::class, 'index']);
    Route::post('/news/fetch', [NewsController::class, 'fetchNews']);
});



// Route::get('/user/posts', [UserPostController::class, 'index'])->name('users.posts');
// /* TEST */
// Route::get('/test', function () {
//     return view('test');
// });


/* News */ 
