@extends('layouts.auth', ['title' => 'Register'])
@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-5 mx-auto">
                <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
                    <div class="card-body p-5">
                        <h4 class="fw-bold">Sign Up</h4>
                        <p class="mb-0">Enter your credentials to create your account</p>

                        <div class="form-body my-4">
                            <form class="row g-3" id="registerForm">
                                @csrf
                                <div class="col-12">
                                    <label for="inputUsername" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputUsername" name="name"
                                        placeholder="Enter Your Name">
                                </div>
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="inputEmailAddress" name="email"
                                        placeholder="Enter Your Email Address">
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" id="inputChoosePassword"
                                            name="password" placeholder="Enter Password">
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputChooseConfirmPassword" class="form-label">Confirm Password</label>
                                    <div class="input-group" id="show_hide_password_confirmation">
                                        <input type="password" class="form-control border-end-0"
                                            id="inputChoosePasswordConfirmation" placeholder="Enter Password Confirmation"
                                            name="password_confirmation">
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" id="submitBtn"
                                            data-loading-text="<div class='spinner-border text-light role='status'></div>"
                                            class="btn btn-grd-danger">Register</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-start">
                                        <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Sign in
                                                here</a></p>
                                    </div>
                                </div>
                            </form>
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
            $("#show_hide_password_confirmation a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_confirmation input').attr("type") == "text") {
                    $('#show_hide_password_confirmation input').attr('type', 'password');
                    $('#show_hide_password_confirmation i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password_confirmation i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password_confirmation input').attr("type") == "password") {
                    $('#show_hide_password_confirmation input').attr('type', 'text');
                    $('#show_hide_password_confirmation i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password_confirmation i').addClass("bi-eye-fill");
                }
            });


            $('#registerForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#inputChoosePassword"
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Your name must consist of at least 3 characters"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "Please provide a password confirmation",
                        minlength: "Your password must be at least 8 characters long",
                        equalTo: "Password confirmation must match the entered password"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "password") {
                        error.insertAfter("#show_hide_password");
                    } else if (element.attr("name") == "password_confirmation") {
                        error.insertAfter("#show_hide_password_confirmation");
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
                        type: 'POST',
                        url: "{{ route('register') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            window.location.href = "{{ route('verification.notice') }}";
                        },
                        error: function(error) {
                            Toastify({
                                text: 'An error occurred. Please try again',
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "linear-gradient(to right, #536976, #292e49)",
                            }).showToast();

                            submitBtn.html(originalText).attr("disabled", false);

                            var errors = error.responseJSON.errors;
                            if (errors) {
                                $.each(errors, function(key, value) {
                                    var element = $('[name="' + key + '"]');
                                    element.addClass('is-invalid');
                                    element.next('label.error')
                                        .remove();
                                    element.after('<label class="error" for="' +
                                        key + '">' + value[0] + '</label>');
                                    element.next('label.valid-msg').remove();
                                });
                            }
                        }
                    });
                },
                invalidHandler: function(event, validator) {
                    $('#submitBtn').attr("disabled",
                        false);
                }
            });
            $('#submitBtn').attr("disabled", true);
            $('#registerForm input').on('input', function() {
                if ($('#registerForm').valid()) {
                    $('#submitBtn').attr("disabled", false);
                } else {
                    $('#submitBtn').attr("disabled", true);
                }
            });

        });
    </script>
@endsection
