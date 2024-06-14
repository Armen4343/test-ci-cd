<style>
	.notification{
	right: 28px !important;
    top: 8px !important;
    width: 23px !important;
    height: 18px !important;
    font-size: 10px !important;
    border-radius: 10px !important;
    background: #ff0066 !important;
	}
	@media screen and (max-width: 767px)
{
.notification{
	    right: 18px !important;
    top: 6px !important;
    width: 19px !important;
    height: 14px !important;
    font-size: 8px !important;
	}
}
    .container-fluid::before, .container-fluid::after {
        content: " ";
        display: none !important;
    }
</style>
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
			@if(Auth::user()->role == 'vendor')
			<div class="d-flex align-items-center ms-1">
			<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-danger w-30px h-30px w-md-40px h-md-40px" data-bs-toggle="modal" data-bs-target="#availabilityModel">
            <i class="fas fa-clock" style="font-size: 20px;"></i></div>
			</div>
			<div class="d-flex align-items-center ms-1">
			<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-danger w-30px h-30px w-md-40px h-md-40px" id="kt_activities_toggle">
            <i class="fas fa-plus" style="font-size: 20px;"></i></div>
			</div>
			<div class="d-flex align-items-center ms-1" id="new_orders_toggle" onclick="newOrdersCounterMarkRead()">
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
									<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-danger w-30px h-30px w-md-40px h-md-40px position-relative"  data-bs-toggle="modal" data-bs-target="#ticketModel" >
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
			@endif
            <!--begin::User-->
            <div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
                <!--begin::User info-->
                <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 px-2 px-md-3" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">

                    <!--begin::Symbol-->
                    <div class="symbol symbol-30px symbol-md-40px">
                       <img src="{{ asset((Auth::user()->profile_photo_path == NULL) ? 'assets/media/avatars/blank.png' : Auth::user()->profile_photo_path) }}" alt="image" />
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
                             <img alt="Logo" src="{{ asset((Auth::user()->profile_photo_path == NULL) ? 'assets/media/avatars/blank.png' : Auth::user()->profile_photo_path) }}" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex- align-items-center fs-5">{{ Auth::user()->name}}</div>
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


