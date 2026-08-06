@extends('layout')

@section('pageTitle')
    Product - {{ $product->name }}
@endsection

@section('pageContent')

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <img
                    src="https://placehold.co/600x600/fb7f33/white?text={{ $product->name }}&font=Raleway"
                    class="card-img-top"
                    alt="{{ $product->name }}">
            </div>

            <div class="col-lg-7">
                <h1 class="mb-3">
                    {{ $product->name }}
                </h1>

                <h2 class="text-primary mb-4">
                    {{ $product->price }} &euro;
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

                <div>

                    @error('quantity')
                    <div class="text-danger mt-2 mb-3">{{ $message }}</div>
                    @enderror

                    <form method="POST" action="{{ route('shop.cart.add') }}">
                        @csrf
                        <div class="d-flex align-items-center">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <select name="quantity" class="form-select w-auto">
                                @for ($i = 1; $i <= $product->amount; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>

                            <button type="submit" class="btn btn-primary btn-lg ms-3">Add to cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
