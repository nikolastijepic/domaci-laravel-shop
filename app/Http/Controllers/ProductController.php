<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(private ProductRepository $productRepository){}
    public function index()
    {
        return view('add-product');
    }
    public function getAllProducts()
    {
        $products = $this->productRepository->all();

        return view('all-products', compact('products'));
    }

    public function addProduct(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = $this->productRepository->create($validated);

        return redirect()->route('admin.all.products')
            ->with('success', 'Proizvod je uspesno dodat.')
            ->with('new_product_id', $product->id);
    }

    public function getProduct(Product $product)
    {
       return view('edit-product', compact('product'));
    }

    public function editProduct(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $this->productRepository->update($product, $validated);

        return redirect()->route('admin.all.products');
    }

    public function deleteProduct(Product $product)
    {
        $this->productRepository->delete($product);

        return redirect()->back();
    }
}
