<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {

        $categories = Category::all();

      return  view('categories.index', ['categories' => $categories]);
    }
    public function create() {

        return  view('categories.create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required',
        ]);

        $category = Category::create($validatedData);

        return  redirect()->route('categories.index')->with('success', 'Category created successfully');


    }
    public function show($id) {
        $category = Category::findOrFail($id);
        return  view('categories.show', ['category' => $category]);

    }
    public function edit($id) {
        $category = Category::findOrFail($id);
        return  view('categories.edit', ['category' => $category]);
    }
    public function update(Request $request, $id) {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return  redirect()->route('categories.index')->with('success', 'Category updated successfully');

    }
    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return  redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }


}
