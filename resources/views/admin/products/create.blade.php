@extends('layouts.app', ['title' => 'Add Product'])

@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Product</div>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="mb-3">Product Name</h5>
                                <input type="text" class="form-control" placeholder="Enter Product Name" name="name"
                                    value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-4">
                                <h5 class="mb-3">Product Description</h5>
                                <textarea class="form-control" cols="4" rows="6" placeholder="Enter Product Description" name="description">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="mb-4">
                                <h5 class="mb-3">Display images</h5>
                                <input class="form-control" id="formFile" type="file" accept="image/*" name="image">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="mb-4">
                                <h5 class="mb-3">Inventory</h5>

                                <div class="row g-3">
                                    <div class="col-12 col-lg-3">
                                        <div
                                            class="nav flex-column nav-pills border rounded vertical-pills overflow-hidden">
                                            <button class="nav-link px-4 rounded-0" data-bs-toggle="pill"
                                                data-bs-target="#Pricing" type="button"><i
                                                    class="bi bi-tag-fill me-2"></i>Pricing</button>
                                            <button class="nav-link px-4 rounded-0" data-bs-toggle="pill"
                                                data-bs-target="#Restock" type="button"><i
                                                    class="bi bi-box-seam-fill me-2"></i>Restock</button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-9">
                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="Pricing">
                                                <div class="row g-3">
                                                    <div class="col-12 col-lg-6">
                                                        <h6 class="mb-2">Price</h6>
                                                        <input class="form-control" type="number" placeholder="$$$"
                                                            name="price" value="{{ old('price') }}">
                                                        @if ($errors->has('price'))
                                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="Restock">
                                                <h6 class="mb-3">Add to Stock</h6>
                                                <div class="row g-3">
                                                    <div class="col-sm-7">
                                                        <input class="form-control" type="number" placeholder="Quantity"
                                                            name="stock" value="{{ old('stock') }}">
                                                        @if ($errors->has('stock'))
                                                            <span class="text-danger">{{ $errors->first('stock') }}</span>
                                                        @endif
                                                    </div>
                                                    {{-- <div class="col-sm">
                                                    <button class="btn btn-outline-primary"><i
                                                            class="bi bi-check2 me-2"></i>Confirm</button>
                                                </div> --}}
                                                </div>
                                                {{-- <table class="mt-3">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 200px;"></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-1000 py-1">Product in stock now:</td>
                                                        <td class="text-700 fw-semi-bold py-1">$2,059<button
                                                                class="btn p-0 ms-2" type="button"><i
                                                                    class="bi bi-arrow-clockwise"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-1000 py-1">Product in transit:</td>
                                                        <td class="text-700 fw-semi-bold py-1">3000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-1000 py-1">Last time restocked:</td>
                                                        <td class="text-700 fw-semi-bold py-1">25th March, 2020</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-1000 py-1">Total stock over lifetime:</td>
                                                        <td class="text-700 fw-semi-bold py-1">50,000</td>
                                                    </tr>
                                                </tbody>
                                            </table> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-outline-primary flex-fill"><i
                                        class="bi bi-send me-2"></i>Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
