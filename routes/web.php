<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/blog/{blog}',[\App\Http\Controllers\BlogController::class,'show'])->name('blog.show');

Route::get('/dashboard', function () {
    return view('admin.layouts.app');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('blogs', BlogController::class);
    Route::get('/get-all-blogs', [BlogController::class, 'getAllBlogs'])->name('blogs.all');
    Route::post('/upload-image', [BlogController::class, 'uploadImages'])->name('blog.uploadImages');
});




require __DIR__.'/auth.php';
