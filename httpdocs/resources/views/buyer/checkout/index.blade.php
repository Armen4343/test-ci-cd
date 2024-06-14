@extends('layouts.buyer.master')

@section('buyer')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <style>
        .hide {
            display: none !important
        }
    </style>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Carrello&nbsp;<span id="cd-cart-trigger"
                                                             style="padding-left:5px; font-size: 1.00rem; cursor: pointer; color: #FF0066;">Vedi/Modifica il tuo carrello</span></span>
                <span class="badge badge-secondary badge-pill totalitems">{{ count($cartItems) }}</span>
            </h4>
            <ul class="list-group mb-3 maincartlist">
                @php
                    $nTotal = 0;
                    $nVendor = 0;
                @endphp
                @foreach($cartItems as $cartItem)
                    @php
                        $vendor = \App\Models\User::find($cartItem['vendor']);
                        $saleTax = \App\Models\Tax::where('state', $vendor['state'])->first();
                    @endphp
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ $cartItem['name'] }}</h6>
                            <small class="text-muted">
                                Da consumarsi entro: @if(!empty($cartItem['expiry_date'])) {{ date("d-m-Y", strtotime($cartItem['expiry_date'])) }} @endif<br>
                                {{ $cartItem['quantity'] }}x
                            </small>
                            @php
                                if($nTotal==0)
                                {
                                    $nVendor = $cartItem['vendor'];
                                }
                            @endphp
                        </div>
                        <span class="text-muted">
                        <?php
                                //if($_SERVER['REMOTE_ADDR']=='39.37.195.144')
                                //{
                                ?>
                            @if($cartItem['item_type']=='single')
                                @php
                                    $price = $cartItem['baseprice'] * $cartItem['quantity'];
                                    $discount = $cartItem['discount'];
                                    $nDiscountedPrice = $cartItem['baseprice'] - round($cartItem['baseprice'] * $discount /  100, 2);
                                    $tax = $cartItem['tax'];
                                    $nTax = round(($price - ($price * $discount / 100)) * $tax/100, 2);
                                @endphp
                                <table>
                                        @if($discount>0)
                                        <tr>
                                                <td>Prezzo:</td>
                                                <td><span class="text-success">&euro;{{number_format($nDiscountedPrice, 2, ',', '')}}</span></td>
                                            </tr>
                                        <tr>
                                                <td>Valore:</td>
                                                <td><span style="text-decoration: line-through;">&euro;{{ number_format($cartItem['baseprice'], 2, ',', '')}}</span></td>
                                            </tr>
                                    @else
                                        Prezzo:
                                        &euro;{{number_format($cartItem['baseprice'], 2, ',', '')}}@if($cartItem['baseprice']<10)
                                            &nbsp;
                                        @endif<br>
                                    @endif
                                        <tr>
                                            <td>Sconto:</td>
                                            <td>{{$cartItem['discount']}}%</td>
                                        </tr>
{{--                                        <tr>--}}
{{--                                            <td>Imposta sulle vendite:</td>--}}
{{--                                            <td>${{$nTax}}</td>--}}
{{--                                        </tr>--}}
                                        <tr>
                                            <td><b>Totale:</b></td>
                                            <td><b><span style="color:#FF0066">&euro;{{ number_format($cartItem['price'], 2, ',', '') }} </span></b></td>
                                        </tr>
                                    </table>
                            @else
                                @php
                                    $price = $cartItem['baseprice'] * $cartItem['quantity'];
                                    $tax = $cartItem['tax'];
                                    $nTax = round($price * $tax/100, 2);
                                @endphp
                                <table>
                                        <tr>
                                            <td>Prezzo:</td>
                                            <td><span class="text-success">&euro;{{number_format($cartItem['baseprice'], 2, ',', '')}}</span></td>
                                        </tr>

                                        <tr>
                                            <td><b>Totale:</b></td>
                                            <td><b><span style="color:#FF0066">&euro;{{ number_format($cartItem['price'], 2, ',', '') }} </span></b></td>
                                        </tr>
                                    </table>

                            @endif
                                <?php
                                /*}
                                else
                                {
                                    ?>
                                    @if($cartItem['item_type']=='single')
                                        @php
                                        $price = $cartItem['baseprice'] * $cartItem['quantity'];
                                        $discount = $cartItem['discount'];
                                        $nDiscountedPrice = $cartItem['baseprice'] - round($cartItem['baseprice'] * $discount /  100, 2);
                                        $tax = $cartItem['tax'];
                                        $nTax = round(($price - ($price * $discount / 100)) * $tax/100, 2);
                                        @endphp
                                        @if($discount>0)
                                            Base Price: <span class="text-success">${{$nDiscountedPrice}}</span><br>Original Price: <span style="text-decoration: line-through;">${{$cartItem['baseprice']}}</span><br>
                                        @else
                                            Base Price: ${{$cartItem['baseprice']}}@if($cartItem['baseprice']<10) &nbsp; @endif<br>
                                        @endif
                                        Discount: {{$cartItem['discount']}}%<br>
                                        Sales Tax: ${{$nTax}}<br>
                                        <b>Subtotal: <span style="color:#FF0066">${{ $cartItem['price'] }} </span></b>

                                    @else

                                        ${{ number_format($cartItem['price'],2) }}

                                    @endif
                                    <?php
                                }*/
                                ?>

                    </span>
                        @php
                            $nTotal = $nTotal + $cartItem['price'];
                        @endphp
                    </li>
                @endforeach
                <!--<li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                    <h6 class="my-0">Codice Promozionale</h6>
                    <small>EXAMPLECODE</small>
                </div>
                <span class="text-success">-$5</span>
            </li>-->
                <li class="list-group-item d-flex justify-content-between">
                    <span>Totale</span>
                    <strong>&euro;{{number_format($nTotal, 2, ',', '')}}</strong>
                </li>
            </ul>

            <!--<form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>-->
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Dettagli del Pagamento</h4>
            <form id="frmdelivery" name="frmdelivery" method="post" action="{{route('buyer.order.submit')}}">
                @csrf
                <div class='form-row row'>
                    <div class='col-md-12 error form-group {{(isset($status) && $status === 'failed') ? 'show' : 'hide'}}'>
                        <div class='alert-danger alert dateerror'>{{isset($message) && $message}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Il tuo Nome</label>
                        <input type="text" class="form-control" placeholder="Inserisci Nome" name="username"
                               id="username" value="{{ $thisUser->name }}" required>
                        <input type="hidden" name="nVendor" value="{{$vendor->id}}"/>
                        <div class="invalid-feedback">
                            Nome valido e' richiesto.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="useremail">Email</label>
                        <input type="email" class="form-control" placeholder="You@email.com" name="useremail"
                               id="useremail" value="{{ $thisUser->email }}" required>
                        <div class="invalid-feedback">
                            Email valida e' richiesta.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Telefono</label>
                        <input type="tel" class="form-control" placeholder="Inserisci numero telefono" name="userphone"
                               id="userphone" value="{{ $thisUser->phone }}" required>
                        <div class="invalid-feedback">
                            Telefono valido e' richiesto.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="strDeliveryTime">Data ritiro</label>
                        <input type="date" class="form-control datepicker" style="border-color: #FF0066;" placeholder=""
                               name="strDeliveryDate" id="strDeliveryDate" value="{{ date('d/m/Y') }}"
                               min="{{ date('d/m/Y') }}" required>
                        <div class="invalid-feedback">
                            Per favore scegli data di ritiro.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="strDeliveryTime">Orario ritiro</label>
                        <input type="text" class="form-control timepicker" style="border-color: #FF0066;" placeholder=""
                               name="strDeliveryTime" id="strDeliveryTime" value="" required>
                        <div class="invalid-feedback">
                            Per favore scegli ora di ritiro.
                        </div>
                    </div>

                </div>
                <div class="mb-3 hide">
                    <label for="useraddress">Indirizzo</label>
                    <input type="text" class="form-control" placeholder="1234 Main St" name="useraddress"
                           id="useraddress" value="">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Città</label>
                        <input type="text" class="form-control" placeholder="La tua città" name="usercity"
                               onblur="validateCity(this)" id="usercity" value="{{ $thisUser->city }}" required>
                        <div class="invalid-feedback">
                            Per favore inserisci la citta'.
                        </div>
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try again.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 hide">
                        <label for="state">State</label>
                        <input type="text" class="form-control" placeholder="Inserisci Nome" name="userstate"
                               id="userstate" value="{{ $thisUser->state }}">
                        <div class="invalid-feedback">
                            Per favore insierisci lo Stato.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 hide">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" placeholder="Inserisci Codice Postale" name="userzip"
                               id="userzip" value="{{ $thisUser->zipcode }}">
                        <div class="invalid-feedback">
                            Codice Postale richiesto.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col"><br>
                        @if($vendor)
                            <h2 class="mb-3" style="color: #ffbf00;">{{$vendor->name}}</h2>{{$vendor->address}}<br>
                            Postal Code: {{$vendor->zipcode}}<br>
                            <i class="fa-solid fa-phone d-inline-block ms-1"></i>&nbsp;{{$vendor->phone}}
                            <br><br>{{$vendor->business_description}}
                        @endif
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Pagamento</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" type="radio" class="custom-control-input" name="paymentmethod" value="Stripe"
                               required>
                        <label class="custom-control-label" for="credit">Carta di credito</label>
                    </div>
                    <?php
                    /*<div class="custom-control custom-radio">
                        <input id="paypal" type="radio" class="custom-control-input" name="paymentmethod" value="Paypal" required>
                        <label class="custom-control-label" for="paypal">PayPal</label>
                    </div>*/
                    ?>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" style="background-color: #FF0066">
                    Prosegui al checkout
                </button>
            </form>
        </div>
    </div>
    <div class="modal fade" id="stripemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pay via Stripe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body stripeform" style="height: 600px; overflow-y:auto;">
                    <iframe id="iframestripe" name="iframestripe" src="" style="width:100%; height: 100%;"></iframe>
                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn bg-white text-dark shadow rounded-0" data-bs-dismiss="modal">Close</button>
                </div>-->
            </div>
        </div>
    </div>
    <?php
    /*<form id="paypal_form" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" enctype="application/x-www-form-urlencoded" accept-charset="UTF-8">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1" >
    <input type="hidden" name="address_override" value="0">
    <input type="hidden" name="charset" value="utf-8">
    <input type="hidden" name="business" value="sasifiqbal703-facilitator@gmail.com">
    <input type="hidden" name="notify_url" value="https://zeepup.estatecoordinator.co.uk/buyer/paypalnotify">
    <input type="hidden" name="return" value="https://zeepup.estatecoordinator.co.uk/buyer/paypalconfirm">
    <input type="hidden" name="cancel_return" value="https://zeepup.estatecoordinator.co.uk/buyer/checkout">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" id="email" name="email" value="{{ $thisUser->email }}">
    <input type="hidden" id="no_shipping" name="no_shipping" value="0">
    <input type="hidden" name="country" value="US">
    <input type="hidden" name="rm" value="2"/>
    <input type="hidden" name="invoice" id="invoice" value="">
    <input type="hidden" name="amount_1" id="amount_1" value="">
    <input type="hidden" name="item_quantity_1" value="1">
    <input type="hidden" name="item_name_1" value="Food Order Zppeup">
    </form>*/
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .select_cart {
            background-color: #ff0664ed;
            border-radius: 20px;
            color: #fff;
            /* width: 50%; */
        }

        .select_cart i {
            padding: 10px 25px;
            font-size: 15px;
        }

        .delete_icon {
            cursor: pointer;
        }

        .added_icon {
            cursor: pointer;
        }

        .decrement_icon {
            cursor: pointer;
        }

        #cd-cart {
            position: fixed;
            top: 0;
            height: 100%;
            width: 100%;
            /* header height */
            /*padding-top: 50px;*/
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            z-index: 500;
        }

        @media only screen and (min-width: 768px) {
            #cd-cart {
                width: 350px;
            }
        }

        @media only screen and (min-width: 1200px) {
            #cd-cart {
                width: 30%;
                /* header height has changed */
                padding-top: 30px;
            }
        }

        #cd-cart {
            right: -100%;
            background: #FFF;
            -webkit-transition: right 0.3s;
            -moz-transition: right 0.3s;
            transition: right 0.3s;
        }

        #cd-cart.speed-in {
            right: 0;
        }

        #cd-cart > * {
            padding: 0 1em;
        }

        #cd-cart h2 {
            font-size: 14px;
            font-size: 0.875rem;
            font-weight: bold;
            text-transform: uppercase;
            margin: 1em 0;
        }

        #cd-cart .cd-cart-items {
            padding: 0;
        }

        #cd-cart .cd-cart-items li {
            position: relative;
            padding: 1em;
            border-top: 1px solid #e0e6ef;
        }

        #cd-cart .cd-cart-items li:last-child {
            border-bottom: 1px solid #e0e6ef;
        }

        #cd-cart .cd-qty, #cd-cart .cd-price {
            color: #a5aebc;
        }

        #cd-cart .cd-price {
            margin-top: .4em;
        }

        #cd-cart .cd-item-remove {
            position: absolute;
            right: 1em;
            top: 50%;
            bottom: auto;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: url("../img/cd-remove-item.svg") no-repeat center center;
        }

        .no-touch #cd-cart .cd-item-remove:hover {
            background-color: #e0e6ef;
        }

        #cd-cart .cd-cart-total {
            padding-top: 1em;
            padding-bottom: 1em;
        }

        #cd-cart .cd-cart-total span {
            float: right;
        }

        #cd-cart .cd-cart-total::after {
            /* clearfix */
            content: '';
            display: table;
            clear: both;
        }

        #cd-cart .checkout-btn {
            display: block;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background: rgb(255 6 100);;
            color: #FFF;
            text-align: center;
        }

        .no-touch #cd-cart .checkout-btn:hover {
            background: rgb(255 6 100);
        }

        #cd-cart .cd-go-to-cart {
            text-align: center;
            margin: 1em 0;
        }

        #cd-cart .cd-go-to-cart a {
            text-decoration: underline;
        }

        @media only screen and (min-width: 1200px) {
            #cd-cart > * {
                padding: 0 2em;
            }

            #cd-cart .cd-cart-items li {
                padding: 1em 2em;
            }

            #cd-cart .cd-item-remove {
                right: 2em;
            }
        }

        #cd-shadow-layer {
            position: fixed;
            min-height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background: rgba(67, 87, 121, 0.6);
            cursor: pointer;
            z-index: 2;
            display: none;
        }

        #cd-shadow-layer.is-visible {
            display: block;
            -webkit-animation: cd-fade-in 0.3s;
            -moz-animation: cd-fade-in 0.3s;
            animation: cd-fade-in 0.3s;
        }
    </style>
    <div id="cd-shadow-layer"></div>
    <div id="cd-cart">
        <div id="cart-close" style="cursor:pointer;"><h2><i class="fa fa-close"
                                                            style="font-size:36px; color: #FF0066"></i></h2></div>
        <ul class="cd-cart-items">
            @php
                $total = 0;
            @endphp
            @if(is_array(Session::get('cart.items')["$vendor->id"]))

                @foreach(Session::get('cart.items')["$vendor->id"] as $item)
                    @php
                        $total = $total + $item['price'];
                        $strCalculation = "";
                        $originalPrice = "";
                        $discount = 0;
                        if($item['item_type']=='single')
                        {
                            $price = $item['baseprice'] * $item['quantity'];
                            $discount = $item['discount'];
                            $tax = $item['tax'];
                            if($discount>0)
                            {
                                //$originalPrice = round($price + ($price * $tax/100), 2);
                                $originalPrice = round($price, 2);
                                $originalPrice = $originalPrice;
                                //$originalPrice = '&nbsp;<span style="text-decoration: line-through.">'.$originalPrice.'</span>';

                                /*$nCalculation = $price - ($discount / 100) * $price;
                                $strCalculation = $price." - ".$discount."%";
                                $strCalculation = "(".$strCalculation.", Tax: ".$tax."%)";*/
                            }


                        }
                    @endphp
                    <li>
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    @if($item['image'] && strpos($item['image'], 'food.png')<=0)
                                        <img src="{{ $item['image'] }}" class="w-100" style="width:100px !important;" ;>
                                    @else
                                        <img src="{{ asset('food.png') }}" class="w-100" style="width:100px !important;"
                                             ;>
                                    @endif
                                </div>
                                <div class="col-6">
                                <span>
                                    {{ $item['name'] }}
                                    @if(isset($item['expiry_date']))
                                        <br>
                                        consumarsi entro: {{$item['expiry_date']}}
                                    @endif
                                    <br>
                                    <span class="cd-price">
                                        @if(isset($item['items']))
                                            {{$item['items']}}<br>
                                        @endif
                                        @php
                                            /*Base Price: ${{$item['baseprice']}}<br>

                                            Discount: {{$item['discount']}}%<br>
                                            Tax: {{$item['tax']}}%<br>
                                            <b>Totale: &euro;{{ $item['price'] }} </b>*/
                                        @endphp
                                        @if($discount>0)
                                            <span class="text-success">@endif&euro;{{ number_format($item['price'], 2, ',', '') }}@if($discount>0)</span>
                                        @endif
                                        &nbsp;@if($discount>0)&euro;<span
                                                style="text-decoration: line-through">{{number_format($originalPrice, 2, ',', '')}}</span>@endif
                                    </span>
                                </span>
                                </div>
                                <div class="col-2 align-items-center"
                                     style="display:inline !important; text-align-last: center; height:78px;">
                                    <br>
                                    <div class="delete_icon"
                                         style="display:inline !important; text-align-last: center;">
                                        <i class="fa-solid fa-trash" style="color:black;"></i>
                                        <input class="itemid" type="hidden" value="{{ $item['id'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">&nbsp;</div>
                                <div class="col">
                                    <div class="select_cart d-flex align-items-center">
                                        <div class="decrement_icon">
                                            <i class="fa-solid fa-minus"></i>
                                            <input class="itemid" type="hidden" value="{{ $item['id'] }}">
                                        </div>
                                        <div class="multi_cart">
                                            {{ $item['quantity'] }}x
                                        </div>
                                        <div class="added_icon">
                                            <i class="fa-sharp fa-light fa-plus"></i>
                                            <input class="itemid" type="hidden" value="{{ $item['id'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">&nbsp;</div>
                            </div>
                        </div>
                    </li>

                @endforeach
            @endif
            <?php
            /*<li>
                <span class="cd-qty">1x</span> Product Name
                <div class="cd-price">$9.99</div>
                <a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
            </li>

            <li>
                <span class="cd-qty">2x</span> Product Name
                <div class="cd-price">$19.98</div>
                <a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
            </li>

            <li>
                <span class="cd-qty">1x</span> Product Name
                <div class="cd-price">$9.99</div>
                <a href="#0" class="cd-item-remove cd-img-replace">Remove</a>
            </li>*/ ?>
        </ul> <!-- cd-cart-items -->

        <div class="cd-cart-total">
            <p>Total <span>&euro;{{number_format($total, 2, ',', '')}}</span></p>
        </div> <!-- cd-cart-total -->
        <a href="checkout" class="checkout-btn">Proceed to Checkout</a>
    </div> <!-- cd-cart -->

