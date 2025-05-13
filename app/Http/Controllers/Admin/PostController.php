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
        $post = Post::with('category')->orderBy('id', 'desc')->paginate(30);
        $recentPosts = Post::latest()->limit(3)->get();
        $popularPosts = Post::orderBy('views', 'desc')->limit(3)->get();
        $categories = Category::withCount('posts')->get();
        return view('admin.posts.index', compact('post', 'recentPosts', 'popularPosts', 'categories'));
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

    public function show(Request $request, $id)
    {
        $post = Post::with(['category', 'tags'])->findOrFail($id);

        // Увеличиваем счетчик просмотров
        $post->views += 1;
        $post->update();

        // Получаем связанные посты (например, из той же категории)
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(2)
            ->get();

        // Получаем последние посты для боковой панели
        $recentPosts = Post::latest()->limit(3)->get();
        $popularPosts = Post::orderBy('views', 'desc')->limit(3)->get();

        // Получаем категории с количеством постов
        $categories = Category::withCount('posts')->get();
        return view('admin.posts.show', compact('post', 'relatedPosts', 'recentPosts', 'categories'));
    }
}
