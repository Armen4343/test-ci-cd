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
<div class="card mb-3">
	<div class="card-header align-items-center">
	  <h3 class="fw-bolder m-0">Modifica Profilo</h3>
	</div>
	<div class="card-body">
		<form action="{{route('vendor.profile.update')}}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="old_logo" value="{{ Auth::user()->profile_photo_path}}">
			<input type="hidden" name="old_banner" value="{{ Auth::user()->banner_photo_path}}">
			@csrf
			<div class="row">
			 <div class="col-md-6 my-3">
				 <h5 class="required fw-bold fs-6 mb-3">Logo</h5>
				 
				   <!--begin::Image input-->
                    <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ Auth::user()->profile_photo_path ?  Auth::user()->profile_photo_path : '/assets/media/svg/avatars/blank.svg' }})">

                          <a class="confirmDeleteAnchor" href="{{ route('vendor.profile.image.remove', ['key'=> 'profile_photo_path']) }}" title="Rimuovi"><i class="fa fa-times text-danger fa-2x px-1 bg-light rounded-circle" style=" margin: -14px; "></i></a>
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-225px h-225px"></div>
                                <!--end::Image preview wrapper-->
                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Cambia Immangine">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <!--begin::Inputs-->
                                <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
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
				 
			 </div>
				<div class="col-md-6 my-3">
				 <h5 class="required fw-bold fs-6 mb-3">Immagine Banner</h5>
					 <!--begin::Image input-->
					
                        <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ Auth::user()->banner_photo_path ?  Auth::user()->banner_photo_path : '/assets/media/svg/avatars/blank.svg' }})">
                          
					 <a  class="confirmDeleteAnchor" href="{{ route('vendor.profile.image.remove', ['key'=> 'banner_photo_path']) }}"  title="Rimuovi"><i class="fa fa-times text-danger fa-2x px-1 bg-light rounded-circle " style=" margin: -14px; " ></i></a>
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-225px h-225px"></div>
                                <!--end::Image preview wrapper-->
                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Cambia Immagine">
                                <i class="bi bi-pencil-fill fs-7"></i>

                                <!--begin::Inputs-->
                                <input type="file" name="banner" accept=".png, .jpg, .jpeg" />
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
			 </div>
			</div>
			<button type="submit" class="btn btn-primary">Aggiorna</button>
		</form>
		
		
	</div>
</div>
<script>
	  function checkPhone(phone) 
		{
			  var PATTERN = "[+]{1}[0-1]{1}-[0-9]{3}-[0-9]{3}-[0-9]{4}";

				if (phone.match(PATTERN)) {
				document.getElementById('phone-error').innerHTML = "";
					return (true)
					
				}
				else{
				document.getElementById('phone-error').innerHTML = "Please follow this format (e.g: +1-000-000-0000)";
					return (false)
				}
	}
</script>

@endsection
