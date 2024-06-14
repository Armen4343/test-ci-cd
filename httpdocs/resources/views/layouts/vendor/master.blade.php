<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="">
    <title>ZeepUp</title>
    <meta charset="utf-8"/>
    <meta name="description"
          content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free."/>
    <meta name="keywords"
          content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme"/>
    <meta property="og:url" content="https://keenthemes.com/metronic"/>
    <meta property="og:site_name" content="Keenthemes | Metronic"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>

    <link rel="icon" href="https://it.zeepup.com/front-end/images/favicon.png" type="image/png" sizes="64x64">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('front-end/dashboard.css') }}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <style>
        .main-pink-color {
            color: #ff0066 !important;
        }

        .svg-icon svg [fill]:not(.permanent):not(g) {
            transition: fill .3s ease;
            fill: #ff0066;
        }
        @if(!request()->is('dashboard/items/*/edit'))
            .bootstrap-datetimepicker-widget {
                margin-left: -100px !important;
            }
            .bootstrap-datetimepicker-widget.dropdown-menu.bottom:after {
                right: 8px;
                left: unset !important;
            }
            .bootstrap-datetimepicker-widget.dropdown-menu.bottom:before {
                right: 7px;
                left: unset !important;
            }
        @endif
    </style>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            @include('layouts.vendor.header')
            <div class="kt_header-ribbon" style="z-index:10;">
                <!--begin::Name-->

                <div class="d-flex justify-content-between">
                    <div>
                        @php $state =  \App\Models\Tax::where(['state' => Auth::user()->state])->first();
                        @endphp
                        <p class="text-light mx-5 mt-1 text-capitalize" style="font-size: 14px">{{ Auth::user()->role}}
                            - {{ Auth::user()->state?Auth::user()->state:"No state"}}
                        </p>
                    </div>

                    <div>
                        <p class="text-light mx-5 mt-1 float-end" style="font-size: 14px">{{ Auth::user()->name}}</p>
                    </div>
                </div>
                <!--end::Name-->
            </div>
            <!--end::Header-->
            <!--begin::Content wrapper-->
            <div class="h-100">
                <!--begin::Aside-->
                <div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside"
                     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                     data-kt-drawer-toggle="#kt_aside_toggle">
                    <!--begin::Aside menu-->
                    @include('layouts.vendor.sidebar')
                    <!--end::Aside menu-->

                </div>
                <!--end::Aside-->
                <!--begin::Container-->
                <div class="d-flex flex-column flex-column-fluid main w-100">
                    <!--begin::Post-->
                    <div class="content flex-column-fluid card" id="kt_content">
                        @yield('vendor')

                    </div>
                    <!--end::Post-->
                    <!--begin::Footer-->
                    @include('layouts.vendor.footer')
                    <!--end::Footer-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Content wrapper-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->


<!-- Modal start -->

