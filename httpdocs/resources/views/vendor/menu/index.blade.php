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
        <h3 class="fw-bolder m-0">Basket Offerta</h3>
    </div>
    <div class="card-body">
        <table id="cuisine_table" class="table table-striped table-row-bordered gy-4 gs-7 border rounded">
            <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th>Nome Basket Offerta</th>
                    <th>Status Basket Offerta</th>
                    <th class="d-flex justify-content-end pe-5">Opzioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#addMenuItemModal-{{$menu->id}}" class="menutitle">{{$menu->title}}</a>
                            <!-- addMenuItemModal -->
                            <div class="modal fade" id="addMenuItemModal-{{$menu->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Crea Basket Offerta</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('menu-items.store')}}" method="post" id="frm-{{$menu->id}}">
                                            @csrf
                                            <input class="form-check-input" type="hidden" value="yes" id="flexCheckDefault" name="availability" />
                                            <input type="hidden" name="menu_id" class="menuidhidden" value="{{$menu->id}}"/>
                                            <div class="modal-body">
                                                <div class="alert alert-danger print-error-msg" style="display:none">
                                                <ul></ul>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 my-3">
                                                    <h3 class="text-center">{{$menu->title}}</h3>
                                                </div>
                                                <div class="col-md-12 my-3">
                                                    <label class="required fw-bold fs-6 mb-2">Seleziona Categoria</label>
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
                                                @endphp
                                                <div class="col-md-12 my-3">
                                                    <label class="required fs-6 mb-2 fw-bolder text-gray-800 d-block">Aggiungi Prodotti al Basket Offerta</label>
                                                    <div class="row">
                                                        @foreach($items as $item)
                                                            <div class="col-md-6">
                                                                <!--begin::Checkbox-->
                                                                @php
                                                                    $itemsData = \App\Models\MenuItems::with('items')->where(['menu_id' => $menu->id, 'item_id'=>$item->id])->get();
                                                                @endphp

                                                                <div class="form-check form-check-custom form-check-solid mb-5 me-3 form-check-danger">
                                                                    <!--begin::Input-->
                                                                    <input class="form-check-input  items-checkbox" name="items[]"  type="checkbox" value="{{$item->id}}" id="item-{{$item->id}}" @if($itemsData->count()>0) checked="true" @endif />
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
                                                        <div class="card-body p-0">
                                                            <table class="w-100 table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Prodotti</th>
                                                                        <th>Quantità</th>
                                                                        <th>Prezzo</th>
                                                                        <th>Totale</th>
                                                                        <th>Rimuovi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="display-items">
                                                                    @php
                                                                        $itemsData = \App\Models\MenuItems::with('items')->where(['menu_id' => $menu->id])->get();
                                                                    @endphp
                                                                    @foreach($itemsData as $row)
																	@if(isset($row->items->id))
                                                                        <tr class=" item-box-{{ $row->items->id }}">
                                                                            <td>
                                                                                <div class="d-flex flex-row align-items-center">
                                                                                    <div>
                                                                                        <img src="{{asset($row->items->image)}}" class="img-fluid rounded-3" alt="Pizza" style="max-width: 65px;min-width:65px">
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
                                                                                <input type="hidden" name="item_total[]" id="item-total-hidden-{{ $row->items->id }}" class="item-total-hidden"
                                                                                    value="{{ ($row->items->price) * $row->qty }}" />
                                                                                <!--<input type="hidden" name="item_total[]" id="item-total-hidden-{{ $row->items->id }}}" value="${(Number((data.tax/100)*data.price) + Number(data.price))}" />-->
                                                                            </td>
                                                                            <td>
                                                                                <p id="item-price-{{ $row->items->id }}">&euro;{{ number_format($row->items->price, 2, ',', '') }}</p>
                                                                            </td>
                                                                            <td>
                                                                                <p class="item-total-{{ $row->items->id }}">&euro;{{ number_format((float)(($row->items->price) * $row->qty), 2, ',', '')  }}</p>
                                                                            </td>
                                                                            <td>
                                                                                <a href="#" onclick="removeItem({{ $row->items->id }})"  style="color: #ff0066 !mportant;"><i class="fas fa-trash-alt text-danger"></i></a>
                                                                            </td>
                                                                        </tr>
																	@endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="required fw-bold fs-6 ">Scegli Prezzo Basket Offerta</label>
                                                    <div class=" form-check-solid ">
                                                        <input class="form-check-input" type="radio" value="sum" {{ ($menu->price_type == 'sum') ? 'checked' : '' }}  name="price_type" checked="checked" />
                                                        <label class="form-check-label" for="flexRadioChecked">
                                                            Somma Prezzi Prodotti
                                                        </label>
                                                        <input class="form-check-input" type="radio" value="manual"  {{ ($menu->price_type == 'manual') ? 'checked' : '' }}   name="price_type"  />
                                                        <label class="form-check-label" for="flexRadioChecked">
                                                            Scegli Manualmente Prezzo Basket
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="required fw-bold fs-6 ">Prezzo Basket Offerta</label>
                                                    <div class="input-group ">
                                                        <span class="input-group-text">&euro;</span>
                                                        <input type="text" class="form-control totalprice" name="price" value="{{ $menu->price }}" id="totalprice"  aria-label="Amount (to the nearest dollar)"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 mb-5">
                                                    <label class="required fw-bold fs-6 mb-2">Offerta</label>

                                                    <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                        <input class="form-check-input h-20px w-30px" type="radio" name="promo" value="Soon to expire" @if($menu->promo=='Soon to expire') checked @endif >
                                                        <label class="form-check-label" for="flexSwitchDefault">
                                                            Scadenza breve
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                        <input class="form-check-input h-20px w-30px" type="radio" name="promo"  value="Extra stock" @if($menu->promo=='Extra stock') checked @endif>
                                                        <label class="form-check-label" for="flexSwitchDefault">
                                                            Extra stock
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                        <input class="form-check-input h-20px w-30px" type="radio" name="promo"  value="Promotion" @if($menu->promo=='Promotion') checked @endif>
                                                        <label class="form-check-label" for="flexSwitchDefault">
                                                            Promozione
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 mb-5">
                                                    <label class=" fw-bold fs-6 mb-2">Data di scandeza</label>
                                                        <input class="form-control" type="date" min="{{date('Y-m-d')}}" name="expire_date_menu" value="{{$menu->expire_date}}" />
                                                </div>
                                                <div class="col-md-12 mt-3 mb-5">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="fw-bold fs-6 mb-2">Intervallo di tempo da</label>
                                                            <input class="form-control" value="{{ $menu->time_range ? explode('-', $menu->time_range)[0] : '' }}" type="time" name="time_range_from" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="fw-bold fs-6 mb-2">Intervallo di tempo fino a</label>
                                                            <input value="{{ $menu->time_range ? explode('-', $menu->time_range)[1] : '' }}" class="form-control" type="time" name="time_range_to" />
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
                                                                <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]" value="Lunedi" <?php if(in_array('Lunedi', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                                                <label class="form-check-label" for="flexSwitchDefault">
                                                                    Lunedi
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                                <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]" value="Martedì" <?php if(in_array('Martedì', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                                                <label class="form-check-label" for="flexSwitchDefault">
                                                                    Martedì
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                                <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Mercoledì" <?php if(in_array('Mercoledì',$chkecked)){ ?> checked="checked" <?php } ?> />
                                                                <label class="form-check-label" for="flexSwitchDefault">
                                                                    Mercoledì
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                                <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Giovedì" <?php if(in_array('Giovedì',$chkecked)){ ?> checked="checked" <?php } ?>/>
                                                                <label class="form-check-label" for="flexSwitchDefault">
                                                                    Giovedì
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                                <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Venerdì" <?php if(in_array('Venerdì',$chkecked)){ ?> checked="checked" <?php } ?>/>
                                                                <label class="form-check-label" for="flexSwitchDefault">
                                                                    Venerdì
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                                <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Sabato" <?php if(in_array('Sabato',$chkecked)){ ?> checked="checked" <?php } ?>/>
                                                                <label class="form-check-label" for="flexSwitchDefault">
                                                                    Sabato
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                                                <input class="form-check-input h-20px w-30px" type="checkbox"  name="promo_days[]" value="Domenica" <?php if(in_array('Domenica',$chkecked)){ ?> checked="checked" <?php } ?>/>
                                                                <label class="form-check-label" for="flexSwitchDefault">
                                                                    Domenica
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="my-5"/>
                                                {{--<div class="col-md-12 my-3">
                                                    <label class="required fw-bold fs-6 mb-2">Disponibilità</label>
                                                </div>
                                                <div class="col-md-6 my-3">
                                                    <div class="form-check form-check-danger form-check-solid form-check-custom">
                                                        <input class="form-check-input" type="radio" value="yes" id="flexCheckDefault" name="availability"  @if($menu->availability=='yes') checked @endif/>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            In Stock
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 my-3">
                                                <div class="form-check form-check-danger form-check-solid form-check-custom">
                                                        <input class="form-check-input" type="radio" value="no" id="flexCheckDefault" name="availability" @if($menu->availability=='no') checked @endif/>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Non Disponible
                                                        </label>
                                                    </div>
                                                </div>
                                                <hr class="my-5"/>--}}
                                                <div class="col-md-6 my-3">
                                                        <label class="form-label">Durata Offerta</label>
                                                        <div class="mb-0">
                                                            <input class="form-control date-range-picker" name="date_range" placeholder="Pick date rage" value="{{$menu->date_range}}" />
                                                        </div>
                                                </div>

                                                <div class="col-md-6 my-3">
                                                    <label class="required fw-bold fs-6 mb-2">Menu Status</label>
                                                    <select class="form-select" name="menu_status" id="status">
                                                        <option value="1" @if($menu->status==1) selected @endif>Publish</option>
                                                        <option value="0" @if($menu->status==0) selected @endif>UnPublish</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('menus.index')}}" class="btn btn-secondary">Chiudi</a>
                                                <button type="submit" class="btn btn-primary frmsubmit" id="addCategory-btn">
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
                        <!-- addMenuItemModal end-->
                        </td>
                        <td>
                            @if($menu->status==1)
								<h6><span class="text-success status">Published</span></h6>
							@else
							    <h6><span class="text-danger status">UnPublished</span></h6>
							@endif
						</td>
						<td class="text-end pe-5">
                            <div class="dropdown">
                                <a href="#" class="dots-btn rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fs-4"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('menus.edit',$menu->id)}}">Edit</a></li>
                                    <li><a class="dropdown-item" href="{{route('manage.menu.items',$menu->id)}}">Manage Items</a></li>
                                    <form action="{{route('menus.destroy',$menu->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <li><button class="dropdown-item deleteBtn">Delete</button></li>
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    $(document).ready(function(){
            $(".date-range-picker").daterangepicker({
                drops: 'up'
            });
    });
    $(document).ready(function (e) {
        /*$('.expiredate').change(function(){
            var strDate = $(this).val();
            var objParent = $(this).closest('.modal');
            var arrItems = [];
            var nItemCount = 0;
            var checkboxes = $(objParent).find('.items-checkbox').each(function(i, obj) {
                console.log($(obj).val());
                {
                    if($(obj).is(':checked'))
                    {
                        //console.log($(obj).val() + ' is checked');
                        arrItems[nItemCount] = $(obj).val();
                        nItemCount++;
                    }
                }
            });
            if(nItemCount>0)
            {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type:'POST',
                    url:"{{route('menu-items.checkexpiry')}}",
                    data:{'_token': CSRF_TOKEN, 'strDate': strDate, 'arrItems': arrItems},
                    success:function(data){
                        if(data=="")
                        {
                            $(objParent).find(".print-error-msg").find("ul").html('');
                            $(objParent).find(".print-error-msg").css('display','none');
                        }
                        else {
                            $(objParent).find(".print-error-msg").find("ul").html('');
                            $(objParent).find(".print-error-msg").css('display','block');
                            $(objParent).find(".print-error-msg").find("ul").append('<li>'+data+'</li>');
                        }
                    }
                });
            }
        });*/

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

    var totalprice = 0;
    var modalid = "";
    var prevprice = '';
    var this_form_id = '';
    $(document).ready(function() {
        //set initial state.
        // $('#textbox1').val(this.checked);

        $('.menutitle').click(function()
        {

            modalid = $(this).attr('data-bs-target');
            totalprice = 0;
            totalpriceTemp = Number($(modalid).find('.totalprice').val());
            tempmenuid =  Number($(modalid).find('.menuidhidden').val());
            this_form_id = "#frm-"+tempmenuid;
            console.log(this_form_id);
            if(totalpriceTemp>0)
            {
                totalprice = Number(totalpriceTemp);
            }
            prevprice = '';
            //modalid = $(tempid).attr('id');
        });

        $('.frmsubmit').click(function(e){
            e.preventDefault();
            form = document.querySelector(this_form_id);
            $.ajax({
                type:'POST',
                url:"{{route('menu-items.store')}}",
                data:new FormData(form),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    if($.isEmptyObject(data.error)){
                            /*Swal.fire({
                                text: data.success,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-danger"
                                }
                            })*/
                        //form.reset();
                        $(modalid).modal('hide')
						setTimeout(function(){// wait for 5 secs(2)
						   location.reload(); // then reload the page.(3)
					  }, 500);
                    }
                    else{
                        printErrorMsg(data.error);
                    }
                }
            });
            $("#loader-save").css("display", "none")
        });

        function printErrorMsg (msg) {
            $(modalid).find(".print-error-msg").find("ul").html('');
            $(modalid).find(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(modalid).find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        $('.items-checkbox').change(function() {
            var items_add = $(this).val();
            if(this.checked) {
                var temp_img = 'images/no-image.png';
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // items_id = $(this).val();
                $.ajax({
                    /* the route pointing to the post function */
                    url: 'items/fetch/ajax',
                    type: 'get',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN,items_add},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        if(data.image != null){
                            temp_img = data.image;
                        }
                        $(modalid).find('.display-items').append(`
                            <tr class=" item-box-${data.id}">
                                <td>
                                    <div class="d-flex flex-row align-items-center">
                                        <div>
                                            <img src="${temp_img}" class="img-fluid rounded-3" alt="Pizza" style="max-width: 65px;min-width:65px">
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
                                    <input type="hidden" name="item_total[]" class="item-total-hidden" id="item-total-hidden-${data.id}" value="${(Number(data.price))}" />
                                </td>
                                <td>
                                    <p id="item-price-${data.id}">&euro;${data.price ? Number(data.price).toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00'}</p>
                                </td>

                                <td>
                                    <p class="item-total-${data.id}">&euro;${data.price ? Number(data.price).toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00'}</p>
                                </td>
                                <td>
                                    <a href="#" onclick="removeItem(${data.id})"  style="color: #ff0066 !mportant;"><i class="fas fa-trash-alt text-danger"></i></a>
                                </td>
                            </tr>`);
                        //totalprice += Number((data.tax/100)*data.price) + Number(data.price);
                        totalprice += Number(data.price); //Remove taxes from item prices. Tax will be calculated as sales tax on customer end
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
        var itemtTotal = 0;
        $(modalid).find('.item-total-hidden').each(function(index,item)
        {
            if($(item).attr('id')=='item-total-hidden-'+id)
            {
                itemTotal = Number($(item).val());
            }
        });
        //var itemTotal = Number($('#item-total-hidden-'+id).val());
        totalprice = $(modalid).find('.totalprice').val();
        console.log(totalprice);
        totalprice -= itemTotal;
        totalprice = Math.abs(totalprice);
        updateTotalPrice(totalprice);
        $(modalid).find('.item-box-'+id).remove();
        $(modalid).find("#item-"+id).prop("checked", false);
    }

    function updateQty(id,qty){
        console.log(totalprice)
        var itemTotal = Number($('#item-total-hidden-'+id).val());
        console.log(itemTotal);
        totalprice -= itemTotal;
        console.log(totalprice);
        totalprice = Math.abs(totalprice);
        var tax = Number($('#tax-hidden-'+id).val());
        var price = Number($('#price-hidden-'+id).val());
        var total_temp = ((price) * qty);
        $('.item-total-'+id).text(total_temp.toFixed(2));
        $('#item-total-hidden-'+id).val(total_temp);
        totalprice += total_temp;
        updateTotalPrice(totalprice);
    }

    function updateTotalPrice(totalprice){
        console.log(totalprice);
        $(modalid).find('.totalprice').val(totalprice.toFixed(2));
    }

    $('input[type=radio][name=price_type]').change(function() {
        if (this.value == 'sum') {
            //$('#totalprice').val(totalprice.toFixed(2));
            prevprice = $(modalid).find('.totalprice').val();
            var tempprice = 0;
            $(modalid).find('.item-total-hidden').each(function(index,item)
            {
                console.log($(item).val());
                tempprice = tempprice + Number($(item).val());
            });
            //$(modalid).find('.totalprice').val(totalprice.toFixed(2));
            $(modalid).find('.totalprice').val(tempprice.toFixed(2));
        }
        else if (this.value == 'manual') {
            //$('#totalprice').val('');
            $(modalid).find('.totalprice').val(prevprice);
        }
    });
</script>
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



@endpush


@endsection
