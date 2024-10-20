@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 col-xxl-4 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <h5 class="mb-0">Congratulations <span class="fw-600">Jhon</span></h5>
                                <img src="assets/images/apps/party-popper.png" width="24" height="24" alt="">
                            </div>
                            <p class="mb-4">You are the best seller of this monnth</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <h3 class="mb-0 text-indigo">$168.5K</h3>
                                    <p class="mb-3">58% of sales target</p>
                                    <button class="btn btn-grd btn-grd-primary rounded-5 border-0 px-4">View
                                        Details</button>
                                </div>
                                <img src="assets/images/apps/gift-box-3.png" width="100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-2 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div
                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary">
                                <span class="material-icons-outlined fs-5">shopping_cart</span>
                            </div>
                            <div>
                                <span class="text-success d-flex align-items-center">+24%<i
                                        class="material-icons-outlined">expand_less</i></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0">248k</h4>
                            <p class="mb-3">Total Orders</p>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-2 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div
                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success">
                                <span class="material-icons-outlined fs-5">attach_money</span>
                            </div>
                            <div>
                                <span class="text-success d-flex align-items-center">+14%<i
                                        class="material-icons-outlined">expand_less</i></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0">$47.6k</h4>
                            <p class="mb-3">Total Sales</p>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="assets/js/dashboard2.js"></script>
@endsection