<div class="modal fade" tabindex="-1" id="addItemModal">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiungi Prodotto</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">


                @php
                    $Categories = \App\Models\Category::where(['status' => '1'])->get();
                    $cuisines = \App\Models\Cuisine::where(['status' => '1', 'vendor_id' => Auth::user()->id])->get();
                    $dishes = \App\Models\Dish::where(['status' => '1'])->get();
                    $days=[1,2,3,4,5,6,7,8,9,10];
                @endphp
                <form action="" method="post" enctype="multipart/form-data" id="addItemForm">
                    @csrf
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12 my-3">
                            <label class="required fw-bold fs-6 mb-2">Nome Prodotto </label>
                            <input type="text" class="form-control" name="name" id="name" required="required"
                                   placeholder="Burger and Fries">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Seleziona Categoria</label>
                            <div class="row">
                                @foreach($Categories as $Category)
                                    <div class="col-md-6">
                                        <div
                                            class="form-check form-check-danger form-check-solid form-check-custom mb-2">
                                            <input class="form-check-input" type="radio" value="{{ $Category->id }}"
                                                   id="flexRadioDefault" name="category" required="required"/>
                                            <label class="form-check-label" for="flexRadioDefault">
                                                {{ $Category->title }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-6 my-3">
                          <!--elisa  <label class="fw-bold fs-6 mb-2">Scegli SottoCategoria</label>

                            <div class="row">
                                @if($cuisines->count() > 0)
                                    @foreach($cuisines as $dish_catgory)

                                        <div class="col-md-6">
                                            <div
                                                class="form-check form-check-danger form-check-solid form-check-custom mb-2">
                                                <input class="form-check-input radio-btn" type="radio"
                                                       value="{{ $dish_catgory->id }}" id="flexRadioDefault"
                                                       name="cuisine_type" required="required"/>
                                                <label class="form-check-label" for="flexRadioDefault">
                                                    {{ $dish_catgory->title }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--																@else--}}
                                    {{--																<p class="text-danger">Il campo verrà popolato non appena si crea la SottoCategoria del tuo Prodotto e/o la tua Cucina Tipica nel menu principale.</p>--}}
                                @endif elisa-->
                            </div> 

                        <div class="col-md-6 my-3">
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Descrizione</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <textarea name="description" required="required" class="form-control " rows="4"
                                          placeholder="Breve descrizione prodotto..."></textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="fw-bold fs-6 mb-2"> Immagine&nbsp; (500 x 500)</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*"
                                   onchange="loadFile(event)">
                            <div class="preview-img d-none mt-3" id="preview-img">
                                <img id="output" class="img w-100 rounded-1"
                                     style="height:200px; object-fit:cover;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"/>
                                <i class="fas fa-times" id="remove-preview"></i>
                            </div>
                        </div>
                        <div class="col-12 my-3">
                            <label class="fw-bold fs-6 mb-2">Allergie </label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Sedano"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Sedano
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Glutine"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Glutine
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Crostacei"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Crostacei
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Uova"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Uova
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Pesce"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Pesce
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Lupini"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Lupini
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Latte"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Latte
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Molluschi"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Molluschi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Mostarda"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Mostarda
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Frutta a Guscio"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Frutta a Guscio
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Archidi"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Archidi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Sesamo"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Sesamo
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Soia"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Soia
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input h-20px w-30px" type="checkbox"
                                               name="alergen_info[]" value="Solfiti"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Solfiti
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--begin::Input wrapper-->
                        <div class="col-md-12 my-3">
                            <!--begin::Input wrapper-->

                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">
                                Prezzo
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                   title="Choose the price for item."></i>
                                <input type="hidden" name="price" id="price"/>
                            </label>
                            <!--end::Label-->

                            <!--begin::Slider-->
                            <div class="d-flex flex-column text-center">
                                <div class="d-flex align-items-start justify-content-center mb-7"
                                     style="color: #ff0066;">
                                    <span class="fw-bolder fs-4 mt-1 me-2">€ </span>
                                    <span class="fw-bolder fs-3x" id="kt_modal_create_campaign_budget_label"></span>
                                    <span class="fw-bolder fs-3x"></span>
                                </div>
                                <div id="kt_modal_create_campaign_budget_slider" class="noUi-sm" style="background: #ff0066;
