<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('_id', 'desc')->paginate(10);

        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Category::create($request->only('name', 'description'));

        return back()->with('success', 'Category created');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $category->update($request->only('name', 'description'));

        return back()->with('success', 'Category updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted');
    }
}
