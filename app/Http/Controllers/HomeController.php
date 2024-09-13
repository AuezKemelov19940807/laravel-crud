<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $categories = Category::all();
        $posts = Post::all();
        return  view('welcome', ['categories' => $categories, 'posts' => $posts]);
    }
}
