@extends('layouts.super-admin.master')

@section('super-admin')
<div class="card p-3">

<div class="card-header align-items-center border-0 bg-dark">
  <!--begin::Title-->
  <h3 class="fw-bolder text-white m-0">Home Page Popup banner Settings</h3>
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
								<form method="POST" action="{{ route('super.admin.popup.banner.save') }}" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-md-6 my-2">
											<div class="form-group">
												<label for="title">Title:</label>
												<input type="text" name="title" id="title" class="form-control" required
													   value="{{ old('title', $PopupBanner->title) }}" maxlength="50">
											</div>
										</div>
										<div class="col-md-6 my-2">
											<div class="form-group">
												<label for="description">Description:</label>
												<textarea name="description" id="description" class="form-control" required>{{ old('description', $PopupBanner->description) }}</textarea>
											</div>
										</div>
										<div class="col-md-6 my-2">
											<div class="form-group">
												<label for="url">URL:</label>
												<input type="text" name="url" id="url" class="form-control" required
													   value="{{ old('url', $PopupBanner->url) }}" >
											</div>
										</div>
										<div class="col-md-6 my-2">
											<div class="form-group">
												<label for="discount_code">Discount Code:</label>
												<input type="text" name="discount_code" id="discount_code" class="form-control"
													   value="{{ old('discount_code', $PopupBanner->discount_code) }}" style="color:#ff0066;font-weight:800;font-family:monospace;letter-spacing:0.1em;font-size:2em;text-transform:uppercase;">
											</div>
										</div>
										<div class="col-md-6 my-2">
											<div class="form-group">
												<label for="image">Image 733 x 853</label>
												<input type="file" name="image" id="image" class="form-control" >
												 <!-- Display Old Image If Available -->
														@if ($PopupBanner->image)
															<img src="{{ asset($PopupBanner->image) }}" class="img img-thumbnail mt-1" alt="Old Image" style="max-height:150px">
														@endif
											</div>
										</div>
										<div class="col-md-6 my-2">
											<div class="form-group">
												<label for="is_active">Popup Control:</label><br/>
												<input type="radio" name="is_active" value="1" class="form-radio-input"
													   {{ old('is_active', $PopupBanner->is_active) == 1 ? 'checked' : '' }} >
												<span class="me-1">Enabled</span>
												<input type="radio" name="is_active" value="0" class="form-radio-input"
													   {{ old('is_active', $PopupBanner->is_active) == 0 ? 'checked' : '' }}>
													   
												<span class="me-1">Disabled</span>
											</div>
										</div>
									</div>

									<button type="submit" class="btn btn-primary">Save</button>
								</form>
							</div>
							
						</div>
					</div>
				</div>
		</div>
	</div>
       
</div>
@endsection