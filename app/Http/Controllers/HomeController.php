<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): Application|Factory|View
    {
        $blogs = Blog::with([
            'user' => function ($query) {
                $query->select('id', 'name');
            },
        ])->get();

        return view('home', compact('blogs'));
    }

    public function show(string $blog)
    {
        $blog=Blog::find($blog);

        return view('blog.show', compact('blog'));
    }



}
