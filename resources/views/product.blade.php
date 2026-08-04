@extends('layout')

@section('pageTitle')
    Product - {{ $product->name }}
@endsection

@section('pageContent')

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <img
                    src="https://placehold.co/300x300?text=Product"
                    class="card-img-top"
                    alt="{{ $product->name }}">
            </div>

            <div class="col-lg-7">
                <h1 class="mb-3">
                    {{ $product->name }}
                </h1>

                <h2 class="text-primary mb-4">
                    {{ $product->price }} €
                </h2>

                @if($product->amount > 0)
                    <span class="badge bg-success fs-6 mb-4">
                    In stock ({{ $product->amount }})
                </span>
                @else
                    <span class="badge bg-danger fs-6 mb-4">
                    Out of stock
                </span>
                @endif
                <hr>
                <h4>Description</h4>

                <p class="text-muted">
                    {{ $product->description }}
                </p>

                <a href="#" class="btn btn-primary btn-lg mt-3">
                    Add to cart
                </a>
            </div>
        </div>
    </div>

@endsection
