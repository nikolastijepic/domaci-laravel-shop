@extends('layout')

@section('pageTitle')
    Cart
@endsection

@section('pageContent')

    <div class="container py-5">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="mb-4">
            Shopping Cart
        </h1>
        <div class="row">
            <div class="col-lg-8">

                @if(count($products) > 0)
                    @foreach($products as $product)

                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <img
                                            src="https://placehold.co/150x150/fb7f33/white?text={{ $product->name }}&font=Raleway"
                                            class="img-fluid rounded"
                                            alt="Product">
                                    </div>

                                    <div class="col-md-4">
                                        <h5 class="mb-1">
                                            {{ $product->name }}
                                        </h5>
                                        <p class="text-muted mb-0">
                                            {{ $product->description }}
                                        </p>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <strong>
                                            {{ $product->price }} &euro;
                                        </strong>
                                    </div>

                                    <div class="col-md-3">
                                        <form action="{{ route('shop.cart.update', $product->id) }}" method="POST" class="d-flex gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <input
                                                type="number"
                                                name="quantity"
                                                class="form-control"
                                                min="1"
                                                max="{{ $product->amount }}"
                                                value="{{ $cart[$product->id] }}">
                                            <button class="btn btn-sm btn-outline-primary">Update</button>
                                        </form>
                                        @error('quantity_'.$product->id)
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 text-end">
                                        <form action="{{ route('shop.cart.remove', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="text-center py-5">
                        <h3>Your cart is empty</h3>
                        <p>Go to shop to add products</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">Go to Shop</a>
                    </div>
                @endif

            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">
                            Order Summary
                        </h4>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Products</span>
                            <span>{{ count($products) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>{{ $subtotal }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span>
                                @if($shipping == 0)
                                    Free
                                    @else
                                        {{ $shipping }} &euro;
                                @endif
                            </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5 fw-bold mb-4">
                            <span>Total</span>
                            <span>{{ $total }} &euro;</span>
                        </div>

                        <button class="btn btn-success w-100 btn-lg">
                            Checkout
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
