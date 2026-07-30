<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

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