"></div>
                            </div>
                            <!--end::Slider-->

                            <!--end::Input wrapper-->

                        </div>
                        <!--end::Input wrapper-->
                        <div class="col-md-12 mt-3 mb-5">
                            <input type="text" class="form-control" name="price-input" id="price-input"
                                   onkeyup="calculatePrice(event)" onkeypress="return isNumberKey(this, event);">
                        </div>

                        <div class="col-md-12 mt-3 mb-5">
                            <label class="fw-bold fs-6 mb-2">Sconto (%)</label>
                            <input type="number" class="form-control" name="discount" id="discount" placeholder="25%"
                                   onkeyup="calculatePrice(event)" value="0" oninput="this.value =
 !!this.value && Math.abs(this.value) >= 0 && Math.abs(this.value) <= 95 ? Math.abs(this.value) : null">
                        </div>
                        <div class="col-md-6 mt-3 mb-5" style="display:none">
                            <div class="form-check form-check-danger form-check-solid form-check-custom mb-3">

                                <input class="form-check-input" type="radio" value="local" id="tax_type" name="tax_type"
                                       checked="checked"/>
                                <label class="form-check-label pe-3" for="flexCheckDefault">
                                    IVA
                                </label>
                            </div>
                            <div class="mb-5" id="local-tax-box">
                                @php $state =  \App\Models\Tax::where(['state' => Auth::user()->state])->first();
																	$spTaxes =  \App\Models\SpecialTax::where(['vendor_id' => Auth::user()->id])->get();
                                @endphp
                                @if($state)
                                    <input name="local-tax" required="" id="local-tax" class="form-control"
                                           value="{{ $state->tax}}" readonly/>
                                    <input type="hidden" name="tax" value="{{ $state->tax }}" id="tax">
                                @else
                                    <input name="local-tax" required="" class="form-control" value="0" readonly/>
                                    <input type="hidden" name="tax" value="0" id="tax">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-5" style="display:none">
                            <div class="form-check form-check-danger form-check-solid form-check-custom mb-3">

                                <input class="form-check-input" type="radio" value="special"
                                       id="special-tax-input tax_type" name="tax_type"/>
                                <label class="form-check-label pe-3" for="flexCheckDefault">
                                    Imposta Speciale
                                </label>
                            </div>
                            <div class="mb-5" style="display:none;" id="special-tax-box">
                                <select class="form-select" name="tax1" id="special-tax"
                                        onChange="changeTax(this.options[this.selectedIndex].value)">
                                    <option value="0"> Choose one</option>
                                    @foreach($spTaxes as $spTax)
                                        <option value="{{$spTax->value}}">{{$spTax->title}} ({{$spTax->value}}%)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6 mb-3" style="visibility:hidden">
                            <label class="form-label pe-3" for="flexCheckDefault">
                                La tassa è inclusa nel prezzo?
                            </label>
                            <div class="form-check form-check-danger form-check-solid form-check-custom mb-3">

                                <input class="form-check-input" type="radio" value="0" id="tax_included"
                                       name="tax_included" onchange="calculatePrice(event)"/>
                                <label class="form-check-label pe-3" for="flexCheckDefault">
                                    No
                                </label>

                                <input class="form-check-input" type="radio" value="1" id="flexCheckDefault"
                                       name="tax_included" onchange="calculatePrice(event)" checked="checked"/>
                                <label class="form-check-label pe-3" for="flexCheckDefault">
                                    Si
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div><b>Prezzo:</b> <span id="price-output" style="color: #ff0066;"></span></div>
                            <div><b>Sconto:</b> <span id="discount-output" style="color: #ff0066;"></span></div>
                            <div style="display:none;"><b>Tasse:</b> <span id="tax-output"
                                                                           style="color: #ff0066;"></span></div>
                            <hr class="my-3"/>
                            <h3><b>Prezzo Finale:</b> <span id="sale-price" style="color: #ff0066;"></span></h3>
                            <input type="hidden" value="" id="sale_price" name="sale_price">
                        </div>

                        <div class="col-md-6 mt-3 mb-5">
                            <label class="required fw-bold fs-6 mb-2">Quantità </label>
                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="12"
                                   oninput="this.value =
 !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                        </div>

                        <div class="col-md-6 mt-3 mb-5">
                            <label class="required fw-bold fs-6 mb-2">Offerta</label>

                            <div
                                class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                <input class="form-check-input h-20px w-30px" type="radio" name="promo"
                                       value="Scandenza breve">
                                <label class="form-check-label" for="flexSwitchDefault">
                                    Scandenza breve
                                </label>
                            </div>
                            <div
                                class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                <input class="form-check-input h-20px w-30px" type="radio" name="promo"
                                       value="Extra stock">
                                <label class="form-check-label" for="flexSwitchDefault">
                                    Extra stock
                                </label>
                            </div>
                            <div
                                class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                <input class="form-check-input h-20px w-30px" type="radio" name="promo"
                                       value="Promozione">
                                <label class="form-check-label" for="flexSwitchDefault">
                                    Promozione
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-5">
                            <label class=" fw-bold fs-6 mb-2">Data di scadenza</label>
                            <input class="form-control" type="date" name="expire_date"/>
                        </div>
                        <div class="col-md-6 mt-3 mb-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="fw-bold fs-6 mb-2">Intervallo di tempo da</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="time_range_from" id="timeInput" maxlength="5"
                                               pattern="(?:[01]\d|2[0-3]):[0-5]\d">
                                        <span class="input-group-text">
        <i class="fas fa-clock"></i>
    </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold fs-6 mb-2">Intervallo di tempo fino a</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="time_range_to" id="timeInput" maxlength="5"
                                               pattern="(?:[01]\d|2[0-3]):[0-5]\d">
                                        <span class="input-group-text">
        <i class="fas fa-clock"></i>
    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 my-3">
                            <label class="fw-bold fs-6 mb-2">Giornate promozionali</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input checked class="form-check-input h-20px w-30px" type="checkbox"
                                               name="promo_days[]" value="Lunedì"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Lunedì
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input checked class="form-check-input h-20px w-30px" type="checkbox"
                                               name="promo_days[]" value="Martedì"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Martedì
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input checked class="form-check-input h-20px w-30px" type="checkbox"
                                               name="promo_days[]" value="Mercoledì"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Mercoledì
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input checked class="form-check-input h-20px w-30px" type="checkbox"
                                               name="promo_days[]" value="Giovedì"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Giovedì
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input checked class="form-check-input h-20px w-30px" type="checkbox"
                                               name="promo_days[]" value="Venerdì"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Venerdì
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input checked class="form-check-input h-20px w-30px" type="checkbox"
                                               name="promo_days[]" value="Sabato"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Sabato
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                        <input checked class="form-check-input h-20px w-30px" type="checkbox"
                                               name="promo_days[]" value="Domenica"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Domenica
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="form-check-input" type="hidden" value="yes" id="flexCheckDefault"
                               name="availability"/>
                        <?php /*<hr class="my-5"/>*/ ?>
                        {{--														<div class="col-md-12 my-3" style="display:none; visibility: hidden;">
                                                                                    <label class="required fw-bold fs-6 mb-2">Disponibilità</label>
                                                                                </div>
                                                                                <div class="col-md-6 my-3" style="display:none; visibility: hidden;">
                                                                                    <div class="form-check form-check-danger form-check-solid form-check-custom">
                                                                                        <input class="form-check-input" type="radio" value="yes" id="flexCheckDefault" name="availability" checked="true" />
                                                                                        <label class="form-check-label" for="flexCheckDefault">
                                                                                            In stock
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 my-3" style="display:none; visibility: hidden;">
                                                                                <div class="form-check form-check-danger form-check-solid form-check-custom">
                                                                                        <input class="form-check-input" type="radio" value="no" id="flexCheckDefault" name="availability"/>
                                                                                        <label class="form-check-label" for="flexCheckDefault">
                                                                                            Non disponibile
                                                                                        </label>
                                                                                    </div>
                                                                                </div>--}}
                        <hr class="my-5"/>
                        <div class="col-md-6 my-3">
                            <label class="form-label">Durata offerta</label>
                            <div class="mb-0">
                                <input class="form-control " name="date_range" placeholder="Seleziona un intervallo di tempo"
                                       id="kt_daterangepicker_1"/>
                            </div>
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Visibilità Prodotto </label>
                            <select class="form-select" name="menu_status" id="status">
                                <option value="1" selected>Pubblicato</option>
                                <option value="0">Non Pubblicato</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Chiudi
                        </button>
                        <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Cancella</button>
                        <button type="submit" class="btn btn-primary rounded-0" id="itemResume-btn">
                            Salva e riprendi
                            <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                        <button type="submit" class="btn btn-dark rounded-0" id="itemSave-btn">
                            Salva
                            <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<!-- Modal end -->

