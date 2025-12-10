<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Shows the cart contents.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve the cart from the session. If it doesn't exist, it's an empty array.
        $cart = Session::get('cart', []);
                
        // The 'cart.index' view should iterate over $cart to display products, quantities, and totals.
        return view('cart.index', compact('cart'));
    }

    /**
     * Adds a product to the cart.
     * * @param \App\Models\Product $product (Route Model Binding)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Product $product, Request $request)
    {
        // 1. Get the current cart from the session
        $cart = Session::get('cart', []);
        
        // 2. Define the quantity to add (default is 1)
        $quantity = $request->input('quantity', 1); 

        // 3. Logic to add or update the product
        $productId = $product->id;
        
        if (isset($cart[$productId])) {
            // The product is already in the cart, increase quantity
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // The product is not in the cart, add it
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'img' => $product->img,
                'description' => $product->description,
                'id' => $product->id,
                'slug' => $product->slug,
            ];
        }
        // 4. Save the cart back to the session
        Session::put('cart', $cart);

        return redirect()->back()->with('success', $product->name . ' has been added to the cart.');
    }

    /**
     * Removes a product from the cart or reduces its quantity.
     * * @param \App\Models\Product $product (Route Model Binding)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Product $product, Request $request)
    {
        $cart = Session::get('cart');
        $productId = $product->id;
        
        // Ensure the product exists in the cart
        if (isset($cart[$productId])) {
            
            // Optional: Reduce quantity instead of removing, if 'reduce' is passed
            if ($request->has('reduce') && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
                Session::put('cart', $cart);
                return redirect()->back()->with('success', 'Quantity reduced.');
            }
            
            // Remove the product completely
            unset($cart[$productId]); 
            Session::put('cart', $cart);
            
            // If the cart is empty, the session key can be removed
            if (empty($cart)) {
                Session::forget('cart');
            }

            return redirect()->back()->with('success', $product->name . ' has been removed from the cart.');
        }

        return redirect()->back()->with('error', 'The product was not found in the cart.');
    }
    
    // Optional: Function to completely clear the cart
    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('info', 'The cart has been cleared.');
    }
}