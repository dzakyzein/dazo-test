<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return Inertia::render('Products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Products/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|string|exists:categories,_id',
            'sku' => 'required|string',
            'active' => 'required|boolean',
            'stock' => 'required|numeric',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'imageUrl' => 'nullable|string'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }


    public function update(Request $request, Product $product)
    {
        if ($request->has('active') && $request->keys() === ['active']) {
            // update status doang
            $request->validate(['active' => 'required|boolean']);
            $product->update(['active' => $request->active]);
        } else {
            // update full product
            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|string|exists:categories,_id',
                'sku' => 'required|string',
                'active' => 'required|boolean',
                'stock' => 'required|numeric',
                'cost' => 'required|numeric',
                'price' => 'required|numeric',
                'special_price' => 'nullable|numeric',
                'imageUrl' => 'nullable|string',
            ]);
            $product->update($request->all());
        }
    }


    public function edit(Product $product)
    {
        return inertia('Products/Edit', [
            'product' => $product->load('category'),
            'categories' => Category::all(),
        ]);
    }
}
