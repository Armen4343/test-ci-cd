@extends('layouts.buyer.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
@section('buyer')
    <div class="card p-3">

        <div class="card-header border-0  p-0">
            <!--begin::Title-->
            <h3 class="fw-bolder m-0 p-0">Aggiungi Carta</h3>
            <!--end::Title-->
        </div>

        <form action="{{route('cards.store')}}" method="post" class="require-validation">
            @csrf
            <!--begin::Form-->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-7 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                    <span class="required">Tipo di Carta</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                       title="Specify a card type"></i>
                </label>
                <!--end::Label-->
                <select name="card_type" class="form-select form-select-solid" data-control="select2"
                        data-hide-search="true" data-placeholder="Selezionare:" required>
                    <option></option>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="American Express">American Express</option>
                </select>
                @if($errors->has('card_name'))
                    <div class="error">{{ $errors->first('card_name') }}</div>
                @endif
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-7 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                    <span class="required">Nome riportato sulla Carta</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                       title="Specify a card holder's name"></i>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" placeholder="Inserisci:" name="name_on_card"
                       required value="{{ old('name_on_card') }}" onblur="validateCardName(this)" />
                @if($errors->has('card_name'))
                    <div class="error">{{ $errors->first('card_name') }}</div>
                @endif
                <div class='form-row row'>
                    <div class='col-md-12 error form-group hide'>
                        <div class='alert-danger alert'>Please correct the errors and try again.</div>
                    </div>
                </div>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-7 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-bold form-label mb-2">Numero della Carta</label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative">
                    <!--begin::Input-->
                    <input type="number" class="form-control form-control-solid"
                           placeholder="Enter card number eg: 4111 1111 1111 1111" name="card_number" required
                           onblur="ValidateCreditCardNumber(this);"
                           value="{{ old('card_number') }}"/>
                    @if($errors->has('card_number'))
                        <div class="error">{{ $errors->first('card_number') }}</div>
                    @endif
                    <!--end::Input-->
                    <!--begin::Card logos-->
                    <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                        <img src="{{asset('assets/media/svg/card-logos/visa.svg')}}" alt="" class="h-25px"/>
                        <img src="{{asset('assets/media/svg/card-logos/mastercard.svg')}}" alt="" class="h-25px"/>
                        <img src="{{asset('assets/media/svg/card-logos/american-express.svg')}}" alt="" class="h-25px"/>
                    </div>
                    <!--end::Card logos-->
                </div>
                <div class='form-row row'>
                    <div class='col-md-12 error form-group hide'>
                        <div class='alert-danger alert'>Please correct the errors and try again.</div>
                    </div>
                </div>
                <!--end::Input wrapper-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-10">
                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-bold form-label mb-2">Data di Scadenza</label>
                    <!--end::Label-->
                    <!--begin::Row-->
                    <div class="row fv-row">
                        <!--begin::Col-->
                        <div class="col-6">
                            <select name="card_expiry_month" class="form-select form-select-solid"
                                    data-control="select2" data-hide-search="true" data-placeholder="Month" required>
                                <option>Mese:</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            @if($errors->has('card_expiry_month'))
                                <div class="error">{{ $errors->first('card_expiry_month') }}</div>
                            @endif
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-6">
                            <select name="card_expiry_year" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="Year" required>
                                <option>Anno:</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                                <option value="2032">2032</option>
                            </select>
                            @if($errors->has('card_expiry_year'))
                                <div class="error">{{ $errors->first('card_expiry_year') }}</div>
                            @endif
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->

            </div>
            <!--end::Input group-->


            <button type="submit" class="btn btn-success  d-block mt-2"><i class="fas fa-save"></i>Salva</button>
        </form>

    </div>
@endsection

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function validateCardName(obj) {
        // Check if the name is not empty
        const cardName = $(obj).val();
        let isValid = true;

        if (!cardName.trim()) {
            isValid = false;
        }

        // Check for valid characters (alphabets and spaces)
        const nameRegex = /^[a-zA-Z\s]*$/;
        if (!nameRegex.test(cardName)) {
            isValid = false;
        }

        if(isValid) {
            $(obj).parent().removeClass('has-error');
            $(obj).parent().find('div.error').addClass('hide');
            $(obj).parent().find('div.error').find('div.alert-danger').html('Please correct the errors and try again.');
        } else {
            $(obj).parent().addClass('has-error');
            $(obj).focus();
            $(obj).parent().find('div.error').find('div.alert-danger').html('Invalid Name on Card.');
            $(obj).parent().find('div.error').removeClass('hide');
        }
    }

    function validatecvv(obj)
    {
        var cvvnum = $(obj).val();
        var cvvregex = /^[0-9]{3,4}$/;
        var isvValidCVV = false;

        if (cvvregex.test(cvvnum)) {
            isvValidCVV = true;
        }
        if(isvValidCVV) {
            $(obj).parent().removeClass('has-error');
            $(obj).parent().parent().find('div.error').addClass('hide');
            $(obj).parent().parent().find('div.error').find('div.alert-danger').html('Please correct the errors and try again.');
        } else {
            $(obj).parent().addClass('has-error');
            $(obj).focus();
            $(obj).parent().parent().find('div.error').find('div.alert-danger').html('Invalid CVV number.');
            $(obj).parent().parent().find('div.error').removeClass('hide');
        }
    }

    function ValidateCreditCardNumber(obj) {
        //var ccNum = document.getElementById("cardNum").value;
        var ccNum = $(obj).val();
        var visaRegEx = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
        var mastercardRegEx = /^(?:5[1-5][0-9]{14})$/;
        var amexpRegEx = /^(?:3[47][0-9]{13})$/;
        var discovRegEx = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
        var isValid = false;

        if (visaRegEx.test(ccNum)) {
            isValid = true;
        } else if(mastercardRegEx.test(ccNum)) {
            isValid = true;
        } else if(amexpRegEx.test(ccNum)) {
            isValid = true;
        } else if(discovRegEx.test(ccNum)) {
            isValid = true;
        }

        if(isValid) {
            //
            $(obj).parent().removeClass('has-error');
            $(obj).parent().parent().find('div.error').addClass('hide');
            $(obj).parent().parent().find('div.error').find('div.alert-danger').html('Please correct the errors and try again.');

        } else {
            $(obj).parent().addClass('has-error');
            $(obj).focus();
            $(obj).parent().parent().find('div.error').find('div.alert-danger').html('Invalid card number.');
            $(obj).parent().parent().find('div.error').removeClass('hide');
        }
    }
</script>
