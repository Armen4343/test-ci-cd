@extends('layouts.buyer.master')

@section('buyer')
  <div class="card p-3">

<div class="card-header border-0  p-0">
  <!--begin::Title-->
  <h3 class="fw-bolder m-0 p-0">Update Card</h3>
  <!--end::Title-->
  </div>

<form action="{{ route('cards.update',$card->id) }}" method="POST">
        @csrf
        @method('PUT')
	<input name="id" value="{{$card->id}}" hidden>
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
															<span class="required">Card type</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a card type"></i>
														</label>
														<!--end::Label-->
														<select name="card_type" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Card Type" required>
																		<option value="{{ $card->card_type }}" checked>{{ $card->card_type }}</option>
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
															<span class="required">Name On Card</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a card holder's name"></i>
														</label>
														<!--end::Label-->
														<input type="text" class="form-control form-control-solid" placeholder="Max Doe" name="name_on_card"  required  value="{{ $card->name_on_card }}"/>
														@if($errors->has('card_name'))
															<div class="error">{{ $errors->first('card_name') }}</div>
														@endif
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="d-flex flex-column mb-7 fv-row">
														<!--begin::Label-->
														<label class="required fs-6 fw-bold form-label mb-2">Card Number</label>
														<!--end::Label-->
														<!--begin::Input wrapper-->
														<div class="position-relative">
															<!--begin::Input-->
															<input type="text" class="form-control form-control-solid" placeholder="Enter card number eg: 4111 1111 1111 1111" name="card_number" required  value="{{ Crypt::decryptString($card->card_number) }}"/>
															@if($errors->has('card_number'))
															<div class="error">{{ $errors->first('card_number') }}</div>
														@endif
															<!--end::Input-->
															<!--begin::Card logos-->
															<div class="position-absolute translate-middle-y top-50 end-0 me-5">
																<img src="{{asset('assets/media/svg/card-logos/visa.svg')}}" alt="" class="h-25px" />
																<img src="{{asset('assets/media/svg/card-logos/mastercard.svg')}}" alt="" class="h-25px" />
																<img src="{{asset('assets/media/svg/card-logos/american-express.svg')}}" alt="" class="h-25px" />
															</div>
															<!--end::Card logos-->
														</div>
														<!--end::Input wrapper-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="row mb-10">
														<!--begin::Col-->
														<div class="col-md-12 fv-row">
															<!--begin::Label-->
															<label class="required fs-6 fw-bold form-label mb-2">Expiration Date</label>
															<!--end::Label-->
															<!--begin::Row-->
															<div class="row fv-row">
																<!--begin::Col-->
																<div class="col-6">
																	<select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month" required>
																		
			<option value="{{ date('m',strtotime($card->expiration_date)) }}" >{{ date('m',strtotime($card->expiration_date)) }}</option>
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
																	<select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year" required>
			<option value="{{ date('Y',strtotime($card->expiration_date)) }}" >{{ date('Y',strtotime($card->expiration_date)) }}</option>
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
											
													
	 <button type="submit" class="btn btn-success  d-block mt-2"><i class="fas fa-save"></i>Save</button>
</form>
       
</div>
@endsection