<div id="kt_activities" class="bg-body drawer drawer-end" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close" style="width: 500px !important;">

			<!--begin::Messenger-->
			<div class="card w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">
				<!--begin::Card header-->
				<div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
					<!--begin::Title-->
					<div class="card-title">
						<!--begin::User-->
						<div class="d-flex justify-content-center flex-column me-3">
							<p class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Good News !!</p>
							<p class="fs-4 fw-bolder text-gray-600 text-hover-primary me-1 mb-2 lh-1">Sono state aggiunte nuove categorie</p>


						</div>
						<!--end::User-->
					</div>
					<!--end::Title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">

						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_activities_toggle">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
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
				<div class="card-body" id="kt_drawer_chat_messenger_body">
					<!--begin::Messages-->
					<div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px" style="height: 197px;">
						<!--begin::Message(in)-->
						@php
						$categories = \App\Models\Category::limit(8)->orderBy('id', 'desc')->get();
						@endphp
						@foreach($categories as $category)
						<div class="d-flex justify-content-start mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Avatar-->
									<div class="symbol symbol-35px ">
										<img alt="Pic" src="{{ asset($category->image) }}">
									</div>
									<!--end::Avatar-->
									<!--begin::Details-->
									<div class="ms-3">
										<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{ $category->title }}</a>
										<span class="text-muted fs-7 mb-1">{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</span>
									</div>
									<!--end::Details-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">{{ $category->description }}</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
						@endforeach
						<!--end::Message(in)-->

					</div>
					<!--end::Messages-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Messenger-->
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
							<div id="have-order">
							<p class="fs-4 fw-bolder  text-hover-primary me-1 mb-2 lh-1 main-pink-color">Good News!</p>
							<p class="fs-4 fw-bolder text-gray-600 text-hover-primary me-1 mb-2 lh-1">Hai ricevuto un nuovo ordine</p>
							</div>
							<div id="no-order-yet" style="display:none">
							<p class="fs-4 fw-bolder text-gray-600 text-hover-primary me-1 mb-2 lh-1">You have not any order yet!</p>
							</div>

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

						<div id="vendor-orders-main">

						</div>

						<!--end::Message(in)-->

					</div>
					<!--end::Messages-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Messenger-->
		</div>

<!--Ticket Modal -->
<div class="modal fade" id="ticketModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Support ticket</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="post" onsubmit="handleSubmit(arguments[0])"  action="{{ route('support-ticket') }}" enctype="multipart/form-data">
		   @csrf
		  <div class="mb-3 ">
			  <label class="form-check-label h6" >Oggetto Richiesta <span class="text-danger">*</span></label>
			  <p class="text-danger" style="display:none" id="typeofrequest-error">Clicca una o piu' voci.</p>
		  </div>
		  <div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input typeofrequest" name="typeofrequest[]" onchange="checkvalidation()"  value="missing function">
			<label class="form-check-label" for="typeofrequest" >Funzione Mancante</label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input typeofrequest" name="typeofrequest[]" onchange="checkvalidation()"  value="payment problem" >
			<label class="form-check-label" for="typeofrequest" >Problema di Pagamento</label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input typeofrequest" name="typeofrequest[]" onchange="checkvalidation()"  value="It support" >
			<label class="form-check-label" for="typeofrequest" >Supporto IT </label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input typeofrequest" name="typeofrequest[]" onchange="checkvalidation()"  value="Admin help" >
			<label class="form-check-label" for="typeofrequest" >Supporto Amministrativo</label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input typeofrequest" name="typeofrequest[]" onchange="checkvalidation()"  value="Report an order" >
			<label class="form-check-label" for="typeofrequest" >Segnala un Ordine</label>
		  </div>
		  <div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input typeofrequest"  name="typeofrequest[]" onchange="checkvalidation()" value="other">
			<label class="form-check-label" for="typeofrequest">Altro</label>
		  </div>
		  <div class="mb-3 ">
			<input type="text" class="form-control" name="other" id="other">
		  </div>

		   <div class="mb-3" style="display:none;" id="orders-select-list">

			  <label for="selectedorder" class="form-check-label h6">Order Number  <span class="text-danger">*</span></label>
		   <select class="form-select" data-placeholder="Select an option" name="selectedorder"  id="orders-select-list-tag">
			   <option hidden value="">Select Order  </option>
			   	@php
						$orders = \App\Models\orders::where('vendorid', Auth::user()->id)->where('status','=', 'paid')->orderby('id','desc')->get();
						@endphp
						@foreach($orders as $order)
							<option value="{{ $order->order_number }}">{{ $order->order_number }}</option>
			   			@endforeach
			</select>
			   </div>
			<div class="mb-3">
			  <label for="details" class="form-check-label h6">Dettagli  <span class="text-danger">*</span></label>
			  <textarea class="form-control" id="details" name="details" rows="3" required="required"></textarea>
			</div>
		   <div class="mb-3">
			  <label for="formFile" class="form-check-label h6">Allega File</label>
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
		  <button type="submit" class="btn btn-primary" name="send">Invia</button>
		</form>
      </div>
    </div>
  </div>
</div>


<!--Availability Modal -->
@php
 $availability = \App\Models\VendorAvailability::where(['vendor_id' => Auth::User()->id])->first();
@endphp

<div class="modal fade" id="availabilityModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Orario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     		<form method="post" action="{{ route('availability.store') }}">
  @csrf
				<input type="hidden" value="{{Auth::User()->id}}" name="vendor_id">
  <div class="row">
    <div class="col-3">
      <h5 class="pt-3">Giorno</h5>
    </div>
    <div class="col-3">
      <h5 class="pt-3">Aperto/Chiuso</h5>
    </div>
    <div class="col-3">
      <h5 class="pt-3">Ora di Apertura</h5>
    </div>
    <div class="col-3">
      <h5 class="pt-3">Ora di Chiusura</h5>
    </div>
    <div class="col-12">
      <hr />
    </div>
  </div>

  <div class="row">
    <div class="col-3">
      <h5 class="pt-3">Domenica</h5>
    </div>
    <div class="col-3">
      <div class="form-check form-switch pt-3">
		  <input class="form-check-input" type="checkbox" id="sunday" name="sunday" value="1"
			   onchange="changeAvailability('sunday')" {{ (isset($availability->sunday_open) && $availability->sunday_open != null) ? 'checked' : 'a' }}>
      </div>
    </div>
    <div class="col-3">
      <div class="mb-3">
        <input type="time" class="form-control" id="sunday_open" aria-describedby="sunday_open" name="sunday_open"
          {{(isset($availability->sunday_open) && $availability->sunday_open != null) ? '' : 'disabled'}} required
		  value="{{(isset($availability->sunday_open) && $availability->sunday_open != null) ? $availability->sunday_open : ''}}">
      </div>
    </div>
    <div class="col-3">
      <div class="mb-3">
        <input type="time" class="form-control" id="sunday_close" aria-describedby="sunday_close" name="sunday_close"
           required {{(isset($availability->sunday_open) && $availability->sunday_open != null) ? '' : 'disabled'}} required
		  value="{{(isset($availability->sunday_open) && $availability->sunday_open != null) ? $availability->sunday_close : ''}}">
      </div>
    </div>
  </div>

  <div class="row">
  <div class="col-3">
    <h5 class="pt-3">Lunedì</h5>
  </div>
  <div class="col-3">
    <div class="form-check form-switch pt-3">
      <input class="form-check-input" type="checkbox" id="monday" name="monday" value="1"
        onchange="changeAvailability('monday')" {{(isset($availability->monday_open) && $availability->monday_open != null) ? 'checked' : ''}}>
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="monday_open" aria-describedby="monday_open" name="monday_open"
        {{(isset($availability->monday_open ) && $availability->monday_open != null) ? '' : 'disabled'}} required
        value="{{(isset($availability->monday_open ) && $availability->monday_open != null) ? $availability->monday_open : ''}}">
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="monday_close" aria-describedby="monday_close" name="monday_close"
        required {{(isset($availability->monday_open ) && $availability->monday_open != null) ? '' : 'disabled'}} required
        value="{{(isset($availability->monday_open ) && $availability->monday_open != null) ? $availability->monday_close : ''}}">
    </div>
  </div>
</div>

  <div class="row">
  <div class="col-3">
    <h5 class="pt-3">Martedì</h5>
  </div>
  <div class="col-3">
    <div class="form-check form-switch pt-3">
      <input class="form-check-input" type="checkbox" id="tuesday" name="tuesday" value="1"
        onchange="changeAvailability('tuesday')" {{(isset($availability->tuesday_open ) && $availability->tuesday_open != null) ? 'checked' : ''}}>
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="tuesday_open" aria-describedby="tuesday_open" name="tuesday_open"
        {{(isset($availability->tuesday_open ) && $availability->tuesday_open != null) ? '' : 'disabled'}} required
        value="{{(isset($availability->tuesday_open ) && $availability->tuesday_open != null) ? $availability->tuesday_open : ''}}">
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="tuesday_close" aria-describedby="tuesday_close" name="tuesday_close"
        required {{(isset($availability->tuesday_open ) && $availability->tuesday_open != null) ? '' : 'disabled'}} required
        value="{{(isset($availability->tuesday_open ) && $availability->tuesday_open != null) ? $availability->tuesday_close : ''}}">
    </div>
  </div>
</div>

 <div class="row">
  <div class="col-3">
    <h5 class="pt-3">Mercoledì</h5>
  </div>
  <div class="col-3">
    <div class="form-check form-switch pt-3">
      <input class="form-check-input" type="checkbox" id="wednesday" name="wednesday" value="1"
        onchange="changeAvailability('wednesday')" {{(isset($availability->wednesday_open ) && $availability->wednesday_open != null) ? 'checked' : ''}}>
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="wednesday_open" aria-describedby="wednesday_open" name="wednesday_open"
        {{(isset($availability->wednesday_open ) && $availability->wednesday_open != null) ? '' : 'disabled'}} required
        value="{{(isset($availability->wednesday_open ) && $availability->wednesday_open != null) ? $availability->wednesday_open : ''}}">
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="wednesday_close" aria-describedby="wednesday_close" name="wednesday_close"
        required {{(isset($availability->wednesday_open ) && $availability->wednesday_open != null) ? '' : 'disabled'}} required
        value="{{(isset($availability->wednesday_open ) && $availability->wednesday_open != null) ? $availability->wednesday_close : ''}}">
    </div>
  </div>
</div>

  <div class="row">
  <div class="col-3">
    <h5 class="pt-3">Giovedì</h5>
  </div>
  <div class="col-3">
    <div class="form-check form-switch pt-3">
      <input class="form-check-input" type="checkbox" id="thursday" name="thursday" value="1"
        onchange="changeAvailability('thursday')" {{(isset($availability->thursday_open) && $availability->thursday_open!= null) ? 'checked' : ''}}>
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="thursday_open" aria-describedby="thursday_open" name="thursday_open"
        {{(isset($availability->thursday_open) && $availability->thursday_open!= null) ? '' : 'disabled'}} required
        value="{{(isset($availability->thursday_open) && $availability->thursday_open!= null) ? $availability->thursday_open : ''}}">
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="thursday_close" aria-describedby="thursday_close" name="thursday_close"
        required {{(isset($availability->thursday_open) && $availability->thursday_open!= null) ? '' : 'disabled'}} required
        value="{{(isset($availability->thursday_open) && $availability->thursday_open!= null) ? $availability->thursday_close : ''}}">
    </div>
  </div>
</div>

  <div class="row">
  <div class="col-3">
    <h5 class="pt-3">Venerdì</h5>
  </div>
  <div class="col-3">
    <div class="form-check form-switch pt-3">
      <input class="form-check-input" type="checkbox" id="friday" name="friday" value="1"
        onchange="changeAvailability('friday')" {{(isset($availability->friday_open) && $availability->friday_open!= null) ? 'checked' : ''}}>
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="friday_open" aria-describedby="friday_open" name="friday_open"
        {{(isset($availability->friday_open) && $availability->friday_open!= null) ? '' : 'disabled'}} required
        value="{{(isset($availability->friday_open) && $availability->friday_open!= null) ? $availability->friday_open : ''}}">
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="friday_close" aria-describedby="friday_close" name="friday_close"
        required {{(isset($availability->friday_open) && $availability->friday_open!= null) ? '' : 'disabled'}} required
        value="{{(isset($availability->friday_open) && $availability->friday_open!= null) ? $availability->friday_close : ''}}">
    </div>
  </div>
</div>

  <div class="row">
  <div class="col-3">
    <h5 class="pt-3">Sabato</h5>
  </div>
  <div class="col-3">
    <div class="form-check form-switch pt-3">
      <input class="form-check-input" type="checkbox" id="saturday" name="saturday" value="1"
        onchange="changeAvailability('saturday')" {{(isset($availability->saturday_open) && $availability->saturday_open!= null) ? 'checked' : ''}}>
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="saturday_open" aria-describedby="saturday_open" name="saturday_open"
        {{(isset($availability->saturday_open) && $availability->saturday_open!= null) ? '' : 'disabled'}} required
        value="{{(isset($availability->saturday_open) && $availability->saturday_open!= null) ? $availability->saturday_open : ''}}">
    </div>
  </div>
  <div class="col-3">
    <div class="mb-3">
      <input type="time" class="form-control" id="saturday_close" aria-describedby="saturday_close" name="saturday_close"
        required {{(isset($availability->saturday_open) && $availability->saturday_open!= null) ? '' : 'disabled'}} required
        value="{{(isset($availability->saturday_open) && $availability->saturday_open!= null) ? $availability->saturday_close : ''}}">
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-12">
      <hr />
    </div>
    <div class="col-6">

		<div class="form-check form-check-inline">
		 <input class="form-check-input" type="radio" name="status" value="1"
				{{(isset($availability->status) && $availability->status == '1') ? 'checked' : ''}}
			>
		  <label class="form-check-label" for="status">
			Aperto Ora
		  </label>
		</div>
		<div class="form-check form-check-inline ">
		  <input class="form-check-input" type="radio" name="status" value="0"
				 {{(isset($availability->status) && $availability->status == '0') ? 'checked' : ''}}
			>
		  <label class="form-check-label" for="status">
			Chiuso Ora
		  </label>
		</div>
    </div>
    <div class="col-6">
      <button type="submit" class="btn btn-primary ms-auto me-0 d-block">Salva</button>
    </div>
  </div>


</form>
      </div>
    </div>
  </div>
</div>

	@push("vendor-scripts")
<script>
	function changeAvailability(v){
	if(document.getElementById(v).checked) {
	  	document.getElementById(v+'_open').disabled = false;
	  	document.getElementById(v+'_close').disabled = false;
	}
	else{
	  	document.getElementById(v+'_open').disabled = true;
	  	document.getElementById(v+'_close').disabled = true;
	}
	}

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
        return checkvalidation();
    }


    function checkvalidation(){
		$("#orders-select-list-tag").prop('required',false);
		$("#orders-select-list").hide();
        if ($('.typeofrequest').not(':checked').length >= 6) {
			$('#typeofrequest-error').show();
            return false;
        }
		else{
		$('#typeofrequest-error').hide();

			$('input.typeofrequest[type=checkbox]').each(function () {
				if (this.checked && this.value == 'Cancel order'){
					$("#orders-select-list").show();
					$("#orders-select-list-tag").prop('required',true);
				}
				if (this.checked && this.value == 'other'){
					$("#other").prop('required',true);
				}
				else{
					$("#other").prop('required',false);
				}
			});
			 return true;
		}
	}



</script>

	@endpush
