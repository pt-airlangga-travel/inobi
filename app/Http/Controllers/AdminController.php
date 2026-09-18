<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AdminController extends Controller
{
    public function dashboard()
    {
        $postCount = Post::count();

        return view('admin.dashboard', compact('postCount'));
    }
}