@endsection
@section('customjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script>
        @php

            $item = null;
            function getOverlappingDays(array $data): array {
                $allDays = [];
                $overlappingDays = [];

                foreach ($data as $items) {
                    $item = \App\Models\Items::find($items['id']);

                    $days = isset($item['promo_days']) ? explode(',', $item['promo_days']) : [];

                    foreach ($days as $day) {
                        $trimmedDay = trim($day);
                        if (!in_array($trimmedDay, $allDays)) {
                            $allDays[] = $trimmedDay;
                        }
                    }
                }

                foreach ($allDays as $day) {
                    $count = 0;
                    foreach ($data as $items) {
                        $item = \App\Models\Items::find($items['id']);

                        if (isset($item['promo_days']) && strpos($item['promo_days'], $day) !== false) {
                            $count++;
                        }
                    }
                    if ($count === count($data)) {
                        $overlappingDays[] = $day;
                    }
                }

                return $overlappingDays;
            }

            $days = getOverlappingDays($cartItems);

            function findAllIntersections($data) {
                $intersections = [];
                foreach ($data as $key1 => $items) {
                    $item = \App\Models\Items::find($items['id']);
                    if ($item['time_range']) {
                        $range1 = splitTimeRange($item['time_range']);
                        foreach ($data as $key2 => $items2) {
                            if ($key1 === $key2) {
                                continue;
                            }
                            $item2 = \App\Models\Items::find($items2['id']);
                            if ($item2['time_range']){

                                $range2 = splitTimeRange($item2['time_range']);
                                $comparisonResult = compareTimeRanges($range1, $range2);
                                if ($comparisonResult === 0) {
                                    $intersections[] = findIntersectionPoint($range1, $range2);
                                }
                            }

                        }
                    }
                }

                return $intersections;
            }

            function splitTimeRange($timeRange) {
                list($start, $end) = explode('-', $timeRange);
                list($startHour, $startMinute) = explode(':', $start);
                list($endHour, $endMinute) = explode(':', $end);
                return [
                    'start' => [
                        'hour' => (int)$startHour,
                        'minute' => (int)$startMinute,
                    ],
                    'end' => [
                        'hour' => (int)$endHour,
                        'minute' => (int)$endMinute,
                    ],
                ];
            }

            function compareTimeRanges($range1, $range2) {
                if ($range1['start']['hour'] > $range2['end']['hour']) {
                    return 1;
                } elseif ($range1['end']['hour'] < $range2['start']['hour']) {
                    return -1;
                } else {
                    return 0;
                }
            }

            function findIntersectionPoint($range1, $range2) {
                $intersectionHour = max($range1['start']['hour'], $range2['start']['hour']);
                $intersectionMinute = max($range1['start']['minute'], $range2['start']['minute']);
                return $intersectionHour . ':' . ($intersectionMinute < 10 ? '0' : '') . $intersectionMinute;
            }

            function convertToMinutes($timeStr) {
                list($hours, $minutes) = explode(':', $timeStr);
                return (int)$hours * 60 + (int)$minutes;
            }

            $uniqueArray = [];

            if (count($cartItems) === 1) {
                $items = reset($cartItems);
                $item = \App\Models\Items::find($items['id']);
                if ($item['time_range']) {
                    $uniqueArray = explode('-', $item['time_range']);
                }
            } else if (count($cartItems) > 1) {
                $allIntersections = findAllIntersections($cartItems);
                $sortIntersections = $allIntersections;
                sort($sortIntersections);
                $uniqueArray = array_unique($sortIntersections);
            }
        @endphp

        const dayToNumber = {
            'Monday': 1,
            'Tuesday': 2,
            'Wednesday': 3,
            'Thursday': 4,
            'Friday': 5,
            'Saturday': 6,
            'Sunday': 0,
            'Lunedì': 1,
            'Martedì': 2,
            'Mercoledì': 3,
            'Giovedì': 4,
            'Venerdì': 5,
            'Sabato': 6,
            'Domenica': 0,

            'monday': 1,
            'tuesday': 2,
            'wednesday': 3,
            'thursday': 4,
            'friday': 5,
            'saturday': 6,
            'sunday': 0,
            'lunedì': 1,
            'martedì': 2,
            'mercoledì': 3,
            'giovedì': 4,
            'venerdì': 5,
            'sabato': 6,
            'domenica': 0,
        };

        const endDate = "{!!  isset($endDate) && $endDate ? $endDate : ''!!}";
        const days = <?= json_encode($days) ?>;
        const filteredAvailbleDays = {!! isset($filteredAvailableDays) ? json_encode($filteredAvailableDays) : json_encode([])!!};
        const numbers = days && days.length ? days.map(day => dayToNumber[day]) : filteredAvailbleDays.map(day => dayToNumber[day]);
        const isMaxDate = {!! $item ||( isset($endDate) && $endDate) ? 'true' : 'false' !!};

        $("#strDeliveryDate").flatpickr({
            enableTime: false,
            dateFormat: "d/m/Y",
            defaultDate: new Date(),
            minDate: 'today',
            ...(isMaxDate && { maxDate: endDate && endDate !== '' ? endDate : "{!!  $item ? date('d/m/Y', strtotime(explode(' - ', $item['date_range'])[1])) : '' !!}"}),
            ...(numbers.length && {
                "disable": [
                    function (date) {
                        return !numbers.includes(date.getDay());
                    }
                ]
            }),
            "locale": {
                "firstDayOfWeek": 1 // set start day of week to Monday
            }
        });

        @if(isset($startTime) && $startTime && isset($endTime) && $endTime)
            $('.timepicker').timepicker({
                timeFormat: 'H:mm',
                interval: 30,
                minTime: "{{ $startTime}}",
                maxTime: "{{ $endTime }}",
                startTime: "{{ $startTime }}",
                dynamic: true,
                dropdown: true,
                scrollbar: true
            });
        @endif

        @if(count($uniqueArray) === 1)
            $('.timepicker').timepicker({
                timeFormat: 'H:mm',
                interval: 30,
                minTime: "{{ $uniqueArray[0] }}",
                maxTime: "{{ $uniqueArray[0] }}",
                startTime: "{{ $uniqueArray[0] }}",
                dynamic: true,
                dropdown: true,
                scrollbar: true
            });
        @endif

        @if(count($uniqueArray) === 2)
            $('.timepicker').timepicker({
                timeFormat: 'H:mm',
                interval: 30,
                minTime: "{{ $uniqueArray[0] }}",
                maxTime: "{{ $uniqueArray[1] }}",
                startTime: "{{ $uniqueArray[0] }}",
                dynamic: true,
                dropdown: true,
                scrollbar: true
            });
        @endif
        function validateCity(obj) {
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

            if (isValid) {
                $(obj).parent().removeClass('has-error');
                $(obj).parent().find('div.error').addClass('hide');
                $(obj).parent().find('div.error').find('div.alert-danger').html('Please correct the errors and try again.');
            } else {
                $(obj).parent().addClass('has-error');
                $(obj).focus();
                $(obj).parent().find('div.error').find('div.alert-danger').html('Invalid City.');
                $(obj).parent().find('div.error').removeClass('hide');
            }
        }

        $('.checkout-btn').click(function (e) {
            e.preventDefault();

            $('#frmdelivery').submit();
        })

        var paymentmethod = "Stripe";
        /*$('#btnpaypal').click(function(){
            $('#paymentmethod').val('Paypal');
            paymentmethod = 'Paypal';
        });*/
        $('#btnstripe').click(function () {
            $('#paymentmethod').val('Stripe');
            paymentmethod = 'Stripe';
        });
        /* $('#frmdelivery').on('submit', function(e){
                 // validation code here
                 e.preventDefault();
                 $('.dateerror').html('');
                 $('.error').addClass('hide');
                 paymentmethod = $('input[name=paymentmethod]:checked', '#frmdelivery').val()


                 data = $(this).serialize();
                 var csrfToken = $('meta[name="csrf-token"]').attr('content');
                 $.ajax({
                     url: "{{route('buyer.order.submit')}}",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: data,
                success: function(response) {
                    if(response.status=='failed')
                    {
                        $('.dateerror').html(response.message);
                        $('.error').removeClass('hide');
                    }
                    else
                    {
                        //console.log(response);
                        //return;
                        //alert('Item added to cart!');
                        /!*if(paymentmethod == 'Paypal')
                        {
                            $('#invoice').val(response.orderid);
                            $('#amount_1').val(response.amount_1);
                            $('#paypal_form').submit();
                        }
                        else {*!/
                            //Stripe
                            //$('.stripeform').html(response);
                            $('#stripemodal').modal('toggle');
                            var iframe = $('#iframestripe');
                            if (iframe.length) {
                                iframe.attr('src',"{{ route('buyer.stripe.form') }}");
                                return false;
                            }

                            //window.location.href = "{{route('buyer.stripe.form')}}";
                        //}
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Error placing an order');
                }
            });

        });*/

        $(document).ready(function () {
            // $('#userphone').keyup(function(){
            //     // Don't run for backspace key entry, otherwise it bugs out
            //     if(event.which != 8){
            //
            //         // Remove invalid chars from the input
            //         var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");
            //         var inputlen = input.length;
            //         // Get just the numbers in the input
            //         var numbers = this.value.replace(/\D/g,'');
            //         var numberslen = numbers.length;
            //         // Value to store the masked input
            //         var newval = "";
            //
            //         // Loop through the existing numbers and apply the mask
            //         for(var i=0;i<numberslen;i++){
            //             if(i==0) newval="+"+numbers[i]+"-";
            //             else if(i==3) newval+=numbers[i]+"-";
            //             else if(i==7) newval+="-"+numbers[i];
            //             else newval+=numbers[i];
            //         }
            //
            //         // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.
            //         if(inputlen>=1&&numberslen==0&&input[0]=="(") newval="(";
            //         else if(inputlen>=6&&numberslen==3&&input[4]==")"&&input[5]==" ") newval+=") ";
            //         else if(inputlen>=5&&numberslen==3&&input[4]==")") newval+=" ";
            //         else if(inputlen>=6&&numberslen==3&&input[5]==" ") newval+=" ";
            //         else if(inputlen>=10&&numberslen==6&&input[9]=="-") newval+="-";
            //
            //         $(this).val(newval.substring(0,15));
            //
            //     }
            // });

            @if($vendor->vendorsAvailabilities)
                $('.timepicker').timepicker({
                    timeFormat: 'H:mm',
                    interval: 30,
                    minTime: "{{ $vendor->vendorsAvailabilities[strtolower(date('l')) . '_open'] }}",
                    maxTime: "{{ $vendor->vendorsAvailabilities[strtolower(date('l')) . '_close'] }}",
                    // defaultTime: '09:00',
                    startTime: "{{ $vendor->vendorsAvailabilities[strtolower(date('l')) . '_open'] }}",
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true
                });
            @endif

            //$('.datepicker').datepicker({});
            var strDate = "{{date("Y-m-d")}}";
            var nVendor = "{{$nVendor}}";
            $('#strDeliveryDate').on('change', function () {
                strDate = $(this).val();
                if (!numbers.length) {
                    $('#strDeliveryTime').attr('disabled', true);
                    getTimeSlots();
                }
            });

            function getTimeSlots() {
                $('.error').addClass('hide');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{route('buyer.get.vendor.time')}}",
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: {'strDate': strDate, 'nVendor': nVendor},
                    success: function (response) {
                        if (response.Error) {
                            $('.dateerror').html(response.Error);
                            $('.error').removeClass('hide');
                            if ($('.timepicker').timepicker()) {
                                $('.timepicker').timepicker('destroy');
                            }

                            //$('.timepicker').data('TimePicker').items = null;
                            //$('.timepicker').data('TimePicker').widget.instance = null;
                            $('.timepicker').val('');
                        } else {
                            if ($('.timepicker').timepicker()) {
                                $('.timepicker').timepicker('destroy');
                            }


                            $('.timepicker').val('');
                            console.log(response.strOpenTime);
                            console.log(response.strCloseTime);
                            $('.timepicker').timepicker({
                                timeFormat: 'H:mm',
                                interval: 30,
                                minTime: response.strOpenTime,
                                maxTime: response.strCloseTime,
                                defaultTime: response.strOpenTime,
                                startTime: response.strOpenTime,
                                dynamic: false,
                                dropdown: true,
                                scrollbar: true
                            });
                            setTimeout(enabletime, 1500);

                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            }

            function enabletime() {
                $('#strDeliveryTime').attr('disabled', false);
            }

            //getTimeSlots();
            //  $('#strDeliveryTime').attr('disabled', true);
            // setTimeout(getTimeSlots, 1000);
        });
    </script>
    <script>
        jQuery(document).ready(function ($) {
            //if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
            var $L = 1200,
                $menu_navigation = $('#main-nav'),
                $cart_trigger = $('#cd-cart-trigger'),
                $cart_trigger_close = $('#cart-close');
            $hamburger_icon = $('#cd-hamburger-menu'),
                $lateral_cart = $('#cd-cart'),
                $shadow_layer = $('#cd-shadow-layer');


            //open lateral menu on mobile
            $hamburger_icon.on('click', function (event) {
                event.preventDefault();
                //close cart panel (if it's open)
                $lateral_cart.removeClass('speed-in');
                toggle_panel_visibility($menu_navigation, $shadow_layer, $('body'));
            });

            //open cart
            $cart_trigger.on('click', function (event) {
                event.preventDefault();
                //close lateral menu (if it's open)
                $menu_navigation.removeClass('speed-in');
                toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
            });
            $cart_trigger_close.on('click', function (event) {
                event.preventDefault();
                //close lateral menu (if it's open)
                $menu_navigation.removeClass('speed-in');
                toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
            });


            //close lateral cart or lateral menu
            $shadow_layer.on('click', function () {
                $shadow_layer.removeClass('is-visible');
                // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
                if ($lateral_cart.hasClass('speed-in')) {
                    $lateral_cart.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                        $('body').removeClass('overflow-hidden');
                    });
                    $menu_navigation.removeClass('speed-in');
                } else {
                    $menu_navigation.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                        $('body').removeClass('overflow-hidden');
                    });
                    $lateral_cart.removeClass('speed-in');
                }
            });

            //move #main-navigation inside header on laptop
            //insert #main-navigation after header on mobile
            move_navigation($menu_navigation, $L);
            $(window).on('resize', function () {
                move_navigation($menu_navigation, $L);

                if ($(window).width() >= $L && $menu_navigation.hasClass('speed-in')) {
                    $menu_navigation.removeClass('speed-in');
                    $shadow_layer.removeClass('is-visible');
                    $('body').removeClass('overflow-hidden');
                }

            });
        });

        function toggle_panel_visibility($lateral_panel, $background_layer, $body) {
            if ($lateral_panel.hasClass('speed-in')) {
                // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
                $lateral_panel.removeClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                    $body.removeClass('overflow-hidden');
                });
                $background_layer.removeClass('is-visible');

            } else {
                $lateral_panel.addClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                    $body.addClass('overflow-hidden');
                });
                $background_layer.addClass('is-visible');
            }
        }

        function move_navigation($navigation, $MQ) {
            if ($(window).width() >= $MQ) {
                $navigation.detach();
                $navigation.appendTo('header');
            } else {
                $navigation.detach();
                $navigation.insertAfter('header');
            }
        }

        $(document).on('click', '.delete_icon', function (event) {
            event.preventDefault();
            itemid = $(this).find('.itemid').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/cart/remove',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: {id: itemid, vendorid: '{{$vendor->id}}'},
                success: function (response) {
                    console.log(response);
                    //return;
                    //alert('Item added to cart!');
                    itemhtml = '';
                    if (response.items.length > 0) {
                        //ncounter = parseInt($('#view-cart-link').html());
                        displaycart(response.items);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Error adding item to cart');
                }
            });
        });
        $(document).on('click', '.decrement_icon', function (event) {
            event.preventDefault();
            itemid = $(this).find('.itemid').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/cart/decrement',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: {id: itemid, vendorid: '{{$vendor->id}}'},
                success: function (response) {
                    console.log(response);
                    //return;
                    //alert('Item added to cart!');
                    displaycart(response.items);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Error adding item to cart');
                }
            });
        });
        $(document).on('click', '.added_icon', function (event) {
            event.preventDefault();
            itemid = $(this).find('.itemid').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/cart/increment',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: {id: itemid, vendorid: '{{$vendor->id}}'},
        success: function(response) {
            console.log(response);
            //return;
            //alert('Item added to cart!');
            displaycart(response.items);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            alert('Error adding item to cart');
        }
    });
});

