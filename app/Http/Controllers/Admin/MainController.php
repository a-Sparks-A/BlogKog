<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::count();
        $categories = Category::count();
        $tags = Tag::count();

        return view('admin.index', compact('posts', 'categories', 'tags'));
    }
}
