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

            .auth-container {
                margin-top: 76px;
                height: auto;
            }
        </style>
    @endpush


    <!--begin::Main-->
    <!--begin::Root-->
    <div class="auth-container">

        <div class="row gx-0 h-100">
            <!--begin::Authentication - Sign-in -->
            <div class="col-lg-6">
                <!--begin::Content-->

                <div class="widget">
                    <!--begin::Wrapper-->
                    <div class="register-widget">


                        <form action="{{ route('register') }}" method="POST" class="validatedForm" name="registerform"
                              enctype="multipart/form-data" id="register-form">
                            @csrf
                            <!--begin::Form-->
                            @if ($errors->any())
                                <div class="alert alert-danger pb-0">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">

                                <div class="form-group my-2 col-md-6">
                                    <label for="">Nome : <span class="required"></span></label>
                                    <input placeholder="inserisci nome" type="text" name="name" value="{{old('name')}}"
                                           class="login-input shadow" required>

                                </div> <br>

                                <div class="form-group my-2 col-md-6">
                                    <label>Email : <span class="required"></span></label>
                                    <input required type="text" name="email" placeholder="demo@demo.com"
                                           value="{{old('email')}}" class="login-input shadow">
                                </div> <br><br>

                                <div class="form-group my-2 col-md-6">
                                    <label for="">Telefono :</label>
                                    <input placeholder="+390000000000" required type="tel" value="+39" name="phone"
                                           pattern="[+]{1}[0-9]{12}" class="login-input shadow" id="phone"
                                           title="e.g: +390000000000"

                                    > 
                                </div><br>
                                <!--<div class="form-group my-2 col-md-6">
                                    <label>
                                        Paese : <span class="required"></span>
                                    </label>
                                    <select id="country" required class="login-input shadow" name="country">
                                        <option value="IT" selected>Italy</option>
                                    </select>
                                </div>-->

                                <!--<div class="form-group my-2 col-md-6">
                                    <label>
                                        Regione : <span class="required"></span>
                                    </label>
                                    <select onchange="filterCities(this)" name="state" required
                                            class="login-input shadow">
                                        <option value="" selected>Seleziona</option>

                                        <option value="Abruzzo" data-id="1679">Abruzzo</option>
                                        <option value="Basilicata" data-id="1706">Basilicata</option>
                                        <option value="Calabria" data-id="1703">Calabria</option>
                                        <option value="Campania" data-id="1669">Campania</option>
                                        <option value="Emilia-Romagna" data-id="1773">Emilia-Romagna</option>
                                        <option value="Friuli–Venezia Giulia" data-id="1756">Friuli–Venezia Giulia</option>
                                        <option value="Lazio" data-id="1678">Lazio</option>
                                        <option value="Liguria" data-id="1768">Liguria</option>
                                        <option value="Lombardy" data-id="1705">Lombardia</option>
                                        <option value="Marche" data-id="1670">Marche</option>
                                        <option value="Molise" data-id="1695">Molise</option>
                                        <option value="Piedmont" data-id="1702">Piemonte</option>
                                        <option value="Sardinia" data-id="1715">Sardegna</option>
                                        <option value="Sicily" data-id="1709">Sicilia</option>
                                        <option value="Trentino-South Tyrol" data-id="1725">Trentino-South Tyrol</option>
                                        <option value="Tuscany" data-id="1664">Toscana</option>
                                        <option value="Umbria" data-id="1683">Umbria</option>
                                        <option value="Veneto" data-id="1753">Veneto</option>
                                        <option value="Valle d'Aosta" data-id="1716">Valle d'Aosta</option>
                                    </select>
                                </div>-->

                                 <div class="form-group my-2 col-md-6">
                                    <!-- Alabama-->
                                    <label>
                                        <!--Città : <span class="required"></span>
                                    </label>
                                    <select id="city" required class="login-input shadow cities-tb" name="city">
                                        @if (old('city'))
                                            <option value="{{ old('city') }}" selected>{{ old('city') }}</option>
                                        @endif
                                    </select>-->
                                </div>


                                <!-- <div class="form-group my-2 col-md-12">
                                    <label for="">Codice postale : <span class="required"></span></label>
                                    <input placeholder="Inserisci codice postale"
                                           type="number"
                                           name="zipcode"
                                           value=""
                                           class="login-input shadow"
                                           required
                                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                           maxlength="5"
                                    >

                                </div>--> 
                                <div class="col-md-12 ">
                                    <div class="row">
                                        <div class="form-group my-2 col-md-6">
                                            <label for="">Password : <span class="required"></span></label>
                                            <div class="input-group">
                                                <input name="password" required type="password" id="reg_password"
                                                       value="{{old('password')}}" class="login-input shadow"
                                                       placeholder="Inserisci nuova password">

                                            </div>
                                        </div>
                                        <div class="form-group my-2 col-md-6">
                                            <label for="">Conferma Password : <span class="required"></span></label>
                                            <div class="input-group">
                                                <input placeholder="Inserisci password per confermare"
                                                       id="reg_password_confirm" value="{{old('password_confirm')}}"
                                                       type="password" required name="password_confirm"
                                                       class="login-input shadow">

                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <p class="text-danger" style="display:none;" id="passwordconfirmError">La password e la
                                    sua password di conferma non corrispondono</p>
                            </div>

                            <!-- <div class="form-group my-2 col-md-6">
                                <label for="exampleInputSlug">Inserisci foto profilo :</label><br>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="login-input shadow" value="{{old('profile')}}"
                                               name="profile" class="custom-file-input">

                                    </div>
                                </div>
                            </div>-->
 <br><br><br>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                </div>

                                <span class="text-danger captcha-error d-none">CAPTCHA non valido</span>
                            </div>
                            <div class="form-group my-2 col-md-12">

                                @php
                                    $termsAndConditions = App\Models\TermsAndConditions::first();
                                @endphp
                                <input type="checkbox" value="yes" class="form-check-input" name="termsandconditions"
                                       required>
                                <label>Cliccando qui, dichiaro di aver letto e accettato i termini di ZeepUp
                                    <a href="terms-and-conditions/{{$termsAndConditions['terms_and_condition']}}" class="text-decoration-none" target="_blank">Termini e Condizioni</a> e
                                    <a href="terms-and-conditions/{{$termsAndConditions['privacy_policy']}}" class="text-decoration-none" target="_blank">La Politica sui Cookies</a>.
                                </label>
                            </div>

                            <div class="form-group my-2 ">

                                <button type="reset" class="btn hero-section-btn shadow w-25 m-0 p-0"
                                        style="height:3rem;"><i class="fa fa-refresh"></i> Reset
                                </button>


                                <button type="submit" onclick="return Validate()" id="button1"
                                        class="btn hero-section-btn shadow w-25 m-0 p-0" style="height:3rem;"><i
                                        class="fa fa-check-circle"></i>
                                    Registrati
                                </button>


                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Wrapper-->

                <!--end::Content-->

            </div>
            <div class="col-lg-6 ">
                @php
                    $banner = \App\Models\LoginRegisterBanner::first();
                @endphp
                <div class="auth-bg"
                     style="background-image:url({{ $banner->register_banner ?? asset('front-end/images/register-bg-new.png') }}); background-size:cover; background-repeat:no-repeat; background-position:center center; height:100%;">
                    <div class="content">
                        <div class="date">
                            <!--February 21, 2023-->
                        </div>
                        <!--<h3 class="heading">Sign Up</h3>-->
                        <!--<p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        </p>
                        <a href="#">Read More</a>-->
                    </div>
                </div>
            </div>
            <!--end::Authentication - Sign-in-->
        </div>

    </div>
    <!--end::Root-->




    @push("front-scripts")
        <script src="https://unpkg.com/lokijs@^1.5/build/lokijs.min.js"></script>
        <script src="{{ asset('front-end/js/app.js') }}"></script>
        <script>
            $(window).scroll(function () {
                $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
            });

            $('#register-form').submit(function (e) {
                if (!validateRecaptcha()) {
                    e.preventDefault();
                    $('.captcha-error').removeClass('d-none')
                    return;
                }
                $('.captcha-error').addClass('d-none')
            })

            function Validate() {
                var password = $('#reg_password').val();
                var confirmPassword = $("#reg_password_confirm").val();
                if (password != confirmPassword) {
                    $('#passwordconfirmError').show();
                    return false;
                }

                $('#passwordconfirmError').hide();
                return true;
            }

            $('#phone').keyup(function () {
                // Don't run for backspace key entry, otherwise it bugs out
                if (event.which != 8) {

                    // Remove invalid chars from the input
                    var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");
                    var inputlen = input.length;
                    // Get just the numbers in the input
                    var numbers = this.value.replace(/\D/g, '');
                    var numberslen = numbers.length;
                    // Value to store the masked input
                    var newval = "";

                    // Loop through the existing numbers and apply the mask
                    for (var i = 0; i < numberslen; i++) {
                        if (i == 0) newval = "+" + numbers[i];
                        else if (i == 1) newval += numbers[i];
                        else if (i == 5) newval += numbers[i];
                        else newval += numbers[i];
                    }

                    // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.
                    if (inputlen >= 1 && numberslen == 0 && input[0] == "(") newval = "(";
                    else if (inputlen >= 6 && numberslen == 3 && input[4] == ")" && input[5] == " ") newval += ") ";
                    else if (inputlen >= 5 && numberslen == 3 && input[4] == ")") newval += " ";
                    else if (inputlen >= 6 && numberslen == 3 && input[5] == " ") newval += " ";
                    else if (inputlen >= 10 && numberslen == 6 && input[9] == "-") newval += "-";

                    $(this).val(newval.substring(0, 13));

                }
            });
        </script>
    @endpush
@endsection
