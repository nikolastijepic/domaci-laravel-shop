<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function all()
    {
        return Product::all();
    }

    public function getLatestProducts()
    {
        return Product::latest('id')
            ->take(6)
            ->get();
    }

    public function create(array $validated)
    {
        return Product::create($validated);
    }

    public function update(Product $product, array $validated)

    {
        return $product->update($validated);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
