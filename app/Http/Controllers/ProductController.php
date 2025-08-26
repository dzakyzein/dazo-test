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
        // PERBAIKAN: Sesuaikan validasi dengan field dari form Vue.js
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|string|exists:categories,_id', // Menggunakan _id untuk MongoDB
            'sku' => 'required|string',
            'active' => 'required|boolean',
            'stock' => 'required|numeric',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
        ]);

        // Simpan data ke koleksi 'products'
        Product::create($request->all());

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
