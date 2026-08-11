<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;
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
        $data = $request->validated();

        $product = Product::findOrFail($data['product_id']);
        $cart = Session::get('cart', []);

        if ($data['quantity'] > $product->amount) {
            return back()->withErrors([
                'quantity' => 'There is not enough stock available.',
            ]);
        }

        if (isset($cart[$data['product_id']])) {
            $newQuantity = $cart[$data['product_id']] + $data['quantity'];
            if ($newQuantity > $product->amount) {
                return back()->withErrors([
                    'quantity' => 'There is not enough stock available.',
                ]);
            }
            $cart[$data['product_id']] = $newQuantity;
        } else {
            $cart[$data['product_id']] = $data['quantity'];
        }
        Session::put('cart', $cart);

        return redirect()->route('shop.cart.index');
    }

    public function updateCart(CartUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($data['quantity'] > $product->amount) {
            return back()->withErrors([
                'quantity_'.$product->id => 'There is not enough stock available.',
            ]);
        }

        $cart = session()->get('cart', []);
        $cart[$product->id] = $data['quantity'];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Cart updated');
    }


    public function removeFromCart($product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product removed');
    }
}
