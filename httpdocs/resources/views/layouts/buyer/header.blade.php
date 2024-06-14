<div id="kt_header" class="header bg-white">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-stack">
        <!--begin::Brand-->
        <div class="d-flex align-items-center me-5">
            <!--begin::Aside toggle-->
            <button class="navbar-toggler nav-icon border-none d-lg-none ms-n2 me-3" id="kt_aside_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg') }}-->
               <i class="fa-solid fa-bars menu-icon"></i>
                <!--end::Svg Icon-->
            </button>
            <!--end::Aside  toggle-->
            <!--begin::Logo-->
            <a href="/dashboard">
                <img alt="Logo" src="{{ secure_asset('front-end/images/logo.png') }}"  class="h-25px h-lg-30px" />
            </a>
            <!--end::Logo-->

        </div>
        <!--end::Brand-->
        <!--begin::Topbar-->
        <div class="d-flex align-items-center flex-shrink-0">

			<div class="d-flex align-items-center ms-1" id="new_orders_toggle" onclick="collectedOrdersCounterMarkRead()">
									<!--begin::Menu wrapper-->
									<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-dark w-30px h-30px w-md-40px h-md-40px position-relative"  >
										<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
										<span class="svg-icon svg-icon-gray-800 svg-icon-2x" >
											<i class="fas fa-bell" style="font-size: 20px;"></i>

										</span>
										<!--end::Svg Icon-->

									</div>
									<!--end::Menu wrapper-->
								</div>
             <div class="d-flex align-items-center ms-1">
									<!--begin::Menu wrapper-->
									<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-danger w-30px h-30px w-md-40px h-md-40px position-relative"  data-bs-toggle="modal" data-bs-target="#ticketModel">
										<!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
										<span class="svg-icon svg-icon-gray-800 svg-icon-2x" >
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black"></path>
												<rect x="6" y="12" width="7" height="2" rx="1" fill="black"></rect>
												<rect x="6" y="7" width="12" height="2" rx="1" fill="black"></rect>
											</svg>
										</span>
										<!--end::Svg Icon-->
										<!--begin::Animation notification-->
										<span class="position-absolute translate-middle  badge badge-circle notification " id="new-order-counter">0
										</span>
										<!--begin::Animation notification-->
									</div>
									<!--end::Menu wrapper-->
								</div>
            <!--begin::User-->
            <div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
                <!--begin::User info-->
                <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 px-2 px-md-3" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">

                    <!--begin::Symbol-->
                    <div class="symbol symbol-30px symbol-md-40px">

						 		@if(!empty(Auth::user()->profile_photo_path))
                                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="image" >
                                @else
                                    <img src="{{ asset('assets/media/avatars/blank.png') }}"alt="image" >
                                @endif
                    </div>
                    <!--end::Symbol-->
                </div>
                <!--end::User info-->
                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
								@if(!empty(Auth::user()->profile_photo_path))
                                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="image" >
                                @else
                                    <img src="{{  asset('assets/media/avatars/blank.png') }}"alt="image" >
                                @endif
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex- align-items-center fs-5 text-capitalize">{{ Auth::user()->name}}</div>
                                <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->


                    <!--begin::Menu item-->
                    <div class="menu-item px-5 my-1">
                        <a href="{{ url('user/profile') }}" class="menu-link px-5">Il mio account</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{ route('logout')}}" class="menu-link px-5">Disconnetti</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->

                </div>
                <!--end::User account menu-->
            </div>
            <!--end::User -->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>

	<!--Ticket Modal -->
<div class="modal fade" id="ticketModel" tabindex="-1" aria-labelledby="ticketModel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supporto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="post" action="{{ route('buyer.support.ticket') }}" enctype="multipart/form-data"
             onsubmit="handleSubmit(arguments[0])"
       >
		   @csrf
		   <input type="hidden" name="selectedoption"  id="selectedoption"/>
		  <div class="mb-3 ">
			  <label class="form-check-label h6" >Tipo di Richiesta<span class="text-danger">*</span></label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="radio" class="form-check-input typeofrequest" name="typeofrequest" onchange="showOrdersSelectList()"  value="Problem with my order" required="required">
			<label class="form-check-label" for="typeofrequest" >Problemi con il mio Ordine
</label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="radio" class="form-check-input typeofrequest" name="typeofrequest" onchange="showOrdersSelectList()"  value="Cancel my order" required="required">
			<label class="form-check-label" for="typeofrequest" >Problemi con il mio Account

