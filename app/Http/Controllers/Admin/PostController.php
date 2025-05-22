<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(30);
        $recentPosts = Post::latest()->limit(3)->get();
        $popularPosts = Post::orderBy('views', 'desc')->limit(3)->get();
        $allCategories = Category::withCount('posts')->orderBy('title')->get();
        return view('admin.posts.index', compact('posts', 'recentPosts', 'popularPosts', 'allCategories'));
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|integer|exists:tags,id',
            'thumbnail' => 'nullable|image',
        ]);

        $data = $request->all();

        $data['thumbnail'] = Post::uploadImage($request);
        $post = Post::create($data);
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }
        return redirect()->route('posts.index')->with('success', 'Статья добавлена!');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|integer|exists:tags,id',
            'thumbnail' => 'nullable|image',
        ]);
        $post = Post::find($id);
        $data = $request->all();
        $data['thumbnail'] = Post::uploadImage($request, $post->thumbnail);
        $post->update($data);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }
        return redirect()->route('posts.index')->with('success', 'Изменения сохранены!');
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }
        Storage::delete($post->thumbnail);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Статья удалена!');
    }

    public function show($id)
    {
        $post = Post::with(['category', 'tags'])->findOrFail($id);
        $post->increment('views');
        $recentPosts = Post::where('id', '!=', $post->id)->latest()->limit(3)->get();
        $popularPosts = Post::where('id', '!=', $post->id)->orderBy('views', 'desc')->limit(3)->get();

        $allCategories = Category::withCount('posts')->orderBy('title')->get();
        $allTags = Tag::withCount('posts')->orderBy('title')->get();
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->limit(2)
            ->get();

        return view('admin.posts.show', compact(
            'post',
            'relatedPosts',
            'recentPosts',
            'popularPosts',
            'allCategories',
            'allTags'
        ));
    }
}
