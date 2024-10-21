@extends('layouts.app', ['title' => 'Home'])
@section('content')
    <form action="{{ route('carts.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="product-modal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-lg">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 bg-grd-primary py-2">
                        <h5 class="modal-title">Order Summary</h5>
                        <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                            <i class="material-icons-outlined">close</i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="order-summary">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="card border bg-transparent shadow-none">
                                        <div class="card-body">
                                            <input type="hidden" id="product-id" name="product_id">
                                            <p class="fs-5" id="product-name"></p>
                                            <div class="my-3 border-top"></div>
                                            <div class="d-flex align-items-center gap-3">
                                                <a class="d-block flex-shrink-0" href="javascript:;">
                                                    <img src="https://placehold.co/200x200/png" class="rounded-3"
                                                        width="60" height="60" alt="Product" id="product-image">
                                                </a>
                                                <div class="ps-2">
                                                    <h6 class="mb-1" id="product-price">
                                                    </h6>
                                                    <div class="widget-product-meta"><span class="me-2">Stock
                                                            :</span><span id="product-stock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border bg-transparent mb-0 shadow-none">
                                        <div class="card-body">
                                            <p class="mb-2">Quantity:</p>
                                            <div class="input-group mb-2">
                                                <button type="button" class="btn btn-grd-secondary" id="minus-btn">
                                                    <i class="material-icons-outlined">remove</i>
                                                </button>
                                                <input type="number" class="form-control text-center" id="quantity-input"
                                                    value="1" min="1" readonly name="quantity">
                                                <button type="button" class="btn btn-grd-secondary" id="plus-btn">
                                                    <i class="material-icons-outlined">add</i>
                                                </button>
                                            </div>
                                            <p id="out-of-stock" class="text-danger d-none">Out of Stock</p>
                                            <h5 class="mb-0">Order Total: <span class="float-end" id="total-order"></span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-grd-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-grd-info">Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="main-content">
        <div class="row row-cols-1 row-cols-xl-2">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card rounded-4">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4 border-end">
                                <div class="p-3 align-self-center">
                                    <img src="{{ $product->image_url }}" class="w-100 rounded-start"
                                        alt="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->short_description }}</p>
                                    <h5>Price : {{ $product->formatted_price }}</h5>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <button class="btn btn-grd btn-grd-primary d-flex gap-2 px-3 border-0"
                                            data-bs-toggle="modal" data-bs-target="#product-modal" id="product-modal-btn"
                                            data-product_id="{{ $product->id }}" data-product_name="{{ $product->name }}"
                                            data-product_image="{{ $product->image_url }}"
                                            data-product_formatted_price="{{ $product->formatted_price }}"
                                            data-product_price="{{ $product->price }}"
                                            data-product_stock="{{ $product->stock }}">
                                            <i class="material-icons-outlined">shopping_basket</i>Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
