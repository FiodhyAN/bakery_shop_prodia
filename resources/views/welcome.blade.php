@extends('layouts.app', ['title' => 'Home'])
@section('content')
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
                                        <button class="btn btn-grd btn-grd-primary d-flex gap-2 px-3 border-0"><i
                                                class="material-icons-outlined">shopping_basket</i>Add to Cart</button>
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
