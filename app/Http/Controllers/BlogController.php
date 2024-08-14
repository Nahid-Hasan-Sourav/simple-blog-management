<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Foundation\Application;


class BlogController extends Controller
{
    public function show(Blog $blog): Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('blog.show', compact('blog'));
    }
}
