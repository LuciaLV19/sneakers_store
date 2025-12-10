<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'categories' => 'required|array',
            'stock' => 'nullable|integer',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('img')){
            $data['img'] = $request->file('img')->store('products', 'public');
        }

        $product = Product::create($data);

        if (!empty($data['categories'])) {
            $product->categories()->sync($data['categories']);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'categories' => 'required|array',
            'stock' => 'nullable|integer',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if($request->hasFile('img')){
            if($product->img){
                Storage::disk('public')->delete($product->img);
            }
            $data['img'] = $request->file('img')->store('products', 'public');
        }

        $product->update($data);
        $product->categories()->sync($data['categories'] ?? []);

        return redirect()->route('products.index') ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if($product->img){
            Storage::disk('public')->delete($product->img);
        }
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
