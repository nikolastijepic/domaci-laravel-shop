<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function createOrder(array $orderData, array $items, array $cart)
    {
        return DB::transaction(function () use ($orderData, $items, $cart) {
            $order = Order::create($orderData);

            $order->items()->createMany($items);

            foreach ($cart as $productId => $quantity) {
                Product::where('id', $productId)
                    ->decrement('amount', $quantity);
            }

            return $order;
        });
    }
}
