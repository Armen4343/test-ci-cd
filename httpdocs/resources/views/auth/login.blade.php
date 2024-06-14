@extends('layouts.front.master')

@section('front')

    @push("front-styles")
        <style>
            .login-input {
                padding: 5px 0px 5px 7px;
                display: block;
                padding: 10px;
                background-color: white !important;
                width: 100%;
            }

        </style>
    @endpush



    <div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Verifica Email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('verifyEmail') }}" method="post" id="sendCodeForm">
                    @csrf
                    @if(session()->has('email'))
                        <input type="hidden" name="email" id="hiddenEmail" value="{{ session()->get('email') }}">
                    @endif
                    <div class="modal-body">
                        <div class="alert print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        @if(session()->has('codeMessage'))
                            <div class="alert alert-danger">
                                {{ session()->get('codeMessage') }}
                            </div>
                        @endif
                        <h4>Inserisci il codice qui sotto per verificare la tua email</h4>
                        <div class="row">
                            <div class="col-md-12 my-3">
                                <label class="required fw-bold fs-6 mb-2">Codice</label>
                                <input type="number" min="0" class="form-control" name="code" maxlength="7"
                                       oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);
                                       this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                                       placeholder="Inserisci Codice">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cancella</button>
                        <button type="button" class="btn btn-primary rounded-0" id="codeResend">
                            Invia nuovamente
                            <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                                <span class="visually-hidden">Caricamento...</span>
                            </div>
                        </button>
                        <button type="submit" class="btn btn-dark rounded-0" id="codeSend">
                            Verifica
                            <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                                <span class="visually-hidden">Caricamento...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--begin::Main-->
    <!--begin::Root-->
    <div class="auth-container">

        <div class="row gx-0 h-100">
            <!--begin::Authentication - Sign-in -->
            <div class="col-lg-6">
                <div class="widget">
                    <div class="login-widget shadow">
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(session()->has('message'))
                            <div class="alert alert-info">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate"
                              autocomplete="off" name="login" id="login-form">

                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-3">
                                <!--begin::Title-->
                                <h2 class="text-dark mb-3">Accedi </h2>
                                <!--end::Title-->

                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-3">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="login-input shadow" name="email" placeholder="Inserisci email "
                                       value="{{old('email')}}" type="text"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack mb-2">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                    <!--end::Label-->

                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Input-->
                                <input class="login-input shadow" type="password" placeholder="Inserisci password"
                                       name="password"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <div class="text-danger">
                                <x-jet-validation-errors class="mb-4"/>
                            </div>
                            <div class="mb-2 ">
                                <a href="{{ route('forgot.password') }}"
                                   class="link-primary fs-6 fw-bolder text-decoration-none">Hai Dimenticato la
                                    Password?</a>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>

                                    <span class="text-danger captcha-error d-none">CAPTCHA non valido</span>
                                </div>
                            </div>

                            <!--begin::Actions-->
                            <div>
                                <!--begin::Submit button-->
                                <button type="submit" id="login-btn" class="btn hero-section-btn w-25 shadow m-0 p-0"
                                        style="height:3rem;">
                                    <span class="indicator-label"> <i class="fa-solid fa-user pe-2 login-icon"></i>Accedi</span>

                                </button>


                            </div>
                            <!--end::Actions-->
                        </form>
                        <div class="mt-4">
                            <a href="{{ url('auth/facebook') }}" class="btn hero-section-btn w-25 shadow m-0"
                               style="padding: 12px 0; color: rgb(13,110,253)">
                                <i class="fa-brands fa-facebook fa-2xl"></i>
                            </a>
                            <a href="{{ url('auth/google') }}" class="btn hero-section-btn w-25 shadow m-0"
                               style="padding: 12px 0; color: rgb(13,110,253)">
                                <i class="fab fa-google fa-2xl"></i>
                            </a>
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->

                    <!--end::Content-->
                </div>
            </div>
            @php
                $banner = \App\Models\LoginRegisterBanner::first();
            @endphp
            <div class="col-lg-6 ">
                <div class="auth-bg"
                     style="background-image:url({{ isset($banner->login_banner) ? $banner->login_banner : secure_asset('front-end/images/login-bg-new.png') }}); background-size:cover; background-repeat:no-repeat; background-position:center center; height:100%; ">
                    <div class="content">
                        <div class="date">
                            <!--Login-->
                        </div>
                        <!--<h3 class="heading">Login</h3> -->
                        <p>
                        </p>
                        <!--<a href="#">Read More</a>-->
                    </div>
                </div>
            </div>
            <!--end::Authentication - Sign-in-->
        </div>

    </div>
    <!--end::Root-->


    @push("front-scripts")
        <script>
            $(window).scroll(function () {
                $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
            });

            const isCodeModal = {!! json_encode(session()->get('isCodeModal')) !!};

            if (isCodeModal) {
                const myModal = new bootstrap.Modal($('#codeModal'))
                myModal.show()
            }

            $('#codeResend').click(function (e) {
                e.preventDefault();
                $("#loader-save").css("display", "block")
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('resendCode') }}",
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: {
                        email: $('#hiddenEmail').val()
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        $('.print-error-msg').find('ul').html('');
                        $('.print-error-msg').css('display', 'block');
                        $('.print-error-msg').addClass(data.class);
                        $(".print-error-msg").find("ul").append('<li>' + data.message + '</li>');
                    }
                });
                $("#loader-save").css("display", "none")
            })


            // const validateRecaptcha = () => {
            //     const response = grecaptcha.getResponse();
            //
            //     return response.length;
            // }

            $('#login-form').submit(function (e) {
                if (!validateRecaptcha()) {
                    e.preventDefault();
                    $('.captcha-error').removeClass('d-none')
                    return;
                }
                $('.captcha-error').addClass('d-none')
            })
        </script>
    @endpush
@endsection
