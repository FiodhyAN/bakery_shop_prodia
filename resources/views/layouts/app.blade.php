<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title . ' - Bakery Shop' }}</title>
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png">
    <!-- loader-->
    <link href="/assets/css/pace.min.css" rel="stylesheet">
    <script src="/assets/js/pace.min.js"></script>
    <link href="/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet">

    <!--plugins-->
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/metismenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/metismenu/mm-vertical.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/simplebar/css/simplebar.css">
    <!--bootstrap css-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!--main css-->
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="/sass/main.css" rel="stylesheet">
    <link href="/sass/dark-theme.css" rel="stylesheet">
    <link href="/sass/blue-theme.css" rel="stylesheet">
    <link href="/sass/semi-dark.css" rel="stylesheet">
    <link href="/sass/bordered-theme.css" rel="stylesheet">
    <link href="/sass/responsive.css" rel="stylesheet">

</head>

<body>

    <!--start sidebar-->
    @include('layouts.navigation')
    <!--end sidebar-->

    @include('layouts.header')
    <!--start main wrapper-->
    <main class="main-wrapper">
        @yield('content')
    </main>
    <!--end main wrapper-->


    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    <!--start cart-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart">
        <div class="offcanvas-header border-bottom h-70">
            <h5 class="mb-0" id="offcanvasRightLabel">My Cart</h5>
            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="offcanvas">
                <i class="material-icons-outlined">close</i>
            </a>
        </div>
        <div class="offcanvas-body p-0">
            @if (count($carts) > 0)
                <div class="order-list">
                    @foreach ($carts as $item)
                        <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                            <div class="order-img">
                                <img src="{{ $item->product->image_url }}" class="img-fluid rounded-3" width="75"
                                    alt="">
                            </div>
                            <div class="order-info flex-grow-1">
                                <h5 class="mb-1 order-title">{{ $item->product->name }}</h5>
                                <h5 class="mb-1 order-title">{{ $item->product->formatted_price }}</h5>
                                <p class="mb-0 order-price">x {{ $item->quantity }}</p>
                            </div>
                            <div class="d-flex">
                                <form action="{{ route('carts.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="order-delete"><span
                                            class="material-icons-outlined text-black">delete</span></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="order-total p-3 border-top">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Total</h6>
                        <h6 class="mb-0">{{ $total }}</h6>
                    </div>
                </div>
            @else
                <h3 class="text-center mt-5">Cart Empty</h3>
            @endif
        </div>
        <div class="offcanvas-footer h-70 p-3 border-top">
            <div class="d-grid">
                <button type="button" class="btn btn-grd btn-grd-primary" data-bs-dismiss="offcanvas"
                    {{ count($carts) == 0 ? 'disabled' : '' }}>Checkout</button>
            </div>
        </div>
    </div>
    <!--end cart-->

    <!--bootstrap js-->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <!--plugins-->
    <script src="/assets/js/jquery.min.js"></script>
    <!--plugins-->
    <script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="/assets/plugins/metismenu/metisMenu.min.js"></script>
    <script src="/assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="/assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="/assets/plugins/validation/jquery.validate.min.js"></script>
    <script src="/assets/plugins/validation/validation-script.js"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="/assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        var session = '{{ Session::has('success') }}';
        var message = '{{ Session::get('success') }}';
    </script>
    <script src="/assets/js/main.js"></script>
    @yield('scripts')
</body>

</html>