<!-- addCuisineModal -->
<div class="modal fade" id="addCuisineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Aggiungi SottoCategoria Prodotto / Cucina
                    Tipica</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="addCuisineForm">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">SottoCategoria Prodotto / Cucina Tipica</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="1" selected>Pubblicata</option>
                                <option value="0">Non Pubblicata</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary rounded-0" id="cuisineResume-btn">
                        Salva e riprendi
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    <button type="submit" class="btn btn-dark rounded-0" id="cuisineSave-btn">
                        Salva
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- addCuisineModal end-->
<!-- addMenuModal -->
<div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Aggiungi Basket Offerta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="addMenuForm">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Nome Basket Offerta</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Aggiungi Nome Basket Offerta">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Stato</label>
                            <select class="form-select" name="status" id="status">
                                <option value="1" selected>Pubblicato</option>
                                <option value="0">None Publicato</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary rounded-0" id="menuResume-btn">
                        Salva e riprendi
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    <button type="submit" class="btn btn-dark rounded-0" id="menuSave-btn">
                        Salva
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- addMenuModal end-->
<!-- addSpecialTaxModal -->
<div class="modal fade" id="addSpecialTaxModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Aggiungi Impotsa Special</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="addSpecialTaxForm">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Nome Tassa</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Enter Tax Title">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Valore Tassa(%)</label>
                            <input type="text" class="form-control" name="value" id="value"
                                   placeholder="Enter Tax Value">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Stato</label>
                            <select class="form-select" name="status" id="status">
                                <option value="1" selected>Publish</option>
                                <option value="0">UnPublish</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary rounded-0" id="specialTaxResume-btn">
                        Salva e riprendi
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    <button type="submit" class="btn btn-dark rounded-0" id="specialTaxSave-btn">
                        Salva
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- addSpecialTaxModal end-->

