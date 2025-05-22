<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            's' => 'required',
        ]);

        $s = $request->s;
        $posts = Post::search($s)->with('category')->latest()->paginate(2);
        return view('admin.posts.search', compact('posts', 's'));
    }
}
