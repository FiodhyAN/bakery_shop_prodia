@extends('layouts.auth', ['title' => 'Verify Email'])
@section('content')
    <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
        <div class="container-fluid my-5 my-lg-0">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                    <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-5">
                            <h4 class="fw-bold">Verify Your Email Address</h4>
                            <p class="mb-0">Before proceeding, please check your email for a verification link.</p>
                            <div class="d-flex justify-content-between mt-4">
                                <form id="resendEmail" class="me-2">
                                    @csrf
                                    <button type="submit" class="btn btn-grd-primary" id="submitResend"
                                        data-loading-text="<div class='spinner-border text-light' role='status'></div>">Resend
                                        Verification Email</button>
                                </form>
                                <form action="{{ route('logout') }}" method="POST" class="ms-2">
                                    @csrf
                                    <button type="submit" class="btn btn-grd-danger">Logout</button>
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
                $('#resendEmail').submit(function(e) {
                    e.preventDefault();
                    var submitBtn = $('#submitResend');
                    var originalBtnText = submitBtn.html();

                    $.ajax({
                        url: "{{ route('verification.send') }}",
                        type: 'POST',
                        data: $(this).serialize(),
                        beforeSend: function() {
                            submitBtn.html(submitBtn.data('loading-text'));
                            submitBtn.attr('disabled', 'disabled');
                        },
                        success: function(response) {
                            submitBtn.html(originalBtnText);
                            submitBtn.removeAttr('disabled');
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: 'top',
                                position: 'right',
                                backgroundColor: "#3ac47d",
                                stopOnFocus: true,
                            }).showToast();
                        },
                        error: function(xhr) {
                            submitBtn.html(originalBtnText);
                            submitBtn.removeAttr('disabled');
                            Toastify({
                                text: xhr.responseJSON.message,
                                duration: 3000,
                                gravity: 'top',
                                position: 'right',
                                backgroundColor: "#ff4c61",
                                stopOnFocus: true,
                            }).showToast();
                        }
                    });
                });
            });
        </script>
    @endsection
