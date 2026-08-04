@extends('layout')

@section('pageTitle')
    Shop
@endsection

@section('pageContent')

    <div class="container mt-4">
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <div>
                            <img
                                src="https://placehold.co/300x300?text=Product"
                                class="card-img-top"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->name }}
                            </h5>
                            <p class="card-text fw-bold fs-5">
                                {{ $product->price }} €
                            </p>
                        </div>
                        <div class="card-footer border-0">
                            <a href="{{ route('shop.product.show', ['product' => $product->id]) }}" class="btn btn-primary w-100">
                                View product
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
