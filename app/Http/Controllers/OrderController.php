<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to place an order.');
        }

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string|max:50',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $orderItems = [];

            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                $quantity = $item['quantity'];

                if (!$product || $product->stock < $quantity) {
                    DB::rollBack();
                    return redirect()->route('cart.index')->with('error', 'Product out of stock.');
                }

                $orderItems[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ];

                $totalAmount += $product->price * $quantity;
                $product->decrement('stock', $quantity);
            }

            $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_address' => $request->input('shipping_address'),
            'payment_method' => $request->input('payment_method'),
            'total_amount' => $totalAmount,
            'status' => 'Processing',
            ]);

            foreach ($orderItems as $item) {
            $order->items()->create($item);
            }
            DB::commit();
            Session::forget('cart');
            return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Failed to place order. Please try again.');
            }
    }
}