<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function createOrder(array $orderData, array $items)
    {
        return DB::transaction(function () use ($orderData, $items) {
            $order = Order::create($orderData);

            $order->items()->createMany($items);

            return $order;
        });
    }
}