<!--vendorPaymentPasswordValidation start-->
<!-- Modal -->
<div class="modal fade" id="vendorStripeValidation" tabindex="-1" aria-labelledby="vendorStripeValidation"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#ffbf00;">
                <h5 class="modal-title" id="exampleModalLabel">Collega il tuo Account al sistema di pagamento
                    Stripe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="vendorPaymentPasswordValidation(); return false;">
                    @csrf
                    <div class="mb-3">
                        <label for="code" class="form-label">Inserisci Password Finanziaria</label>
                        <input type="password" class="form-control" id="code" name="code" required>
                    </div>
                    <p id="code-error" style="display:none;" class="text-danger">Inserisci una chiave di accesso
                        Supervisore valida!</p>
                    <div class="form-check form-check-danger form-check-solid">
                        <input class="form-check-input " type="checkbox" value="yes" id="stripecheckbox" required>
                        <label class="form-check-label" for="stripecheckbox">
                            Convalidando ti connetti alla pagina di Stripe dove puoi leggere i termini e le condizioni
                            prima di accettare.
                        </label>
                    </div>
                    <button type="button" class="btn btn-secondary py-2 px-2" data-bs-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-dark ms-2 py-2 px-2">Convalida</button>
                </form>
            </div>

        </div>
    </div>
</div>


<!--vendorPaymentPasswordValidation end-->


<!-- Alert please edit first modal start-->
<!-- Modal -->
<div class="modal fade" id="pleaseEditFirst" tabindex="-1" aria-labelledby="pleaseEditFirst" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="pleaseEditFirst">Alert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Per favore salva o cancella il prodotto!</p>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Alert please edit first modal end-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/js/custom/documentation/documentation.js')}}"></script>
<script src="{{ asset('assets/js/custom/documentation/search.js')}}"></script>
<script src="{{ asset('assets/js/custom/documentation/forms/nouislider.js')}}"></script>

<script src="{{ asset('assets/js/custom/documentation/forms/formvalidation/advanced.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script src="{{ asset('assets/js/custom/documentation/general/datatables/advanced.js') }}"></script>

<link
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
    rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

