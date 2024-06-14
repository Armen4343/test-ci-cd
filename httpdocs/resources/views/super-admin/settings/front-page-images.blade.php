@extends('layouts.super-admin.master')

@section('super-admin')
<div class="card p-3">

<div class="card-header align-items-center border-0 bg-dark">
  <!--begin::Title-->
  <h3 class="fw-bolder text-white m-0">Front page images</h3>
  <!--end::Title-->
  </div>
	<div class="card-body">
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="card">

						<div class="card-body p-0">
							@if(session('success'))
								<div class="alert alert-success">
									{{ session('success') }}
								</div>
							@endif
							@if($errors->any())
								{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
							@endif

							<!-- Display Images -->
							<div class="mb-4">
								<form method="POST" action="{{ route('super.admin.front.page.images.save') }}" enctype="multipart/form-data">
									@csrf
								<h2>Images</h2>
								<div class="row">
									<div class="col-md-3">
										   <img src="{{ !empty($images->image1) ? asset($images->image1) : asset('assets/media/blank.jpg') }}" alt="Image 1" class="img-thumbnail w-100" style="height:180px">
										<div class="form-group my-2">
										<label for="image1">Image1_1000x1171</label>
										<input type="file" class="form-control" name="image1">
									</div>
									</div>
									<div class="col-md-3">
										 <img src="{{ !empty($images->image2) ? asset($images->image2) : asset('assets/media/blank.jpg') }}" alt="Image 1" class="img-thumbnail  w-100" style="height:180px" >
										<div class="form-group my-2">
											<label for="image2">Image2_1000x664</label>
											<input type="file" class="form-control" name="image2">
										</div>
									</div>
									<div class="col-md-3">
										 <img src="{{ !empty($images->image3) ? asset($images->image3) : asset('assets/media/blank.jpg') }}" alt="Image 1" class="img-thumbnail  w-100" style="height:180px">
										<div class="form-group my-2">
											<label for="image3">Image3_1366_x_405</label>
											<input type="file" class="form-control" name="image3">
										</div>
									</div>
									<div class="col-md-3">
									 <img src="{{ !empty($images->image4) ? asset($images->image4) : asset('assets/media/blank.jpg') }}" alt="Image 1" class="img-thumbnail  w-100" style="height:180px">
										<div class="form-group my-2">
											<label for="image4">Image4_1366x470</label>
											<input type="file" class="form-control" name="image4">
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary">Update Images</button>
								</form>
							</div>
							
						</div>
					</div>
				</div>
		</div>
	</div>
       
</div>
@endsection