<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Категория добавлена!');
    }

    public function show(string $id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        $posts = $category->posts()->orderBy('id', 'desc')->paginate(3);
        $recentPosts = Post::latest()->limit(3)->get();
        $popularPosts = Post::orderBy('views', 'desc')->limit(3)->get();
        $allCategories = Category::withCount('posts')->get();
        return view('admin.categories.show', compact('category', 'posts', 'recentPosts', 'popularPosts', 'allCategories'));
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Изменения сохранены');
    }

    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index')->with('success', 'Категория удалена!');
    }
}
