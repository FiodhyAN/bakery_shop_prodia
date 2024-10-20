@extends('layouts.auth', ['title' => 'Login'])
@section('content')
    <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
        <div class="container-fluid my-5 my-lg-0">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                    <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-5">
                            <h4 class="fw-bold">Login</h4>
                            <p class="mb-0">Enter your credentials to login your account</p>

                            <div class="form-body my-5">
                                <form class="row g-3" id="loginForm">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmailAddress" name="email"
                                            placeholder="Enter Your Email Address">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0"
                                                id="inputChoosePassword" placeholder="Enter Your Password" name="password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class="bi bi-eye-slash-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                name="remember">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-grd-primary" id="submitBtn"
                                                data-loading-text="<div class='spinner-border text-light role='status'></div>">Login</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-start">
                                            <p class="mb-0">Don't have an account yet? <a
                                                    href="{{ route('register') }}">Sign up here</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });

            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "password") {
                        error.insertAfter("#show_hide_password");
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                submitHandler: function(form) {
                    var submitBtn = $('#submitBtn');
                    var originalText = submitBtn.html();
                    submitBtn.html(submitBtn.data("loading-text")).attr("disabled", true);

                    var formData = new FormData(form);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('login') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.redirect == 'dashboard') {
                                window.location.href = "{{ route('dashboard') }}";
                            } else if (response.redirect == 'home') {
                                window.location.href = "{{ route('home') }}";
                            } else {
                                window.location.href = "{{ route('verification.notice') }}";
                            }
                        },
                        error: function(xhr, status, error) {
                            Toastify({
                                text: xhr.responseJSON.message,
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#FFA500",
                                stopOnFocus: true,
                            }).showToast();

                            submitBtn.html(originalText).attr("disabled", false);
                        }
                    })
                },
                invalidHandler: function(event, validator) {
                    $('#submitBtn').attr("disabled", false);
                }
            });
            $('#submitBtn').attr("disabled", true);
            $('#loginForm input').on('input', function() {
                if ($('#loginForm').valid()) {
                    $('#submitBtn').attr("disabled", false);
                } else {
                    $('#submitBtn').attr("disabled", true);
                }
            });
        });
    </script>
@endsection
