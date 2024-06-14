@extends('layouts.vendor.master')

@section('vendor')


@if(session("success"))
	<div class="alert alert-success" role="alert">
	  {{session("success")}}
	</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card p-3">
	<div class="card-header align-items-center">
	  <h3 class="fw-bolder m-0">Manage Menu Items</h3>
	</div>
	<div class="card-body p-0 p-md-2">
			<form action="{{route('menu-items.store')}}" method="post" >
			@csrf
			<input type="hidden" name="menu_id" value="{{$menu->id}}"/>

		  <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
        <div class="row">
		 <div class="col-md-12">
			 <h3 class="text-center">{{$menu->title}}</h3>
		 </div>


		 <div class="col-md-12 my-3">
			<label  class="required fs-6 mb-2 fw-bolder text-gray-800 d-block">Select Category</label>
			<div class="row">

				@php $Categories = \App\Models\Category::where(['status' => '1'])->get(); @endphp
			@foreach($Categories as $Category)
				<div class="col-md-6">
					<div class="form-check form-check-danger form-check-solid form-check-custom mb-2">
						<input class="form-check-input" type="radio" value="{{ $Category->id }}" {{ ($Category->title == 'Menu') ? 'checked' : ''}} name="category_id" required="required" />
						<label class="form-check-label" for="flexRadioDefault">
							{{ $Category->title }}
						</label>
					</div>
				</div>
				@endforeach
			</div>
		</div>
			@php
			$items = \App\Models\Items::where(['menu_status' => '1', 'user_id' => Auth::user()->id])->get();
			$itemsChecked = \App\Models\MenuItems::where(['menu_id' => $menu->id])->pluck('item_id')->toArray();
			@endphp
		<div class="col-md-12 my-3">
			 <label class="required fs-6 mb-2 fw-bolder text-gray-800 d-block">Select Menu Item</label>
			<div class="row">
					@foreach($items as $item)
					<div class="col-md-6">

					<!--begin::Checkbox-->
					<div class="form-check form-check-custom form-check-solid mb-5 me-3 form-check-danger">
						<!--begin::Input-->
						<input class="form-check-input  items-checkbox" name="items[]"  type="checkbox" value="{{$item->id}}" id="item-{{$item->id}}"  <?php if(in_array($item->id, $itemsChecked)){ echo 'checked="checked"'; }?> />
						<!--end::Input-->

						<!--begin::Label-->
						<label class="form-check-label" for="item-{{$item->id}}">
								<div class="fw-bolder text-gray-600">{{$item->name}}</div>
						</label>
						<!--end::Label-->
					</div>
				<!--end::Checkbox-->
					</div>
				@endforeach
			</div>
