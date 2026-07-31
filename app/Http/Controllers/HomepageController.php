<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;

class HomepageController extends Controller
{
    public function __construct(
        private ProductRepository $productRepository
    ){}

    public function index()
    {
        $products = $this->productRepository->getLatestProducts();

        return view('welcome', compact('products'));
    }
}
