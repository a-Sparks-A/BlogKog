<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(3);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success', 'Тег добавлен!');
    }

    public function show(string $id)
    {
        $tag = Tag::where('id', $id)->findOrFail($id);
        $posts = $tag->posts()->orderBy('id', 'desc')->paginate(3);
        $recentPosts = Post::latest()->limit(3)->get();
        $popularPosts = Post::orderBy('views', 'desc')->limit(3)->get();
        $allCategories = Category::withCount('posts')->get();


        $allTags = Tag::withCount('posts')
            ->orderBy('title')
            ->get();


        $popularTags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();


        return view('admin.tags.show', compact(
            'tag',
            'posts',
            'recentPosts',
            'popularPosts',
            'allCategories',
            'allTags',
            'popularTags'
        ));
    }

    public function edit(string $id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $tag = Tag::find($id);
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('success', 'Изменения сохранены');
    }

    public function destroy(string $id)
    {
        Tag::destroy($id);
        return redirect()->route('tags.index')->with('success', 'Тег удален!');
    }
}