</div>
		<div class="col-md-12 my-2">
				<div class="card mb-3 shadow-sm item-box-${data.id}">
					<div class="card-body p-0 ps-2">
							<table class="w-100 ">
								<thead>
									<tr>
										<th>Item</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Total</th>
										<th>Remove</th>
									</tr>
								</thead>
								<tbody class="display-items">
										@php
										$itemsData = \App\Models\MenuItems::with('items')->where(['menu_id' => $menu->id])->get();
										@endphp
										@foreach($itemsData as $row)
                                            @if(isset($row->items))
											    <tr class=" item-box-{{ $row->items->id }}">
									<td>
										<div class="d-flex flex-row align-items-center">
											<div>
												<img src="{{asset( ($row->items->image) ? $row->items->image : 'images/no-image.png')}}" class="img-fluid rounded-3" alt="Pizza" style="max-width: 65px;min-width:65px">
											</div>
											<div class="ms-3">
												<h5>{{ $row->items->name }}</h5>
												<p class="small mb-0">{{ $row->items->description }}</p>
											</div>
										</div>
									</td>
									<td>
										<input type="number" id="item-qty-{{ $row->items->id }}" class="form-control w-lg-50 col-lg-50" onchange="updateQty({{ $row->items->id }}, this.value)" name="qty[]" min="1" value="{{ $row->qty }}">
										<input type="hidden" name="tax[]" id="tax-hidden-{{ $row->items->id }}" value="{{ $row->items->tax }}" />
										<input type="hidden" name="price[]" id="price-hidden-{{ $row->items->id }}" value="{{ $row->items->price }}" />
										<input type="hidden" name="item_total[]" id="item-total-hidden-{{ $row->items->id }}"
											   value="{{ ($row->items->price) }}" />

									</td>
									<td>
										<p id="item-price-{{ $row->items->id }}">&euro;{{ number_format($row->items->price, 2, ',', '') }}</p>
									</td>
									<td>
										<p class="item-total-{{ $row->items->id }}">
					&euro;{{ number_format((float)(($row->items->price)*$row->qty), 2, ',', '') }}</p>
									</td>
									<td>
										<span onclick="removeItem({{ $row->items->id }})"  style="color: #ff0066 !mportant;cursor:pointer;"><i class="fas fa-trash-alt text-danger"></i></span>
									</td>
								</tr>
                                            @endif
										@endforeach
								</tbody>
							</table>

				</div>
		 	</div>
		</div>

		<div class="col-md-6 my-3">
			<label class="required fw-bold fs-6 mb-2">Price</label>
			<div class=" form-check-solid ">
					<input class="form-check-input" type="radio" value="sum" {{ ($menu->price_type == 'sum') ? 'checked' : '' }}  name="price_type" checked="checked" />
					<label class="form-check-label" for="flexRadioChecked">
							Sum of items
					</label>

						<input class="form-check-input" type="radio" value="manual"  {{ ($menu->price_type == 'manual') ? 'checked' : '' }}   name="price_type"  />
						<label class="form-check-label" for="flexRadioChecked">
								Manual
						</label>
				</div>
		</div>

		 <div class="col-md-6 my-3">
			 <label class="required fw-bold fs-6 mb-2">Menu Price</label>
			 <div class="input-group mb-5">
				<span class="input-group-text">&euro;</span>
				<input type="text" class="form-control" name="price" value="{{ $menu->price }}" id="totalprice"  aria-label="Amount (to the nearest dollar)"/>
			</div>
		 </div>


            <div class="col-md-12 mt-3 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold fs-6 mb-2">Intervallo di tempo da</label>
                        <input class="form-control" type="time" name="time_range_from" value="{{ $menu->time_range ? explode('-', $menu->time_range)[0] : '' }}" />
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold fs-6 mb-2">Intervallo di tempo fino a</label>
                        <input class="form-control" type="time" name="time_range_to" value="{{ $menu->time_range ? explode('-', $menu->time_range)[1] : '' }}"  />
                    </div>
                </div>
            </div>
            @php
                $chkw = $menu->promo_days;
                $chkecked = explode(',',$chkw);
            @endphp
            <div class="col-12 my-3">
                <label class="fw-bold fs-6 mb-2">Giornate promozionali</label>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]" value="Lunedi" <?php if(in_array('Lunedi', $chkecked)){ ?> checked="checked" <?php } ?> />
                            <label class="form-check-label" for="flexSwitchDefault">
                                Lunedi
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]" value="Martedì" <?php if(in_array('Martedì', $chkecked)){ ?> checked="checked" <?php } ?> />
                            <label class="form-check-label" for="flexSwitchDefault">
                                Martedì
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Mercoledì" <?php if(in_array('Mercoledì', $chkecked)){ ?> checked="checked" <?php } ?> />
                            <label class="form-check-label" for="flexSwitchDefault">
                                Mercoledì
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Giovedì" <?php if(in_array('Giovedì', $chkecked)){ ?> checked="checked" <?php } ?>/>
                            <label class="form-check-label" for="flexSwitchDefault">
                                Giovedì
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Venerdì"  <?php if(in_array('Venerdì', $chkecked)){ ?> checked="checked" <?php } ?>/>
                            <label class="form-check-label" for="flexSwitchDefault">
                                Venerdì
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Sabato" <?php if(in_array('Sabato', $chkecked)){ ?> checked="checked" <?php } ?>/>
                            <label class="form-check-label" for="flexSwitchDefault">
                                Sabato
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Domenica"  <?php if(in_array('Domenica', $chkecked)){ ?> checked="checked" <?php } ?>/>
                            <label class="form-check-label" for="flexSwitchDefault">
                                Domenica
                            </label>
                        </div>
                    </div>
                </div>
            </div>

      </div>
      <div class="modal-footer">
        <a href="{{ route('menus.index')}}" class="btn btn-secondary">Close</a>
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



