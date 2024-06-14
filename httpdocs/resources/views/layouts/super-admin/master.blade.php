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

    <link rel="icon" href="https://it.zeepup.com/front-end/images/favicon.png" type="image/png" sizes="64x64">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
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
    <!--end::Global Stylesheets Bundle-->


</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed">
<!-- addCategoryModal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="addCategoryForm">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Category Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Enter Category Title">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Category Image(500*500)</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="fw-bold fs-6 mb-2">Category Short Description</label>
                            <textarea class="form-control" placeholder="Enter Category Short Description"
                                      name="short_description" id="floatingTextarea"></textarea>
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Category Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="1" selected>Publish</option>
                                <option value="0">UnPublish</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addCategory-btn">
                        Save
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- addCategoryModal end -->
<!-- addTaxModal -->
<div class="modal fade" id="addTaxModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sales Tax</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="addTaxForm">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">State Name</label>
                            <input type="text" class="form-control" name="state" id="state"
                                   placeholder="Enter State Name">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="required fw-bold fs-6 mb-2">Enter Tax </label>
                            <input type="text" class="form-control" name="tax" id="tax" placeholder="Enter Tax Value"
                                   oninput="this.value =
 !!this.value && Math.abs(this.value) >= 0 && Math.abs(this.value) <= 99 ? Math.abs(this.value) : null">
                        </div>
                        <div class="col-md-6 my-3">
                            <label class="fw-bold fs-6 mb-2">Special Tax Value</label>
                            <input type="text" class="form-control" name="special_tax"
                                   placeholder="Enter Special Tax Value" oninput="this.value =
 !!this.value && Math.abs(this.value) >= 0 && Math.abs(this.value) <= 99 ? Math.abs(this.value) : null">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addCategory-btn">
                        Save
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- addTaxModal end -->
<!-- addSubscriptionModal -->
<div class="modal fade" id="addSubscriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subscription</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="addSubscriptionForm">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <label class="required fw-bold fs-6 mb-2">Subscription Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                           placeholder="Enter Subscription Email">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addCategory-btn">
                        Save
                        <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- addSubscriptionModal end -->
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            @include('layouts.vendor.header')
            <div class="kt_header-ribbon" style="background:#ffbf00;">
                <!--begin::Name-->

                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-6">
                        <b class="text-dark mx-5 mt-1 text-capitalize float-end">{{ Auth::user()->name}}</p>
                    </div>
                </div>
                <!--end::Name-->
            </div>
            <!--end::Header-->
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column-fluid">
                <!--begin::Aside-->
                <div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside"
                     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                     data-kt-drawer-toggle="#kt_aside_toggle">
                    <!--begin::Aside menu-->
                    @include('layouts.super-admin.sidebar')
                    <!--end::Aside menu-->

                </div>
                <!--end::Aside-->
                <!--begin::Container-->
                <div class="d-flex flex-column flex-column-fluid main w-100">
                    <!--begin::Post-->
                    <div class="content flex-column-fluid card" id="kt_content">
                        @yield('super-admin')
                    </div>
                    <!--end::Post-->
                    <!--begin::Footer-->
                    @include('layouts.super-admin.footer')
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
<!--begin::Javascript-->


<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/js/custom/documentation/documentation.js') }}"></script>
<script src="{{ asset('assets/js/custom/documentation/search.js') }}"></script>
<script src="{{ asset('assets/js/custom/documentation/editors/ckeditor/classic.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script src="{{ asset('assets/js/custom/documentation/general/datatables/advanced.js') }}"></script>
<!--end::Page Custom Javascript-->
<script src="{{ asset('assets/js/custom/documentation/forms/formvalidation/advanced.js') }}"></script>
<script src="{{ asset('assets/js/custom/documentation/forms/password-meter.js') }}"></script>

<!--template scripts-->
@stack('super-admin-scripts')
<!--template scripts end-->


