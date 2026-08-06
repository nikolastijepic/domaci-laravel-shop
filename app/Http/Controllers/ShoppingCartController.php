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

        return view('cart', compact('cart', 'products'));
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
}
