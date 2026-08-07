<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartAddRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);

        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();

        $subtotal = 0;

        foreach ($products as $product) {
            $subtotal += $product->price * $cart[$product->id];
        }

        $shipping = 0;
        $total = $subtotal + $shipping;

        return view('cart', compact('cart', 'products', 'subtotal', 'shipping', 'total',));
    }
    public function addToCart(CartAddRequest $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = Session::get('cart', []);

        if (isset($cart[$request->product_id])) {
            $newQuantity = $cart[$request->product_id] + $request->quantity;
            if ($newQuantity > $product->amount) {
                return back()->withErrors([
                    'quantity' => 'There is not enough stock available.',
                ]);
            }
            $cart[$request->product_id] = $newQuantity;
        } else {
            $cart[$request->product_id] = $request->quantity;
        }
        Session::put('cart', $cart);

        return redirect()->route('shop.cart.index');
    }

    public function removeFromCart($product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product removed');
    }
}
