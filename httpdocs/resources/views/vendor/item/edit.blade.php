@extends('layouts.vendor.master')

@section('vendor')
    <style>
        .preview-img {
            position: relative;
        }

        .preview-img i {
            position: absolute;
            right: 5px;
            font-size: 20px;
            color: #ff0066;
            cursor: pointer;
        }
    </style>
    <div class="card mb-3">
        <div class="card-header align-items-center">
            <h3 class="fw-bolder m-0">Prodotti Listati</h3>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $Categories = \App\Models\Category::where(['status' => '1'])->get();
                $cuisines = \App\Models\Cuisine::where(['status' => '1', 'vendor_id' => Auth::user()->id])->get();
                $dishes = \App\Models\Dish::where(['status' => '1'])->get();
                $days=[1,2,3,4,5,6,7,8,9,10];
            @endphp
            <form action="{{ route('items.update',$data->id) }}" method="post" enctype="multipart/form-data"
                  id="editItemForm">
                @csrf
                @method("PUT")
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="row">
                    <div class="col-md-12 my-3">
                        <label class="required fw-bold fs-6 mb-2">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}"
                               placeholder="Burger and Fries">
                    </div>
                    <div class="col-md-6 my-3">
                        <label class="required fw-bold fs-6 mb-2">Seleziona Categoria</label>
                        <div class="row">
                            @foreach($Categories as $Category)
                                <div class="col-md-6">
                                    <div class="form-check form-check-danger form-check-solid form-check-custom mb-2">
                                        <input class="form-check-input" type="radio" value="{{ $Category->id }}"
                                               name="category" {{ ($data->category_id == $Category->id) ? 'checked' : '' }}/>
                                        <label class="form-check-label" for="flexRadioDefault">
                                            {{ $Category->title }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6 my-3">
                       <!--elisa <label class="fw-bold fs-6 mb-2">Seleziona SottoCategoria</label>

                        <div class="row">
                            @foreach($cuisines as $dish_catgory)

                                <div class="col-md-6">
                                    <div class="form-check form-check-danger form-check-solid form-check-custom mb-2">
                                        <input class="form-check-input" type="radio" value="{{ $dish_catgory->id }}"
                                               name="cuisine_type" {{ ($data->cuisine_id == $dish_catgory->id) ? 'checked' : '' }}/>
                                        <label class="form-check-label" for="flexRadioDefault">
                                            {{ $dish_catgory->title }}
                                        </label>
                                    </div>
                                </div> 

                            @endforeach
                        </div> elisa-->

                    </div>
                    <div class="col-md-6 my-3">
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Descrizione</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <textarea name="description" class="form-control " rows="4"
                                      placeholder="Scrivi una breve descrizione del tuo prodotto...">{{ $data->description }}</textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col-md-6 my-3">
                        <label class="fw-bold fs-6 mb-2"> Immagine (500*500)</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*"
                               onchange="loadFile(event)">
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label class="fw-bold fs-6 mb-2">Immagine corrente</label>
                                <img src="{{ asset(($data->image) ? $data->image : 'images/no-image.png') }}"
                                     class="img w-100 rounded-1"
                                     style="height:200px; object-fit:cover;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"/>


                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold fs-6 mb-2">Nuova immagine</label>
                                <div class="preview-img d-none" id="preview-img">
                                    <img id="output" class="img w-100 rounded-1"
                                         style="height:200px; object-fit:cover;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"/>
                                    <i class="fas fa-times" id="remove-preview"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-3">

                        @php
                            $chkw = $data->alergen_info;
                            $chkecked = explode(',',$chkw);
                        @endphp
                        <label class="fw-bold fs-6 mb-2">Allergeni</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Sedano"
                                           <?php if (in_array('Sedano', $chkecked)){ ?> checked="checked" <?php } ?> />
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Sedano
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Glutine"
                                           <?php if (in_array('Glutine', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Glutine
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Crostacei"
                                           <?php if (in_array('Crostacei', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Crostacei
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Uova"
                                           <?php if (in_array('Uova', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Uova
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Pesce"
                                           <?php if (in_array('Pesce', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Pesce
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Lupini"
                                           <?php if (in_array('Lupini', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Lupini
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Latte"
                                           <?php if (in_array('Latte', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Latte
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Molluschi"
                                           <?php if (in_array('Molluschi', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Molluschi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Mostarda"
                                           <?php if (in_array('Mostarda', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Mostarda
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Noci e Nocciole"
                                           <?php if (in_array('Noci e Nocciole', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Noci e Nocciole
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Arachidi"
                                           <?php if (in_array('Arachidi', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Arachidi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Sesamo"
                                           <?php if (in_array('Sesamo', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Sesamo
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Soya"
                                           <?php if (in_array('Soya', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Soya
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="alergen_info[]"
                                           value="Solfiti"
                                           <?php if (in_array('Solfiti', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Solfiti
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-3">
                        <label class="required fw-bold fs-6 mb-2">Status</label>
                        <select class="form-select" name="menu_status" id="status">
                            <option value="1" {{ ($data->menu_status == '1') ? 'selected' : '' }}>Pubblicato</option>
                            <option value="0" {{ ($data->menu_status == '0') ? 'selected' : '' }}>Non Pubblicato</option>
                        </select>
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
                            <div class="d-flex align-items-start justify-content-center mb-7" style="color: #ff0066;">
                                <span class="fw-bolder fs-4 mt-1 me-2">€</span>
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
                        <input type="text" class="form-control" id="price-input" onkeyup="calculatePrice(event)"
                               onkeypress="return isNumberKey(this, event);">
                    </div>

                    <div class="col-md-12 mt-3 mb-5">
                        <label class="fw-bold fs-6 mb-2">Sconto (%)</label>
                        <input type="number" class="form-control" name="discount" value="{{ $data->discount }}"
                               id="discount" placeholder="25%" onkeyup="calculateEditPrice(event)" oninput="this.value =
 !!this.value && Math.abs(this.value) >= 0 && Math.abs(this.value) <= 95 ? Math.abs(this.value) : null">
                    </div>
                    <div class="col-md-6 mt-3 mb-5" style="display: none;">
                        <div class="form-check form-check-danger form-check-solid form-check-custom mb-3">

                            <input class="form-check-input" type="radio" value="local" id="flexCheckDefault"
                                   name="tax_type" checked="checked"/>
                            <label class="form-check-label pe-3" for="flexCheckDefault">
                                Inherit Local Tax
                            </label>
                        </div>
                        <div class="mb-5" id="local-tax-box">
                            @php $state =  \App\Models\Tax::where(['state' => Auth::user()->state])->first();
																	$spTaxes =  \App\Models\SpecialTax::where(['vendor_id' => Auth::user()->id])->get();
                            @endphp
                            @if($state)
                                <input name="local-tax" id="local-tax" class="form-control" value="{{ $state->tax}}"
                                       readonly/>
                                <input type="hidden" name="tax" value="{{ $state->tax}}" id="tax">
                            @else
                                <input name="local-tax" class="form-control" value="0" readonly/>
                                <input type="hidden" name="tax" value="0" id="tax">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 mt-3 mb-5" style="display: none;">
                        <div class="form-check form-check-danger form-check-solid form-check-custom mb-3">

                            <input class="form-check-input" type="radio" value="special" id="special-tax-input"
                                   name="tax_type"/>
                            <label class="form-check-label pe-3" for="flexCheckDefault">
                                Special Tax
                            </label>
                        </div>
                        <div class="mb-5" style="display:none;" id="special-tax-box">
                            <select class="form-select" name="tax1" id="special-tax"
                                    onChange="changeTax(this.options[this.selectedIndex].value)">
                                <option value="0"> Choose one</option>
                                @foreach($spTaxes as $spTax)
                                    <option value="{{$spTax->value}}">{{$spTax->title}} ({{$spTax->value}}%)</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6 mb-3" style="visibility:hidden">
                        <label class="form-label pe-3" for="flexCheckDefault">
                            Is tax included in this item price?
                        </label>
                        <div class="form-check form-check-danger form-check-solid form-check-custom mb-3">

                            <input class="form-check-input" type="radio" value="0" name="tax_included"
                                   checked="checked" {{ ($data->tax_included == '0') ? 'checked' : '' }}/>
                            <label class="form-check-label pe-3">
                                No
                            </label>

                            <input class="form-check-input" type="radio" value="1" name="tax_included"
                                   {{ ($data->tax_included == '1') ? 'checked' : '' }} checked="true"/>
                            <label class="form-check-label pe-3">
                                Yes
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div><b>Prezzo:</b> <span id="price-output" style="color: #ff0066;"></span></div>
                        <div><b>Sconto:</b> <span id="discount-output" style="color: #ff0066;"></span></div>
                        <div style="display:none;"><b>Tax:</b> <span id="tax-output" style="color: #ff0066;"></span>
                        </div>
                        <hr class="my-3"/>
                        <h3><b>Prezzo Scontato:</b> <span id="sale-price" style="color: #ff0066;"></span></h3>

                    </div>

                    <div class="col-md-6 my-3">
                        <label class="required fs-6 fw-bold mb-2">Durata Offerta</label>
                        <div class="mb-0">
                            <input class="form-control " name="date_range" placeholder="Pick date rage"
                                   id="kt_daterangepicker_1" value="{{ $data->date_range }}"/>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 mb-5">
                        <label class="required fw-bold fs-6 mb-2">Quantita'</label>
                        <input type="number" class="form-control" name="quantity" value="{{ $data->quantity }}"
                               id="quantity" placeholder="12" oninput="this.value =
 !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                    </div>

                    <div class="col-md-6 mt-3 mb-5">
                        <label class="required fw-bold fs-6 mb-2">Promozione</label>

                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="radio" name="promo"
                                   value="Scadenza breve" {{ ($data->promo == 'Scadenza breve') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchDefault">
                                Scadenza breve
                            </label>
                        </div>
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="radio" name="promo"
                                   value="Extra stock" {{ ($data->promo == 'Extra stock') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchDefault">
                                Extra stock
                            </label>
                        </div>
                        <div class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                            <input class="form-check-input h-20px w-30px" type="radio" name="promo"
                                   value="Promozione" {{ ($data->promo == 'Promozione') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchDefault">
                                Promozione
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 mb-5">
                        <label class="fw-bold fs-6 mb-2">Data Scadenza</label>
                        <input class="form-control" type="date" name="expire_date" value="{{ $data->expire_date }}"/>
                    </div>

                    <div class="col-md-12 mt-3 mb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold fs-6 mb-2">Orario da</label>
                                <div class="input-group date">
                                    <input class="form-control" type="text" name="time_range_from" id="timeInput"
                                           maxlength="5"
                                           value="{{ $data->time_range ? explode('-', $data->time_range)[0] : '' }}"
                                           pattern="(?:[01]\d|2[0-3]):[0-5]\d">
                                    <span class="input-group-addon">
                                        <i class="fa-regular fa-clock"></i>
                                    </span>
                                </div>
                                {{--                                <input class="form-control"--}}
                                {{--                                       value="{{ $data->time_range ? explode('-', $data->time_range)[0] : '' }}"--}}
                                {{--                                       type="time" name="time_range_from"/>--}}
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold fs-6 mb-2">Fino a</label>
                                <div class="input-group date">
                                    <input class="form-control" type="text" name="time_range_to" id="timeInput"
                                           maxlength="5"
                                           value="{{ $data->time_range ? explode('-', $data->time_range)[1] : '' }}"
                                           pattern="(?:[01]\d|2[0-3]):[0-5]\d">
                                    <span class="input-group-addon">
    <i class="fa-regular fa-clock"></i>
                                    </span>
                                </div>
                                {{--                                <input value="{{ $data->time_range ? explode('-', $data->time_range)[1] : '' }}"--}}
                                {{--                                       class="form-control" type="time" name="time_range_to"/>--}}
                            </div>
                        </div>
                    </div>
                    @php
                        $chkw = $data->promo_days;
                        $chkecked = explode(',',$chkw);
                    @endphp
                    <div class="col-12 my-3">
                        <label class="fw-bold fs-6 mb-2">Giorni Offerta</label>
                        <div class="row">
                            <div class="col-md-3">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]"
                                           value="Lunedi"
                                           <?php if (in_array('Lunedi', $chkecked)){ ?> checked="checked" <?php } ?> />
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Lunedi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]"
                                           value="Martedì"
                                           <?php if (in_array('Martedì', $chkecked)){ ?> checked="checked" <?php } ?> />
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Martedì
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]"
                                           value="Mercoledì"
                                           <?php if (in_array('Mercoledì', $chkecked)){ ?> checked="checked" <?php } ?> />
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Mercoledì
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]"
                                           value="Giovedì"
                                           <?php if (in_array('Giovedì', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Giovedì
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]"
                                           value="Venerdì"
                                           <?php if (in_array('Venerdì', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Venerdì
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]"
                                           value="Sabato"
                                           <?php if (in_array('Sabato', $chkecked)){ ?> checked="checked" <?php } ?>/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Sabato
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="form-check form-switch form-check-danger form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input h-20px w-30px" type="checkbox" name="promo_days[]"
                                           value="Domenica"
                                           <?php if (in_array('Domenica', $chkecked)){ ?> checked="checked" <?php } ?> />
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Domenica
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php /*<hr class="my-5"/>*/ ?>
                    <div class="col-md-12 my-3" style="display:none; visibility: hidden;">
                        <label class="required fw-bold fs-6 mb-2">Inventory</label>
                    </div>
                    <div class="col-md-6 my-3" style="display:none; visibility: hidden;">
                        <div class="form-check form-check-danger form-check-solid form-check-custom">
                            <input class="form-check-input" type="radio" value="yes"
                                   {{ ($data->availability == 'yes') ? 'checked' : '' }} id="flexCheckDefault"
                                   name="availability"/>
                            <label class="form-check-label" for="flexCheckDefault">
                                In Stock
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 my-3" style="display:none; visibility: hidden;">
                        <div class="form-check form-check-danger form-check-solid form-check-custom">
                            <input class="form-check-input" type="radio" value="no"
                                   {{ ($data->availability == 'no') ? 'checked' : '' }} id="flexCheckDefault"
                                   name="availability"/>
                            <label class="form-check-label" for="flexCheckDefault">
                                Non disponibile
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-danger rounded-0">Cancella</a>
                    <button type="submit" class="btn btn-dark rounded-0" id="addCategory-btn">
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
    @push("vendor-scripts")

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
            $('[name="time_range_from"]').datetimepicker({
                format: 'HH:mm',
            });

            $('[name="time_range_to"]').datetimepicker({
                format: 'HH:mm'
            });

            document.getElementById('timeInput').addEventListener('input', function () {
                var input = this;
                var regex = /^(?:[01]\d|2[0-3]):[0-5]\d$/;

                if (!regex.test(input.value)) {
                    input.setCustomValidity('Invalid time format (HH:MM)');
                } else {
                    input.setCustomValidity('');
                }
            });

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
            $("#remove-preview").click(function () {
                previewContainer.addClass("d-none")
                $('#image').val("");
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
                //salePrice=totalPrice+Number(percentage(tax, totalPrice))
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
    @endpush

@endsection
