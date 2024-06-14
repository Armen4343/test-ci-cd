<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>ZeepUp</title>
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />

		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />

	<link rel="icon" href="https://it.zeepup.com/front-end/images/favicon.png" type="image/png" sizes="64x64">
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('front-end/dashboard.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<style>
	.main-pink-color{color: #ff0066;!important}

	.notification{
	right: 28px !important;
    top: 8px !important;
    width: 23px !important;
    height: 18px !important;
    font-size: 10px !important;
    border-radius: 10px !important;
    background: #ff0066 !important;
	}
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
					@include('layouts.buyer.header')
					<div class="kt_header-ribbon" style="z-index:10;">
						 <!--begin::Name-->

										<div class="d-flex justify-content-between">


											<div>
												<p class="text-light mx-5 mt-1 float-end text-capitalize">{{ Auth::user()->name}}</p>
											</div>
										</div>
                    <!--end::Name-->
					</div>
					<!--end::Header-->
					<!--begin::Content wrapper-->
					<div class="h-100">
						<!--begin::Aside-->
						<div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
							<!--begin::Aside menu-->
							@include('layouts.buyer.sidebar')
							<!--end::Aside menu-->

						</div>
						<!--end::Aside-->
						<!--begin::Container-->
						<div class="d-flex flex-column flex-column-fluid main">
							<!--begin::Post-->
							<div class="content flex-column-fluid card" id="kt_content">
								@yield('buyer')
							</div>
							<!--end::Post-->
							<!--begin::Footer-->

							@include('layouts.buyer.footer')
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

        @yield('customjs')
			<script>
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

		<script>
	function showOrdersSelectList(){
		$("#orders-select-list-tag").prop('required',true);
		$("#restaurant-select-list-tag").prop('required',false);
	document.getElementById("restaurant-select-list").style.display = "none";  //hide
	document.getElementById("orders-select-list").style.display = "block"; //show
	}
	function showRestaurantSelectList(){
		$("#orders-select-list-tag").prop('required',false);
		$("#restaurant-select-list-tag").prop('required',true);
	document.getElementById("orders-select-list").style.display = "none"; //show
	document.getElementById("restaurant-select-list").style.display = "block";  //hide
	}
	function hideBothSelectList(){

	$("#orders-select-list-tag").prop('required',false);
	$("#restaurant-select-list-tag").prop('required',false);
	document.getElementById("orders-select-list").style.display = "none"; //show
	document.getElementById("restaurant-select-list").style.display = "none";  //hide
	}
	function hideBothSelectList(){
	setSelectedOption('');
	$("#orders-select-list-tag").prop('required',false);
	$("#restaurant-select-list-tag").prop('required',false);
	document.getElementById("orders-select-list").style.display = "none"; //show
	document.getElementById("restaurant-select-list").style.display = "none";  //hide
	}
	function setSelectedOption(v){
		$("#selectedoption").val(v);
	}


			 @php
			$buyerOrder = App\Models\orders::
			where('userid','=',Auth::user()->id)
				->where('status','=','paid')
					->where('collected', '=', 'yes')
					->where('seen_by_buyer', '=', 1)
					->count();
			@endphp
			@if($buyerOrder > 0)
         function buyerFetchOrders() {
            $.ajax({
				 headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
               type:'POST',
               url:"{{ route('buyer.fetch.orders') }}",
               success:function(response){
				   console.log(response)

				   if(response.length > 0){
					  $('#have-order').show();
					   $('#no-order-yet').hide();
				   }
				   else{
						 $('#no-order-yet').show();
					     $('#have-order').hide();
				   }
					html = "";
				   $.each(response, function( index, value ) {
				  html += `<div class="d-flex justify-content-start mb-10  p-2 shadow mt-2 ms-2" id="order-`+value.id+`">
							<!--begin::Wrapper-->
							<div class=" w-100">
									<div class="row">

										<div class="col-md-4">
											<h6 class="text-uppercase">N Ordini</h6>
											<p>`+value.order_number+`</p>
										</div>
										<div class="col-md-4">
											<h6 class="text-uppercase">Data di Ordini</h6>
											<p>`+value.transactiontime+`</p>

										</div>
										<div class="col-md-4">
											<h6 class="text-uppercase">Totale</h6>
											<p>&dollar;`+value.total+`</p>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<h6 class="text-uppercase">order placed</h6>
											<p>
							<span class="text-muted fs-7 mb-1">`+value.order_placed+`</span></p>
										</div>
										<div class="col-md-4">
											<h6 class="text-uppercase">Collected</h6>
											<p>`+value.collected+`</p>
										</div>
										<div class="col-md-4 `+ ((value.collected == 'yes') ? '' : 'd-none') +`">
											<h6 class="text-uppercase">Collection time</h6>
											<p class="mb-0 pb-0">`+value.collectiontime+`</p>
											<span class="text-muted fs-7 m-0 p-0">`+value.collectiontime_diff+`</span></p>
										</div>

									</div>
								<!--end::User-->
								<!--begin::Text-->
							<div class="p-3 pt-5 pb-1 rounded bg-dark text-light" data-kt-element="message-text">
									<div class="row">
										<div class="col-md-6">
											<h6 class="text-uppercase text-light">name</h6>
											<p>`+value.name+`</p>
										</div>
										<div class="col-md-6">
											<h6 class="text-uppercase text-light">phone number</h6>
											<p>`+value.phone+`</p>
										</div>
									</div>

								</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>`;
				  });
					$('#buyer-orders-main').empty('').append(html);
				}
            });
         }
			 buyerFetchOrders();


			  function collectedOrdersCounter() {
            $.ajax({
               type:'get',
               url:"{{ route('buyer.fetch.orders.collected') }}",
               success:function(response){
				   console.log(response)
				   $('#new-order-counter').html(response)
				   if(response > 0){
					   buyerFetchOrders();

				   }
				   else{
				   }
				}
            });
				   setTimeout(function(){
					   //Your Code
					   collectedOrdersCounter()
				   }, 5000);
         }
			 collectedOrdersCounter();


			  function collectedOrdersCounterMarkRead() {
            $.ajax({
               type:'get',
               url:"{{ route('buyer.orders.counter.mark.read') }}",
               success:function(response){
				   $('#new-order-counter').html('0')
				}
            });
				    buyerFetchOrders()
         }
			@endif
		</script>


	</body>
	<!--end::Body-->
</html>
