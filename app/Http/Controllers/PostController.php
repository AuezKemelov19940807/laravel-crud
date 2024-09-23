<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::with('category')->get();
        return view('posts.index', ['posts' => $posts, 'categories' => $categories]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['$categories' => $categories]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $post = Post::create($validatedData);


        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', ['post' => $post]);

    }

    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }


    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Валидация входящих данных
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id', // Проверка существования категории
        ]);

        // Обновление свойств поста
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->category_id = $validatedData['category_id']; // Правильное присваивание категории
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated!');

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

}
