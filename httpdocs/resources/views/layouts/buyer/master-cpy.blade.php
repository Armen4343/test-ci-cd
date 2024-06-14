<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>ZeepUp</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
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
					<div class="kt_header-ribbon">
						 <!--begin::Name-->
						 <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-4 pe-5 ">
                        <span class="text-light fs-8 fw-bold lh-1 mb-1">{{ Auth::user()->role}}</span>
                        <span class="text-light fs-8 fw-bolder lh-1">{{ Auth::user()->name}}</span>
                    </div>
                    <!--end::Name-->
					</div>
					<!--end::Header-->
					<!--begin::Content wrapper-->
					<div class="h-100">
						<!--begin::Aside-->
						<div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
							<!--begin::Aside menu-->
							@include('layouts.vendor.sidebar')
							<!--end::Aside menu-->
						
						</div>
						<!--end::Aside-->
						<!--begin::Container-->
						<div class="d-flex flex-column flex-column-fluid main">
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
		
<div class="modal fade" tabindex="-1" id="add-menu-modal">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Item Manager</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
									<ul class="nav nav-tabs nav-pills nav-justified flex-row border-0  me-5 mb-3 mb-md-0 fs-6">
										<li class="nav-item me-0 mb-md-2">
												<a class="nav-link active btn btn-flex btn-active-light-success" data-bs-toggle="tab" href="#kt_tab_pane_4">
														<span class="svg-icon svg-icon-2"><svg>...</svg></span>
														<span class="d-flex flex-column align-items-start">
																<span class="fs-4 fw-bolder">Add New Item</span>
														</span>
												</a>
										</li>
										<li class="nav-item me-0 mb-md-2">
												<a class="nav-link btn btn-flex btn-active-light-info" data-bs-toggle="tab" href="#kt_tab_pane_5">
														<span class="svg-icon svg-icon-2"><svg>...</svg></span>
														<span class="d-flex flex-column align-items-start">
																<span class="fs-4 fw-bolder">Edit Exiting Item</span>
														</span>
												</a>
										</li>
								</ul>

								@php
								$Categories = \App\Models\Category::where(['status' => '1'])->get(); 
								$dish_catgories = \App\Models\DishCategory::where(['status' => '1'])->get(); 
								$dishes = \App\Models\Dish::where(['status' => '1'])->get(); 
								
								@endphp
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="kt_tab_pane_4" role="tabpanel">
											<form action="#" method="post" enctype="multipart/form-data" id="addCategoryForm">
													
													<div class="alert alert-danger print-error-msg" style="display:none">
																		<ul></ul>
													</div>
													<div class="row">
														<div class="col-md-6 my-3">
															<label class="required fw-bold fs-6 mb-2">Select Category</label>
															@foreach($Categories as $Category)
																	<div class="form-check form-check-custom mb-2">
																	<input class="form-check-input" type="radio" value="" id="flexRadioDefault" name="category"/>
																	<label class="form-check-label" for="flexRadioDefault">
																		{{ $Category->title }}
																	</label>
																</div>
																@endforeach
														</div>
														
														<div class="col-md-6 my-3">
															<label class="required fw-bold fs-6 mb-2">Select Cuisine Type</label>
																												
															
																@foreach($dish_catgories as $dish_catgory)

																<div class="form-check form-check-custom mb-2">
																	<input class="form-check-input" type="radio" value="" id="flexRadioDefault" name="cuisine-type"/>
																	<label class="form-check-label" for="flexRadioDefault">
																		{{ $dish_catgory->title }}
																	</label>
																</div>
																		
																
																@endforeach
														</div>
														<div class="col-md-6 my-3">
																														<!--begin::Input group-->
																<div class="fv-row">
																		<!--begin::Label-->
																		<label class="required fw-bold fs-6 mb-2">Description</label>
																		<!--end::Label-->

																		<!--begin::Input-->
																		<textarea name="textarea_input" class="form-control "></textarea>
																		<!--end::Input-->
																</div>
																<!--end::Input group-->
														</div>
														<div class="col-md-6 my-3">
															<label class="fw-bold fs-6 mb-2">Menu Image(500*500)</label>
															<input type="file" class="form-control" name="image" id="image">
														</div>
														<div class="col-md-6 my-3">
															<label class="fw-bold fs-6 mb-2">Alergen Info</label>
															<div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
																<input class="form-check-input h-20px w-30px" type="checkbox" value="" id="flexSwitchDefault" checked="checked" />
																<label class="form-check-label" for="flexSwitchDefault">
																	Contains Dairy Products
																</label>
															</div>
															<div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
																<input class="form-check-input h-20px w-30px" type="checkbox" value="" id="flexSwitchDefault"/>
																<label class="form-check-label" for="flexSwitchDefault">
																	Contains Nut
																</label>
															</div>
															<div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
																<input class="form-check-input h-20px w-30px" type="checkbox" value="" id="flexSwitchDefault"checked="checked" />
																<label class="form-check-label" for="flexSwitchDefault">
																	Contains Eggs
																</label>
															</div>
														</div>
														<div class="col-md-6 my-3">
															<label class="required fw-bold fs-6 mb-2">Menu Status</label>
															<select class="form-select" name="status" id="status">
																<option value="1" selected>Publish</option>
																<option value="0">UnPublish</option>
															</select>
														</div>
														<div class="col-md-6 mt-3 mb-5">
															<label class="fw-bold fs-6 mb-2">Discount (%)</label>
															<input type="number" class="form-control" name="quantity" id="quantity">
														</div>
														<!--begin::Input wrapper-->
														<div class="col-md-12 my-3">
																			<!--begin::Input wrapper-->
																	
																			<!--begin::Label-->
																			<label class="fs-6 fw-bold mb-2">
																					Price
																					<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Choose the budget allocated for each day. Higher budget will generate better results"></i>
																			</label>
																			<!--end::Label-->

																			<!--begin::Slider-->
																			<div class="d-flex flex-column text-center">
																					<div class="d-flex align-items-start justify-content-center mb-7" style="color: #ff0066;">
																							<span class="fw-bolder fs-4 mt-1 me-2">$</span>
																							<span class="fw-bolder fs-3x" id="kt_modal_create_campaign_budget_label"></span>
																							<span class="fw-bolder fs-3x">.00</span>
																					</div>
																					<div id="kt_modal_create_campaign_budget_slider" class="noUi-sm"></div>
																			</div>
																			<!--end::Slider-->
																	
																	<!--end::Input wrapper-->
												
														</div>
														<!--end::Input wrapper-->
														<div class="col-md-6 my-3">
																<label class="form-label">Date Range</label>
																<input class="form-control form-control-solid" name="date" required="required" placeholder="Pick date rage" id="kt_daterangepicker_1"/>
														</div>
													
													
													<div class="col-md-6 mt-3 mb-5">
															<label class="fw-bold fs-6 mb-2">Quantity</label>
															<input type="number" class="form-control" name="quantity" id="quantity">
														</div>
														<div class="col-md-6 mt-3 mb-5">
															<label class="required fw-bold fs-6 mb-2">Taxes Bracket</label>
															<select class="form-select" name="status" id="status">
																<option value="1" selected>25%</option>
																<option value="0">100%</option>
															</select>
														</div>
														<hr class="my-5"/>
														<div class="col-md-12 my-3">
															<label class="required fw-bold fs-6 mb-2">Inventory</label>
														</div>
														<div class="col-md-6 my-3">
															<div class="form-check form-check-custom">
																<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
																<label class="form-check-label" for="flexCheckDefault">
																	In Stock
																</label>
															</div>
														</div>
														<div class="col-md-6 my-3">
														<div class="form-check form-check-custom">
																<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
																<label class="form-check-label" for="flexCheckDefault">
																	Not Available
																</label>
															</div>
														</div>
														
													</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
															<button type="button" class="btn btn-dark rounded-0" id="addCategory-btn">
																Save
																<div class="spinner-border" role="status" id="loader-save" style="display:none;">
																	<span class="visually-hidden">Loading...</span>
																</div> 
															</button>
														</div>
										</form>
									</div>
									<div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
											<!-- Mutliple form -->
											<form action="#" method="post" enctype="multipart/form-data" id="addCategoryForm">
													
													<div class="alert alert-danger print-error-msg" style="display:none">
																		<ul></ul>
													</div>
													<div class="row">
														<div class="col-md-6 my-3">
															<label class="required fw-bold fs-6 mb-2">Select Category</label>
																												
																	
															<select class="form-select"  name="category"  data-placeholder="Select an option">
																@foreach($Categories as $Category)

																<option value="{{ $Category->title }}" >
																		{{ $Category->title }}
																
																@endforeach
															</select>
														</div>
														
														<div class="col-md-6 my-3">
															<label class="required fw-bold fs-6 mb-2">Select Dish Category</label>
																												
																	
															<select class="form-select"  name="dish_category"  data-placeholder="Select an option">
																@foreach($dish_catgories as $dish_catgory)

																<option value="{{ $dish_catgory->title }}" >
																		{{ $dish_catgory->title }}
																
																@endforeach
															</select>
														</div>
														<div class="col-md-6 my-3">
															<label class="required fw-bold fs-6 mb-2">Select Dish</label>
																												
																	
															<select class="form-select"  name="dish_category"  data-placeholder="Select an option">
																@foreach($dishes as $dish)

																<option value="{{ $dish_catgory->name }}" >
																		{{ $dish->name }}
																
																@endforeach
															</select>
														</div>
														<div class="col-md-6 my-3">
															<label class="fw-bold fs-6 mb-2">Menu Image(500*500)</label>
															<input type="file" class="form-control" name="image" id="image">
														</div>
														<div class="col-md-6 my-3">
															<label class="required fw-bold fs-6 mb-2">Menu Status</label>
															<select class="form-select" name="status" id="status">
																<option value="1" selected>Publish</option>
																<option value="0">UnPublish</option>
															</select>
														</div>
														<div class="col-md-6 my-3">
																<label class="form-label">Date Range</label>
																<input class="form-control form-control-solid" name="date" required="required" placeholder="Pick date rage" id="kt_daterangepicker_1"/>
														</div>
													</div>
													<!--begin::Input wrapper-->
														<div class="col-md-12 my-3">
																			<!--begin::Input wrapper-->
																	
																			<!--begin::Label-->
																			<label class="fs-6 fw-bold mb-2">
																					Price
																					<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Choose the budget allocated for each day. Higher budget will generate better results"></i>
																			</label>
																			<!--end::Label-->

																			<!--begin::Slider-->
																			<div class="d-flex flex-column text-center">
																					<div class="d-flex align-items-start justify-content-center mb-7" style="color: #ff0066;">
																							<span class="fw-bolder fs-4 mt-1 me-2">$</span>
																							<span class="fw-bolder fs-3x" id="kt_modal_create_campaign_budget_label"></span>
																							<span class="fw-bolder fs-3x">.00</span>
																					</div>
																					<div id="kt_modal_create_campaign_budget_slider" class="noUi-sm"></div>
																			</div>
																			<!--end::Slider-->
																	
																	<!--end::Input wrapper-->
												
														</div>
														<!--end::Input wrapper-->
												
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
															<button type="button" class="btn btn-dark rounded-0" id="addCategory-btn">
																Save
																<div class="spinner-border" role="status" id="loader-save" style="display:none;">
																	<span class="visually-hidden">Loading...</span>
																</div> 
															</button>
														</div>
										</form>
											<!-- Mutliple form -->
									</div>
							</div>
            </div>

        </div>
    </div>
</div>
		<!-- Modal end -->


		
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<!-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script> -->
		<!--end::Global Javascript Bundle-->
		
		<!--begin::Page Vendors Javascript(used by this page)-->
		<!-- <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script> -->
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<!-- <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> -->
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<!-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
		<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
		<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
		<script src="{{ asset('assets/js/custom/utilities/modals/create-campaign.js') }}"></script>
		<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
		<script src="{{ asset('assets/js/custom/documentation/base/forms/advanced.js') }}"></script> -->

		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->


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
<script>
	$(document).ready(function(){
		$("#kt_daterangepicker_1").daterangepicker();
});

var budgetSlider = document.querySelector("#kt_modal_create_campaign_budget_slider");
var budgetValue = document.querySelector("#kt_modal_create_campaign_budget_label");

noUiSlider.create(budgetSlider, {
    start: [5],
    connect: true,
    range: {
        "min": 1,
        "max": 1000
    }
});

budgetSlider.noUiSlider.on("update", function (values, handle) {
    budgetValue.innerHTML = Math.round(values[handle]);
    if (handle) {
        budgetValue.innerHTML = Math.round(values[handle]);
    }
});



</script>
	</body>
	<!--end::Body-->
</html>