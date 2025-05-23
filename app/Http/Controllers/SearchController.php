<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category; // Добавляем импорт модели Category
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            's' => 'required|string|min:1',
        ]);
        $s = $request->s;
        $posts = Post::like($s)->with('category')->paginate(2);
        $recentPosts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $popularPosts = Post::orderBy('views', 'desc')->take(3)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
        $popularCategoriesSidebar = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $allCategories = Category::all();
        return view('admin.posts.search', compact(
            'posts',
            's',
            'recentPosts',
            'popularPosts',
            'categories',
            'popularCategoriesSidebar',
            'allCategories'
        ));
    }
}