</label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="radio" class="form-check-input typeofrequest" name="typeofrequest" onchange="showRestaurantSelectList()"  value="Report this business/restaurant" required="required">
			<label class="form-check-label" for="typeofrequest" >Riporta una Attività o un Ristorante

</label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="radio" class="form-check-input typeofrequest" name="typeofrequest" onchange="hideBothSelectList()"  value="other" required="required">
			<label class="form-check-label" for="typeofrequest" >Altro

</label>
		  </div>
		   <div class="mb-3" style="display:none;" id="orders-select-list">

			  <label for="details" class="form-check-label h6">Ordine N  <span class="text-danger">*</span></label>
		   <select class="form-select" data-placeholder="Select an option" required="required" name="selectedorder" onchange="setSelectedOption(this.value)" id="orders-select-list-tag">
			   <option hidden value="">Select Order  </option>
			   	@php
						$orders = \App\Models\orders::where('userid', Auth::user()->id)->where('status','=', 'paid')->orderby('id','desc')->get();
						@endphp
						@foreach($orders as $order)
							<option value="{{ $order->order_number }}">{{ $order->order_number }}</option>
			   			@endforeach
			</select>
			   </div>
		      <div class="mb-3"  style="display:none;" id="restaurant-select-list">

			  <label for="details" class="form-check-label h6">Restaurant  <span class="text-danger">*</span></label>
		   <select class="form-select" data-placeholder="Select an option" required="required" name="selectedrestaurant" id="restaurant-select-list-tag" onchange="setSelectedOption(this.value)">
			   <option hidden value="">Select Restaurant  </option>
			   	@php
						$users = \App\Models\user::where('role', '=','vendor')->orderby('id','desc')->get();
						@endphp
						@foreach($users as $user)
							<option value="{{ $user->id.'-'.$user->name }}">{{ $user->name }}</option>
			   			@endforeach
			</select>
			   </div>
			<div class="mb-3">
			  <label for="details" class="form-check-label h6">Dettagli  <span class="text-danger">*</span></label>
			  <textarea class="form-control" id="details" name="details" rows="3" required="required"></textarea>
			</div>
		   <div class="mb-3">
			  <label for="formFile" class="form-check-label h6">Allega (opzionale)</label>
			  <input class="form-control" type="file" id="image" name="image" accept="image/*">
			</div>

           <div class="col-md-12 mb-2">
               <div class="form-group">
                   <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                   @if ($errors->has('g-recaptcha-response'))
                       <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                   @endif
               </div>

               <span class="text-danger captcha-error d-none">Captcha non valido</span>
           </div>
		  <button type="submit" class="btn btn-primary" name="submit" value="submit" >Invia</button>
		</form>
      </div>
    </div>
  </div>
</div>




<!--New orders modal-->
<div id="new_orders" class="bg-body drawer drawer-end" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'100%', 'lg': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#new_orders_toggle" data-kt-drawer-close="#kt_activities_close" style="width: 500px !important;">

			<!--begin::Messenger-->
			<div class="card w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">
				<!--begin::Card header-->
				<div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
					<!--begin::Title-->
					<div class="card-title">
						<!--begin::User-->
						<div class="d-flex justify-content-center flex-column me-3">

							<p class="fs-4 fw-bolder text-gray-600 text-hover-primary me-1 mb-2 lh-1">Notifiche Ordini!</p>


						</div>
						<!--end::User-->
					</div>
					<!--end::Title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">

						<!--begin::Close-->
						<div class="btn btn-sm btn-icon" id="new_orders_toggle">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-2 ">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="ff0066">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="ff0066"></rect>
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="ff0066"></rect>
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body py-1" id="kt_drawer_chat_messenger_body">




					<!--begin::Messages-->
					<div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px" style="height: 100%;">
						<!--begin::Message(in)-->

						<div id="buyer-orders-main">

						</div>

						<!--end::Message(in)-->

					</div>
					<!--end::Messages-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Messenger-->
		</div>
<script>
    const validateRecaptcha = () => {
        const response = grecaptcha.getResponse();

        return response.length;
    }

    function handleSubmit(e) {
        if (!validateRecaptcha()) {
            e.preventDefault();
            $('.captcha-error').removeClass('d-none')
            return;
        }
        $('.captcha-error').addClass('d-none')
    }
</script>
