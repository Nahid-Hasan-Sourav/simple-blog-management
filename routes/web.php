<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/blog/{blog}',[\App\Http\Controllers\BlogController::class,'show'])->name('blog.show');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('blogs', BlogController::class);
    Route::get('/get-all-blogs', [BlogController::class, 'getAllBlogs'])->name('blogs.all');
    Route::post('/upload-image', [BlogController::class, 'uploadImages'])->name('blog.uploadImages');
});




require __DIR__.'/auth.php';