<script>// Define form element
    const form = document.getElementById('super-user');

    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

    try {
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {


                    'new_password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            },
                            callback: {
                                message: 'Please enter valid password',
                                callback: function (input) {
                                    if (input.value.length > 0) {
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'confirm_password': {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation is required'
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="new_password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );
    }
    catch (e) {}


    // // Submit button handler
    const submitButton = document.getElementById('btn-submit');
    // submitButton.addEventListener('click', function (e) {
    $("#btn-submit").click(function (e) {
        // Prevent default button action
        e.preventDefault();
        var name = document.forms["super-user"]["name"].value;
        var email = document.forms["super-user"]["email"].value;

        if (document.forms['super-user']["company_name"]) {
            const companyName = document.forms["super-user"]["company_name"].value;
            const taxId = document.forms["super-user"]["tax_id"].value;
            const pec = document.forms["super-user"]["pec"].value;

            if (!companyName) {
                $('.company-name-error').show();
                return false;
            } else {
                $('.company-name-error').hide();
            }

            if (!taxId) {
                $('.tax-id-error').show();
                return false;
            } else {
                $('.tax-id-error').hide();
            }

            if (!pec || (!validateEmail(pec))) {
                $('.pec-error').show();
                return false;
            } else {
                $('.pec-error').hide();
            }
        }


        if (name == "") {
            $('.name-error').show();
            return false;
        } else {
            $('.name-error').hide();
        }

        if (email == "" || (!validateEmail(email))) {
            $('.email-error').show();
            return false;
        } else {
            $('.email-error').hide();
        }
        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                console.log('validated!');

                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    document.getElementById("super-user").submit();
                }
            });
        }
    });

    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
    }


        var budgetSlider1 = document.querySelector("#kt_modal_create_campaign_budget_slider_1");
        var budgetValue1 = document.querySelector("#kt_modal_create_campaign_budget_label_1");

        noUiSlider.create(budgetSlider1, {
            start: [{{ (\Request::route()->getName() == 'items.edit') ? $data->price : 5 }}],
            connect: true,
            range: {
                "min": 0,
                "max": 500
            }
        });
        var priceInput1 = document.getElementById('price-input_1');
        budgetSlider1.noUiSlider.on("update", function (values, handle) {
            // console.log(values[handle])
            budgetValue1.innerHTML = values[handle];
            priceInput1.value = values[handle];
            document.getElementById("price").value = values[handle];
            calculatePrice();
            if ("{{\Request::route()->getName()}}" == "items.edit") {
                calculateEditPrice();
            }

            if (handle) {
                priceInput1.value = values[handle];
                budgetValue1.innerHTML = values[handle];
            }
        });


</script>

<script>
    //calculate sale price
    function calculateEditPrice(event) {
        price = $('#editItemForm #price').val();
        discount = $('#editItemForm #discount').val();
        tax = $('#editItemForm #tax').val();

        outputSalePrice = $('#editItemForm #sale-price');
        outputPrice = $('#editItemForm #price-output');
        outputDiscount = $('#editItemForm #discount-output');
        outputTax = $('#editItemForm #tax-output');
        var salePrice = 0;
        totalPrice = price - percentage(discount, price);
        salePrice = totalPrice;
        outputPrice.html("€" + price)
        outputDiscount.html(discount + "%")
        outputTax.html(tax + "%")
        outputSalePrice.html("€" + (Math.round(salePrice * 100) / 100).toFixed(2))
        console.log("{{\Request::route()->getName()}}")

    }

    function percentage(percent, total) {
        return ((percent / 100) * total).toFixed(2)
    }

    //calculate sale price end
</script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    //add category end
    $("#addCategoryForm").on('submit', function (e) {
        e.preventDefault();
        $("#loader-save").css("display", "block")

        $.ajax({
            type: 'POST',
            url: "{{route('categories.store')}}",
            data: new FormData(this),
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
    //add category end
    //add Tax
    $("#addTaxForm").on('submit', function (e) {
        e.preventDefault();
        $("#loader-save").css("display", "block")

        $.ajax({
            type: 'POST',
            url: "{{route('taxes.store')}}",
            data: new FormData(this),
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
    //add Tax end
    //add Subscription
    $("#addSubscriptionForm").on('submit', function (e) {
        e.preventDefault();
        $("#loader-save").css("display", "block")

        $.ajax({
            type: 'POST',
            url: "{{route('subscriptions.store')}}",
            data: new FormData(this),
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

    //add Tax end
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function (key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }


    @if(Session::has('message'))
    Swal.fire({
        text: "{{ Session::get('message') }}",
        icon: "{{ Session::get('alert-type') }}",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
    @endif
</script>


</body>
<!--end::Body-->
</html>