function displaycart(items)
{
    itemhtml = '';
    ncounter = 0;
    $('.cd-cart-items').empty();
    $('.maincartlist').empty();
    var totalprice = 0;
    if(items.length>0){


        (items).forEach( function(item){
            console.log(item);
            itemli = "";


            ncounter = ncounter+1;
            strItemList = "";
            if("items" in item){ /** will return true if exist */
                strItemList = item.items+"<br>";
            }
            //strPriceDetail = "";
            strExpiryDate = "";
            if("expiry_date" in item)
            {
                strExpiryDate = 'Data scadenza: '+item.expiry_date;
            }
            //strExpiryDate = strExpiryDate+'<br>'+item.price;
            var originalPrice = '';

            if("discount" in item)
            {
                var price = item.baseprice * item.quantity;
                var tax = item.tax;
                //originalPrice = (price + (price * tax/100)).toFixed(2);
                originalPrice = (price).toFixed(2);
                originalPrice = '&nbsp;<span style="text-decoration: line-through">&euro;'+ (originalPrice ? Number(originalPrice).toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00') +'</span>';
            }
            //strExpiryDate = strExpiryDate + originalPrice;
            /*if("discount" in item)
            {
                strPriceDetail = "Base Price: $"+item.baseprice+"<br>";
                strPriceDetail = strPriceDetail + "Discount: "+item.discount+"%<br>";
                strPriceDetail = strPriceDetail + "Tax: "+item.tax+"%<br>";
                strPriceDetail = strPriceDetail + "Subtotal: $"+item.price+"<br>";
            }
            else {
                strPriceDetail = "<b>Subtotal: $"+item.price+" </b>";
            }*/

            mainitem = '<li class="list-group-item d-flex justify-content-between lh-condensed">';
            mainitem = mainitem + '<div><h6 class="my-0">'+item.name+'</h6>';
            mainitem = mainitem + '<small class="text-muted">Expiry: '+item.expiry_date+'<br>'+item.quantity+'x</small>';
            if(ncounter==1)
            {
                nVendor = item.vendor;
            }
            mainitem = mainitem + '</div><span class="text-muted">';
            if(item.item_type=='single')
            {
                price = item.baseprice * item.quantity;
                discount = item.discount;
                tax = item.tax;
                mainitem = mainitem + 'Base Price: '+item.baseprice+'<br>';
                mainitem = mainitem + 'Discount: '+item.discount+'%<br>';
                //mainitem = mainitem + 'Tax: '+item.tax+'%<br>';
                mainitem = mainitem + '<b>Subtotal: <span style="color:#FF0066">&euro;'+ (item.price ? Number(item.price).toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00') +' </span></b>';
            }
            else{
                mainitem = mainitem + item.price.toFixed(2)
            }
            mainitem = mainitem + '</span></li>';
            $('.maincartlist').append(mainitem);
            var imgurl = item.image;
            if(imgurl.indexOf("food.png")<0)
            {
                imgurl = imgurl;
            }



            /*itemli = '<li><div class="container"><div class="row"><div class="col"><img src="'+imgurl+'" class="w-100" style="width:100px !important;";></div>';
            itemli = itemli + '<div class="col-4"><span><br>'+item.name+'<br><span class="cd-price">'+strItemList+''+strExpiryDate+'</span></span></div>';
            itemli = itemli + '<div class="col align-items-center" style="display:inline !important; text-align-last: center; height:78px;"><br>';
            itemli = itemli + '<div class="delete_icon" style="display:inline !important; text-align-last: center;"><i class="fa-solid fa-trash" style="color:black;"></i>';
            itemli = itemli + '<input class="itemid" type="hidden" value="'+item.id+'"></div></div></div><div class="row"><div class="col">&nbsp;</div>';
            itemli = itemli + '<div class="col"><div class="select_cart d-flex align-items-center"><div class="decrement_icon"><i class="fa-solid fa-minus"></i>';
            itemli = itemli + '<input class="itemid" type="hidden" value="'+item.id+'"></div><div class="multi_cart">'+item.quantity+'x</div>';
            itemli = itemli + '<div class="added_icon"><i class="fa-sharp fa-light fa-plus"></i><input class="itemid" type="hidden" value="'+item.id+'"></div>';
            itemli = itemli + '</div></div><div class="col">&nbsp;</div></div></div></li>';*/
            itemli = '<li><div class="container"><div class="row">';
            itemli = itemli + '<div class="col-4"><img src="'+imgurl+'" class="w-100" style="width:100px !important;" ;=""></div>';
            itemli = itemli + '<div class="col-6"><span>'+item.name+'<br>'+strExpiryDate+'<br><span class="cd-price">&euro;'+ Number(item.price + originalPrice).toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</span></span></div>';
            itemli = itemli + '<div class="col-2 align-items-center" style="display:inline !important; text-align-last: center; height:78px;"><br>';
            itemli = itemli + '<div class="delete_icon" style="display:inline !important; text-align-last: center;"><i class="fa-solid fa-trash" style="color:black;"></i>';
            itemli = itemli + '<input class="itemid" type="hidden" value="'+item.id+'"></div></div></div>';
            itemli = itemli + '<div class="row"><div class="col">&nbsp;</div><div class="col"><div class="select_cart d-flex align-items-center">';
            itemli = itemli + '<div class="decrement_icon"><i class="fa-solid fa-minus"></i><input class="itemid" type="hidden" value="'+item.id+'"></div>';
            itemli = itemli + '<div class="multi_cart">'+item.quantity+'x</div><div class="added_icon">';
            itemli = itemli + '<i class="fa-sharp fa-light fa-plus"></i><input class="itemid" type="hidden" value="'+item.id+'"></div></div>';
            itemli = itemli + '</div><div class="col">&nbsp;</div></div></div></li>';
            $('.cd-cart-items').append(itemli);
            totalprice = parseFloat(totalprice) + parseFloat(item.price);
        });

        $('.cd-cart-total').html('<p>Total <span>&euro;' + Number(totalprice).toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</span></p>');
        $('.totalitems').html(ncounter);

        maintotal = '<li class="list-group-item d-flex justify-content-between"><span>Total</span><strong>&euro;' + Number(totalprice).toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</strong></li>';
        $('.maincartlist').append(maintotal);
    }
    else {
        $('.cd-cart-total').html('<p>Total <span>$'+totalprice.toFixed(2)+'</span></p>');
    }
}
    </script>
@endsection
