@extends('layouts.super-admin.master')

@section('super-admin')

    <div class="row">


        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Super users
                </h3>
                <div class="my-auto">
                <a href="{{ route('super.user.index') }}" class="btn btn-success"> <span> <i class="fa fa-wrench"></i> </span> Manage super user </a>

                </div>

            </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation" action="{{ url('super-admin/customer/update/'.$user->id) }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="{{ $user->profile_photo_path}}">
                    @csrf
            <input type="hidden" name="role" value="superadmin">
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label required">Name </label>
                  <input type="text" class="form-control" name="name"  value="{{ $user->name }}">
                  @error ('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <span class="text-danger name-error" style="display:none;">The name is required</span>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label required">Username/Email </label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    @error ('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    
                  <span class="text-danger email-error" style="display:none;">Please enter an valid email</span>
                </div>
                <div class="col-md-12">
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
                                <input class="form-control " type="text" placeholder="" name="new_password" autocomplete="off" />

                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>

                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                            </div>
                            <!--end::Input wrapper-->

                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
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
                    
                <label class="form-label fw-bold fs-6 mb-2 ">Profile image</label>
                <br>
                    <!--begin::Image input-->
<div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ $user->profile_photo_path ? $user->profile_photo_path : '/assets/media/svg/avatars/blank.svg' }})">
                          
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px"></div>
                                <!--end::Image preview wrapper-->
                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
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
                            <input class="form-check-input" type="radio" value="active" name="status" {{ $user->status == 'active' ? 'checked="checked"' : ''}}/>
                            <label class="form-check-label" for="flexRadioChecked">
                                Active
                            </label> &nbsp;
                            <input class="form-check-input" type="radio" value="disable" name="status" {{ $user->status == 'disable' ? 'checked="checked"' : ''}} />
                            <label class="form-check-label" for="flexRadioChecked">
                                Disable
                            </label>
                        </div>
                    </div>
                       
                <div class="m-3 float-end">
                    
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <!--begin::Actions-->
                        <button type="submit"  name="btn-update" value="Submit" class="btn btn-primary">
                            <span class="indicator-label">
                               Update
                            </span>
                        </button>
                        <!--end::Actions-->
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>

@endsection
