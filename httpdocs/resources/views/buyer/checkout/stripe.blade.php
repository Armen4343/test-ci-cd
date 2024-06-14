<!DOCTYPE html>
<html>
<head>
    <title>Laravel - Stripe Payment Gateway Integration Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                        <h3 class="panel-title" >Payment Details</h3>
                </div>
                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form
                            role="form"
                            action="{{ route('buyer.stripe.post') }}"
                            method="post"
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf

						@php
    					$cards = \App\Models\PaymentCard::where('buyer_id','=',Auth::user()->id)->get();
						@endphp
						@if(count($cards))
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Saved Cards</label>
								<select class="form-control" onChange="paymentCard(this.value)">
									  		<option selected value="0">Saved Cards</option>
											@foreach($cards as $card)
                                                <option value="{{ $card->id }}">{{ $card->card_type. "-" . (strlen(str_replace(' ', '',$card->card_number)) > 16 ? Crypt::decryptString($card->card_number) : $card->card_number) }}</option>
											@endforeach
									</select>
                            </div>
                        </div>
						@endif
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text' id="strName" name="strName">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' id="cNumber" name="cNumber" onblur="ValidateCreditCardNumber(this);">
                                <img src="/assets/media/icons/eye-password-hide.svg" data-key="hide" alt="Hide password" style="position: absolute; width: 20px; top: 55%; right: 5%; z-index: 1; cursor: pointer;" class="password_icon"/>
                                    <input type="hidden" id="strOrderNumber" name="strOrderNumber" value="{{ $strOrderNumber }}" onkeypress="return isNumber(event)" />
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-2 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text' id="strCVV" name="strCVV" onblur="validatecvv(this);" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-6 col-md-2 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text' id="nMonth" name="nMonth">
                            </div>
                            <div class='col-xs-6 col-md-2 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text' id="nYear" name="nYear">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try again.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit" style="background-color: #FF0066; border-color: #FF0066">Pay Now (&euro;{{number_format($total, 2, ',', '')}})</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $('.password_icon').click(function () {
        const dataKey = $(this).attr('data-key');

        if (dataKey === 'hide') {
            $(this).parent().children('#cNumber').attr('type', 'text');
            $(this).attr('src', '/assets/media/icons/eye-password-show.svg')
            $(this).attr('data-key', 'show')
        } else {
            $(this).parent().children('#cNumber').attr('type', 'password');
            $(this).attr('src', '/assets/media/icons/eye-password-hide.svg')
            $(this).attr('data-key', 'hide')
        }
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function validatecvv(obj)
    {
        var cvvnum = $(obj).val();
        var cvvregex = /^[0-9]{3,4}$/;
        var isvValidCVV = false;

        if(cvvregex.test(cvvnum))
        {
            isvValidCVV = true;
        }
        if(isvValidCVV)
        {
            $(obj).parent().removeClass('has-error');
            $(".require-validation").find('div.error').addClass('hide');
            $(".require-validation").find('div.error').find('div.alert-danger').html('Please correct the errors and try again.');
        }
        else {
            $(obj).parent().addClass('has-error');
            $(obj).focus();
            $(".require-validation").find('div.error').find('div.alert-danger').html('Invalid CVV number.');
            $(".require-validation").find('div.error').removeClass('hide');
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
        }
        else if(mastercardRegEx.test(ccNum)) {
            isValid = true;
        }
        else if(amexpRegEx.test(ccNum)) {
            isValid = true;
        }
        else if(discovRegEx.test(ccNum)) {
            isValid = true;
        }
        console.log(isValid);
        if(isValid) {
            //
            $(obj).parent().removeClass('has-error');
            $(".require-validation").find('div.error').addClass('hide');
            $(".require-validation").find('div.error').find('div.alert-danger').html('Please correct the errors and try again.');

        }
        else {
            console.log('in else');
            //alert("Please provide a valid card number!");
            $(obj).parent().addClass('has-error');
            $(obj).focus();
            $(".require-validation").find('div.error').find('div.alert-danger').html('Invalid card number.');
            $(".require-validation").find('div.error').removeClass('hide');
        }
    }

$(function() {

    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {

        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        var hasError = false;
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
            hasError = true;
          }
          else{
            if($input.attr('id')=='strName')
            {
                var regName = /^[a-zA-Z]+ [a-zA-Z]+$/;
                var name = $input.val();
                if(!regName.test(name)){
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                    hasError = true;
                }
            }
            if($input.attr('id')=='cNumber')
            {
                var regex = new RegExp("^[0-9]{13,19}$");
                var cNumber = $input.val();
                if(!regex.test(cNumber)){
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                    hasError = true;
                }
            }
            if($input.attr('id')=='strCVV')
            {
                var regex = new RegExp("^[0-9]{3,4}$");
                var strCVV = $input.val();
                if(!regex.test(strCVV)){
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                    hasError = true;
                }
            }
            if($input.attr('id')=='nMonth')
            {
                var regex = new RegExp("^[0-9]{1,2}$");
                var nMonth = $input.val();
                if(!regex.test(nMonth)){
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                    hasError = true;
                }
            }
            if($input.attr('id')=='nYear')
            {
                var regex = new RegExp("^[0-9]{4}$");
                var nYear = $input.val();
                if(!regex.test(nYear)){
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                    hasError = true;
                }
            }
          }
        });
        if(hasError)
        {
            return false;
        }
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          $('.btn-block').attr('disabled', true);
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        console.log(status)
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
                $('.btn-block').attr('disabled', false);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            console.log(token);
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            var frmData = $form.serialize();
            console.log(frmData);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('buyer.stripe.post') }}",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: frmData,
                success: function(response) {
                    console.log(response.status);
                    console.log(response.message);
                    if(response.status=='success')
                    {
                        $('.alert-success div p:first').html(response.message)
                        setTimeout(() => {
                            parent.location.href = "{{route('buyer.stripe.confirm')}}";
                        }, 500);
                    }
                    else {
                        $('.alert-danger').html(response.message);
                        $('.error').removeClass('hide');
                        $('.btn-block').attr('disabled', false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
            });
            //$form.get(0).submit();
        }
    }

});

function paymentCard(id){
	  var csrfToken = $('meta[name="csrf-token"]').attr('content');
	var url = "{{ url('buyer/cards/fetch')}}/"+id;
            $.ajax({
                url: url,
                type: 'GET',
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    //console.log(response.status);
                    //console.log(response.message);
                    if(response.status=='success')
                    {
                        $('#strName').val(response.name_on_card)
                        $('#cNumber').val(response.card_number)
                        $('#nMonth').val(response.month)
                        $('#nYear').val(response.year)
                    }
                    else {
						$('#strName').val('')
                        $('#cNumber').val('')
                        $('#nMonth').val('')
                        $('#nYear').val('')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
			});
}
</script>
</html>
