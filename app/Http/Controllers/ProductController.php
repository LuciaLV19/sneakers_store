<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'categories' => 'required|array',
            'stock' => 'nullable|integer',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description ?? '';
        $product->price = $request->price;
        $product->stock = $request->stock ?? 0;
        if ($request->hasFile('img')) {
            $product->img = $request->file('img')->store('products', 'public');
        }

        $product->save();

        $product->categories()->sync($request->categories);

        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'categories' => 'required|array',
            'stock' => 'nullable|integer',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description ?? '',
            'price' => $request->price,
            'stock' => $request->stock ?? 0,
            'img' => $request->hasFile('img') ? $request->file('img')->store('products', 'public') : $product->img,
            'categories' => $request->categories
        ]);

        $product->categories()->sync($request->categories);

        return redirect()->route('products.index') ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