@push('vendor-scripts')
    <script type="text/javascript">


						$("#cuisine_table").DataTable({
						"language": {
							"lengthMenu": "Show _MENU_",
						},
						"dom":
							"<'row'" +
							"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
							"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
							">" +

							"<'table-responsive'tr>" +

							"<'row'" +
							"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
							"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
							">"
						});

							$(document).ready(function (e) {
						$(".deleteBtn").click(function(e){
						e.preventDefault()
							var form=$(this).parent().parent();
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
							form.submit();
						}
					})
						})
					});
</script>



<script>



var totalprice = {{ ($menu->price) ? $menu->price : 0 }};
$(document).ready(function() {
    //set initial state.
    // $('#textbox1').val(this.checked);

    $('.items-checkbox').change(function() {

			var items_add = $(this).val();
        if(this.checked) {
					var temp_img = 'images/no-image.png';
					var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
							// items_id = $(this).val();
                $.ajax({
                    /* the route pointing to the post function */
                    url: "{{ route('fetch.items.ajax') }}",
                    type: 'get',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN,items_add},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
											if(data.image != null){
												temp_img = data.image;
											}
                        $('.display-items').append(`
								<tr class=" item-box-${data.id}">
									<td>
										<div class="d-flex flex-row align-items-center">
											<div>
												<img src="{{asset('${temp_img}')}}" class="img-fluid rounded-3" alt="Pizza" style="max-width: 65px;min-width:65px">
											</div>
											<div class="ms-3">
												<h5>${data.name}</h5>
												<p class="small mb-0">${data.description}</p>
											</div>
										</div>
									</td>
									<td>
										<input type="number" id="item-qty-${data.id}" class="form-control w-lg-50 col-lg-50" onchange="updateQty(${data.id}, this.value)" name="qty[]" min="1" value="1">
										<input type="hidden" name="tax[]" id="tax-hidden-${data.id}" value="${data.tax}" />
										<input type="hidden" name="price[]" id="price-hidden-${data.id}" value="${data.price}" />
										<input type="hidden" name="item_total[]" id="item-total-hidden-${data.id}" value="${(Number(data.price))}" />
									</td>
									<td>
										<p id="item-price-${data.id}">&euro;${data.price?.toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) || '0.00'}</p>
									</td>
									<td>
										<p class="item-total-${data.id}">&euro;${data.price?.toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) || '0.00'}</p>
									</td>
									<td>
										<span  onclick="removeItem(${data.id})"  style="color: #ff0066 !mportant;cursor:pointer;"><i class="fas fa-trash-alt text-danger"></i></span>
									</td>
								</tr>`);

								totalprice += Number(data.price);
								updateTotalPrice(totalprice);
                    }
                });
        }
				else{
					removeItem(items_add);
				}
    });
});


function removeItem(id){
	var itemTotal = Number($('#item-total-hidden-'+id).val());
	console.log(totalprice)
	totalprice -= itemTotal;
	totalprice = Math.abs(totalprice);
	updateTotalPrice(totalprice);
	$('.item-box-'+id).remove();
	$("#item-"+id).prop("checked", false);
}
function updateQty(id,qty){
	console.log(totalprice)
	var itemTotal = Number($('#item-total-hidden-'+id).val());
	console.log(itemTotal)
	totalprice -= itemTotal;
	console.log(totalprice)
	totalprice = Math.abs(totalprice);
	var tax = Number($('#tax-hidden-'+id).val());
	var price = Number($('#price-hidden-'+id).val());
	var total_temp = (price * qty);
	$('.item-total-'+id).text(total_temp.toFixed(2));
	$('#item-total-hidden-'+id).val(total_temp);
	totalprice += total_temp;
	updateTotalPrice(totalprice);
}
function updateTotalPrice(totalprice){
	console.log(totalprice)
$('#totalprice').val(totalprice.toFixed(2));
}




$('input[type=radio][name=price_type]').change(function() {
    if (this.value == 'sum') {
			$('#totalprice').val(totalprice.toFixed(2));
    }
    else if (this.value == 'manual') {
			$('#totalprice').val('');
    }
});

    </script>


@endpush


@endsection
