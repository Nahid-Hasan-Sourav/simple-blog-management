<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class DashboardController extends Controller
{
    public function index(): Application|Factory|View
    {
        $totallBlogs = Blog::where('user_id', auth()->id())->count();
        return view('admin.dashboard', compact('totallBlogs'));
    }
}
