@extends('layouts.super-admin.master')

@section('super-admin')

    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add {{ $role }}
                    </h3>
                    <div class="my-auto"></div>
                    <div class="card-body">
                        <div class="">
                            <form class="row g-3  form" action="{{ route('store.user') }}" method="post"
                                  name="super-user" id="super-user" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <input type="hidden" name="role" value="{{ $role }}">
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label required">Name </label>
                                    <input type="text" class="form-control" name="name">
                                    @error ('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger name-error"
                                          style="display:none;">The name is required</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label required">Username/Email </label>
                                    <input type="email" class="form-control" name="email">
                                    @error ('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <span class="text-danger email-error" style="display:none;">Please enter an valid email</span>
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                                        <!--begin::Wrapper-->
                                        <div class="mb-1">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold fs-6 mb-2 required">
                                                New Password
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input wrapper-->
                                            <div class="position-relative mb-3">
                                                <input class="form-control " type="password" placeholder=""
                                                       name="new_password" autocomplete="off"/>

                                                <span
                                                    class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                    data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>

                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                                            </div>
                                            <!--end::Input wrapper-->

                                            <!--begin::Meter-->
                                            <div class="d-flex align-items-center mb-3"
                                                 data-kt-password-meter-control="highlight">
                                                <div
                                                    class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div
                                                    class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div
                                                    class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div
                                                    class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                            </div>
                                            <!--end::Meter-->
                                        </div>
                                        <!--end::Wrapper-->

                                        <!--begin::Hint-->
                                        <div class="text-muted">
                                            Use 8 or more characters with a mix of letters, numbers & symbols.
                                        </div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Input group--->


                                    @error ('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input group--->
                                    <div class="fv-row mb-10">
                                        <label class="form-label fw-bold fs-6 mb-2 required">Confirm New
                                            Password</label>

                                        <input class="form-control " type="password" placeholder=""
                                               name="confirm_password" autocomplete="off"/>
                                    </div>
                                    <!--end::Input group--->
                                </div>

                                @if($role === 'vendor')
                                    <div class="col-md-12 my-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="company_name" class="required form-label">Nome e Cognome, o Denominazione Sociale</label>
                                                <input type="text" placeholder="Nome e Cognome, o Denominazione Sociale "
                                                       oninput="this.className = 'form-control'" class="form-control" name="company_name">
                                                <span class="text-danger company-name-error"
                                                      style="display: none;">È richiesto il Nome e Cognome, o Denominazione Sociale</span>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="tax_id" class="required form-label">Codice Fiscale</label>
                                                <input
                                                    type="text"
                                                    name="tax_id"
                                                    placeholder="MRTMTT91D08F205J"
                                                    class="form-control"
                                                    maxlength="16"
                                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                >
                                                <span class="text-danger tax-id-error"
                                                      style="display: none;">È richiesto il codice fiscale</span>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="vat_number" class="form-label">Partita IVA</label>
                                                <input
                                                    type="number"
                                                    name="vat_number"
                                                    class="form-control"
                                                    placeholder="07643520567"
                                                    maxlength="11"
                                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);this.value = !!this.value && this.value < 0 ? this.value * -1 : this.value"
                                                >
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label for="sdi_code" class="form-label">Codice SDI</label>
                                                <input
                                                    type="text"
                                                    name="sdi_code"
                                                    placeholder="Codice SDI"
                                                    class="form-control"
                                                >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="pec" class="required form-label">PEC</label>
                                                <input
                                                    type="email"
                                                    name="pec"
                                                    placeholder="PEC"
                                                    class="form-control"
                                                    onkeyup="checkEmail(this.value, false)"
                                                >
                                                <span class="text-danger pec-error" style="display:none;">Please enter an valid email</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6">

                                    <label class="form-label fw-bold fs-6 mb-2 ">Profile image</label>
                                    <br>
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-empty" data-kt-image-input="true"
                                         style="background-image: url(/assets/media/svg/avatars/blank.svg)">

                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                        <!--end::Image preview wrapper-->
                                        <!--begin::Edit button-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                            <input type="hidden" name="avatar_remove"/>
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                    @error ('user_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-5">
                                    <div class="form-group">
                                        <div class="form-label">Status</div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="active" name="status"
                                                    {{$role === 'customer' ? 'checked="checked"' : ''}} />
                                            <label class="form-check-label" for="flexRadioChecked">
                                                Active
                                            </label> &nbsp;
                                            <input class="form-check-input" type="radio" value="disable" name="status"
                                                    {{$role === 'vendor' ? 'checked="checked"' : ''}} />
                                            <label class="form-check-label" for="flexRadioChecked">
                                                Disable
                                            </label>
                                        </div>
                                    </div>

                                    <div class="m-3 float-end">

                                        <a href="{{ url()->previous() }}" class="btn btn-light">Close</a>
                                        <!--begin::Actions-->
                                        <button type="button" id="btn-submit" name="btn-submit" value="Submit"
                                                class="btn btn-primary">
                            <span class="indicator-label">
                               Submit
                            </span>
                                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                                        </button>
                                        <!--end::Actions-->
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
