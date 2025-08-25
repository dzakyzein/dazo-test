<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('_id', 'desc')->paginate(10);
        $categories = Category::select(['_id', 'name'])->get();
        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Products/Create', [
            'categories' => Category::select(['_id', 'name'])->get(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created');
    }

    public function edit(Product $product)
    {
        $product->load('category');
        return Inertia::render('Products/Edit', [
            'product' => $product,
            'categories' => Category::select(['_id', 'name'])->get(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted');
    }
}