@stack("vendor-scripts")
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
    let cuisineId = null;
    let isChecked = false;

    //preview image
    var previewContainer = $("#preview-img")
    var loadFile = function (event) {
        previewContainer.removeClass("d-none")
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    $(".radio-btn").click(function (e) {
        if (!cuisineId) {
            cuisineId = e.target.value;
            isChecked = true;
        } else {
            if (cuisineId === e.target.value && isChecked) {
                e.target.checked = false;
                isChecked = false;
            } else {
                cuisineId = e.target.value;
                isChecked = true;
            }
        }
    });

    $("#remove-preview").click(function () {
        previewContainer.addClass("d-none")
        $('#image').val("");
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    function isNumberKey(txt, evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === -1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
        }
        return true;
    }

    //add cuisine
    $("#cuisineSave-btn").on('click', function (e) {
        e.preventDefault();
        $("#loader-save").css("display", "block")
        var form = document.querySelector('#addCuisineForm')
        $.ajax({
            type: 'POST',
            url: "{{route('cuisines.store')}}",
            data: new FormData(form),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        text: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#loader-save").css("display", "none")
    });
    $("#cuisineResume-btn").on('click', function (e) {

        e.preventDefault();
        $("#loader-save").css("display", "block")
        var form = document.querySelector('#addCuisineForm')
        $.ajax({
            type: 'POST',
            url: "{{route('cuisines.store')}}",
            data: new FormData(form),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        text: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    })
                    form.reset();

                } else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#loader-save").css("display", "none")
    });

    //add cuisine end
    //add special tax
    $("#specialTaxSave-btn").on('click', function (e) {
        e.preventDefault();
        $("#loader-save").css("display", "block")
        var form = document.querySelector('#addSpecialTaxForm')
        $.ajax({
            type: 'POST',
            url: "{{route('special-taxes.store')}}",
            data: new FormData(form),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        text: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#loader-save").css("display", "none")
    });
    $("#specialTaxResume-btn").on('click', function (e) {

        e.preventDefault();
        $("#loader-save").css("display", "block")
        var form = document.querySelector('#addSpecialTaxForm')
        $.ajax({
            type: 'POST',
            url: "{{route('special-taxes.store')}}",
            data: new FormData(form),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        text: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    })
                    form.reset();

                } else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#loader-save").css("display", "none")
    });
    //add special tax end
    //add menu
    $("#menuSave-btn").on('click', function (e) {
        e.preventDefault();
        $("#loader-save").css("display", "block")
        var form = document.querySelector('#addMenuForm')
        $.ajax({
            type: 'POST',
            url: "{{route('menus.store')}}",
            data: new FormData(form),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        text: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#loader-save").css("display", "none")
    });
    $("#menuResume-btn").on('click', function (e) {

        e.preventDefault();
        $("#loader-save").css("display", "block")
        var form = document.querySelector('#addMenuForm')
        $.ajax({
            type: 'POST',
            url: "{{route('menus.store')}}",
            data: new FormData(form),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        text: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    })
                    form.reset();

                } else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#loader-save").css("display", "none")
    });
    //add menu end
    //add item
    $("#itemSave-btn").on('click', function (e) {

        e.preventDefault();
        $("#loader-save").css("display", "block")
        var form = document.querySelector('#addItemForm')
        $.ajax({
            type: 'POST',
            url: "{{route('items.store')}}",
            data: new FormData(form),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        text: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#loader-save").css("display", "none")
    });
    $("#itemResume-btn").on('click', function (e) {

        e.preventDefault();
        $("#loader-save").css("display", "block")
        var form = document.querySelector('#addItemForm')
        $.ajax({
            type: 'POST',
            url: "{{route('items.store')}}",
            data: new FormData(form),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        text: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    })
                    form.reset();

                } else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#loader-save").css("display", "none")
    });

    //add item end
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function (key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }


    $(document).ready(function () {
        $("#kt_daterangepicker_1").daterangepicker({
            "drops": "up"
        });

        $('[name="time_range_from"]').datetimepicker({
            format: 'HH:mm',
            icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right'
            },
        })

        $('[name="time_range_to"]').datetimepicker({
            format: 'HH:mm',
            icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right'
            }
        })
    });

    //calculate sale price
    function calculatePrice(event) {
        price = $('#addItemForm #price').val();
        discount = $('#addItemForm #discount').val();
        tax = $('#addItemForm #tax').val();

        outputSalePrice = $('#addItemForm #sale-price');
        outputPrice = $('#addItemForm #price-output');
        outputDiscount = $('#addItemForm #discount-output');
        outputTax = $('#addItemForm #tax-output');
        var salePrice = 0;
        totalPrice = price - percentage(discount, price);
        //salePrice=totalPrice+Number(percentage(tax, totalPrice))
        salePrice = totalPrice;
        outputPrice.html("€ " + price)
        outputDiscount.html(discount + "%")
        outputTax.html(tax + "%")
        outputSalePrice.html("€ " + (Math.round(salePrice * 100) / 100).toFixed(2));
        $('#addItemForm #sale_price').val(salePrice);

    }

    function percentage(percent, total) {
        return ((percent / 100) * total).toFixed(2)
    }

    //calculate sale price end
    var budgetSlider = document.querySelector("#kt_modal_create_campaign_budget_slider");
    var budgetValue = document.querySelector("#kt_modal_create_campaign_budget_label");

    noUiSlider.create(budgetSlider, {
        start: [{{ (\Request::route()->getName() == 'items.edit') ? $data->price : 5 }}],
        connect: true,
        range: {
            "min": 0,
            "max": 500
        }
    });
    var priceInput = document.getElementById('price-input');
    budgetSlider.noUiSlider.on("update", function (values, handle) {
        // console.log(values[handle])
        budgetValue.innerHTML = values[handle];
        priceInput.value = values[handle];
        document.getElementById("price").value = values[handle];
        calculatePrice();
        if ("{{\Request::route()->getName()}}" == "items.edit") {
            calculateEditPrice();
        }

        if (handle) {
            priceInput.value = values[handle];
            budgetValue.innerHTML = values[handle];
        }
    });
    priceInput.addEventListener('change', function () {
        budgetSlider.noUiSlider.set([this.value]);
    });

    $('input[type=radio][name=tax_type]').change(function () {
        if (this.value == 'local') {
            $('#special-tax-box').hide();
            $('#local-tax-box').show();
            var taxValue = document.getElementById("local-tax").value;
            document.getElementById("tax").value = taxValue;
        } else if (this.value == 'special') {
            $('#special-tax-box').show();
            $('#local-tax-box').hide();
            var taxValue = document.getElementById("special-tax").value;
            document.getElementById("tax").value = taxValue;
        }
        calculatePrice()
        if ("{{\Request::route()->getName()}}" == "items.edit") {
            calculateEditPrice();
        }
    });

    function changeTax(value) {
        document.getElementById("tax").value = value;
        calculatePrice()
        if ("{{\Request::route()->getName()}}" == "items.edit") {
            calculateEditPrice();
        }
    }
</script>

<script>
    @if(Session::has('message'))
    Swal.fire({
        text: "{{ Session::get('message') }}",
        icon: "{{ Session::get('alert-type') }}",
        buttonsStyling: false,
        confirmButtonText: "Ok, ricevuto!",
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
    @endif
</script>

<script>
    function VendorFetchOrders() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        let config = {
            withFilledItems : true
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('vendor.fetch.orders') }}",
            data: JSON.stringify(config),
            contentType: 'application/json; charset=utf-8',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            success: function (response) {

                if (response.tempOrders?.length > 0 || response.items?.length > 0 ) {
                    $('#have-order').show();
                    $('#no-order-yet').hide();
                } else {
                    $('#no-order-yet').show();
                    $('#have-order').hide();
                }
                html = "";
                $.each(response.items, function (index, value) {
                    html += `
                            <div class="d-flex justify-content-start mb-10  p-7 shadow mt-2 ms-2 fw-bolder">
                                ZeepUp: dati CO2 e H2O aggiornati per prodotto "`+ value.name +`"
                            </div>`;
                });
                $.each(response.tempOrders, function (index, value) {

                    html += `<div class="d-flex justify-content-start mb-10  p-2 shadow mt-2 ms-2" id="order-` + value.id + `">
							<!--begin::Wrapper-->
							<div class=" w-100">
									<div class="row">
										<div class="col-md-12">

								<div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
								<input class="form-check-input h-20px w-30px" onchange="ordercollected(` + value.id + `)"  type="checkbox" value="1"  name="collectionfilter` + value.id + `" ` + ((value.collected == 'yes') ? 'checked disabled' : '') + `>
									<label class="form-check-label" for="flexSwitchDefault">Collected</label>
						</div>

										</div>
										<div class="col-md-4">
											<h6 class="text-uppercase">ordine numero</h6>
											<p>` + value.order_number + `</p>
										</div>
										<div class="col-md-4">
											<h6 class="text-uppercase">Data ordine</h6>
											<p>` + value.transactiontime + `</p>

										</div>
										<div class="col-md-4">
											<h6 class="text-uppercase">Totale</h6>
											<p>&euro;` + (value.total ? Number(value.total).toLocaleString('it-IT', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) : '0.00') + `</p>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<h6 class="text-uppercase">ordine eseguito</h6>
											<p>
							<span class="text-muted fs-7 mb-1">` + value.order_placed + `</span></p>
										</div>
										<div class="col-md-4">
											<h6 class="text-uppercase">Ritirato</h6>
											<p>` + value.collected + `</p>
										</div>
										<div class="col-md-4 ` + ((value.collected == 'yes') ? '' : 'd-none') + `">
											<h6 class="text-uppercase">Data di ritiro</h6>
											<p class="mb-0 pb-0">` + value.collectiontime + `</p>
											<span class="text-muted fs-7 m-0 p-0">` + value.collectiontime_diff + `</span></p>
										</div>
										<div class="col-md-4">
											<h6 class="text-uppercase">Ora di ritiro</h6>
											<p class="mb-0 pb-0">` + value.delivery_date + `
											<span class="text-muted fs-7 m-0 p-0">` + value.delivery_time + `</span></p>
										</div>

									</div>
								<!--end::User-->
								<!--begin::Text-->
							<div class="p-3 pt-5 pb-1 rounded bg-dark text-light" data-kt-element="message-text">
								<div class="row">
										<div class="col-md-6">
											<h6 class="text-uppercase text-light">nome</h6>
											<p>` + value.name + `</p>
										</div>
										<div class="col-md-6">
											<h6 class="text-uppercase text-light">telefono</h6>
											<p>` + value.phone + `</p>
										</div>
									</div>
								</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>`;
                });
                $('#vendor-orders-main').empty('').append(html);
            }
        });
    }

    VendorFetchOrders();


    function newOrdersCounter() {
        var count = 0
        var ajax1 = $.ajax({
            type: 'get',
            url: "{{ route('vendor.fetch.new.orders.counter') }}",
            success: function (response) {
                count += parseInt(response);
            }
        });

        var ajax2 = $.ajax({
            type: 'get',
            url: "{{ route('vendor.filled.items.counter') }}",
            success: function (response) {
                count += parseInt(response);
            }
        });

        $.when(ajax1, ajax2).done(function() {
            if(count > 0) {
                VendorFetchOrders();
            }
            $('#new-order-counter').html(count);
        });
        setTimeout(function () {
            newOrdersCounter()
        }, 5000);
    }

    newOrdersCounter();

    function newOrdersCounterMarkRead() {
        $.ajax({
            type: 'get',
            url: "{{ route('vendor.new.orders.counter.mark.read') }}",
            success: function (response) {
            }
        })
        $.ajax({
            type: 'post',
            url: "{{ route('vendor.filled.items.counter.mark.read') }}",
            success: function (response) {
            }
        });
        VendorFetchOrders()
    }


    function ordercollected(id) {
        $.ajax({
            type: 'get',
            //url: "{{ route('mark.order.collected', ['id' => "+id+"]) }}",
            url: "{{ url('/').'/dashboard/mark/order/collected/' }}" + id,
            success: function (data) {
                VendorFetchOrders()
            }
        });
    }


    $(document).ready(function (e) {
        $(".confirmDeleteAnchor").click(function (e) {
            var tempURL = $(this).attr('href');
            e.preventDefault()
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Sei sicuro di voler cancellare?',
                showCancelButton: true,
                confirmButtonText: 'Cancella',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = tempURL;
                }

            })
        })
    });

    function vendorPaymentPasswordValidation() {
        var code = $("#code").val();
        if (code == '') {
            $('#code-error').show();
            return false;
        }
        $('#code-error').hide();
        $.ajax({
            type: 'get',
            url: "{{ url('/').'/dashboard/vendorstripe/validation/' }}" + code,
            success: function (data) {
                if (data == '1') {
                    $('#code-error').hide();
                    window.location.href = "{{route('vendorstripe.index')}}";
                } else {
                    $('#code-error').show();
                }
            }
        });
    }


</script>

</body>
<!--end::Body-->
</html>
