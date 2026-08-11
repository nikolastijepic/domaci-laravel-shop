<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function __construct(
        private ProductRepository $productRepository,
        private OrderRepository $orderRepository
    ){}

    public function store(CheckoutRequest $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('shop.cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $productIds = array_keys($cart);

        $products = $this->productRepository->findByIds($productIds);

        if ($products->count() !== count($productIds)) {
            return redirect()
                ->route('shop.cart.index')
                ->with('error', 'Some products are no longer available.');
        }

        $items = [];

        foreach ($products as $product) {
            $items[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => $cart[$product->id],
            ];
        }

        $subtotal = 0;

        foreach ($products as $product) {
            $subtotal += $product->price * $cart[$product->id];
        }

        $shipping = 0;
        $total = $subtotal + $shipping;

        $orderData = [
            'user_id' => auth()->id(),
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'status' => 'pending',
            ];

        $order = $this->orderRepository->createOrder($orderData, $items);

        Session::forget('cart');

        return redirect()
            ->route('shop.cart.index')
            ->with('success', 'Order created successfully.');
    }
}
