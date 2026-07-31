<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;

class ShopController extends Controller
{

    public function __construct(
        private ProductRepository $productRepository
    ){}
    public function index()
    {
        $products = $this->productRepository->all();

        return view('shop', compact('products'));
    }
}
