@extends('layouts.app', ['title' => 'Products'])

@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product Management</div>
            <div class="ms-auto">
                <a href="{{ route('products.create') }}" class="btn btn-grd-primary px-4 raised d-flex gap-2"><i
                        class="material-icons-outlined">add_circle</i>Add New
                    Product</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="products-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->formatted_price }}</td>
                                    <td>{{ $item->formatted_stock }}</td>
                                    <td>
                                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="img-fluid"
                                            width="50">
                                    </td>
                                    <td>
                                        <a href="{{ route('products.edit', $item->id) }}"
                                            class="btn btn-sm btn-grd-info raised"><i
                                                class="material-icons-outlined">edit</i></a>
                                        <button class="btn btn-sm btn-grd-danger raised delete-product"
                                            data-id="{{ $item->id }}"><i
                                                class="material-icons-outlined">delete</i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const indexUrl = "{{ route('products.index') }}";
        const deleteUrl = "{{ route('products.delete') }}";
    </script>
    <script src="assets/js/products.js"></script>
@endsection
