@extends('layouts.vendor.master')

@section('vendor')
  <div class="card p-3">

<div class="card-header align-items-center border-0 bg-dark">
  <!--begin::Title-->
  <h3 class="fw-bolder text-white m-0">Add Dish</h3>
  <!--end::Title-->
  </div>

 <form action="{{route('dishes.store')}}" method="post">
	 @csrf
     <div class="row">
		 <div class="col-md-6  my-3">
			 <label class="required fw-bold fs-6 mb-2">Dish Name</label>
			 <input type="text" class="form-control" name="name" value="Enter Dish Name" required>
		 </div>
		 <div class="col-md-6  my-3">
			 <label class="fw-bold fs-6 mb-2">Dish Image(500*500)</label>
			 <input type="file" class="form-control" name="image" required>
		 </div>
		 <div class="col-md-6  my-3">
			 <label class="required fw-bold fs-6 mb-2">Dish Category</label>
			 <select class="form-select" name="category">
			  <option selected>Select Dish Category</option>
			  <option value="1">One</option>
			  <option value="2">Two</option>
			  <option value="3">Three</option>
			</select>
		 </div>
		 <div class="col-md-6  my-3">
			 <label class="required fw-bold fs-6 mb-2">Dish Status</label>
			 <select class="form-select" name="status">
			  <option selected>Select Dish Status</option>
			  <option value="1">Publish</option>
			  <option value="2">UnPublish</option>
			</select>
		 </div>
		 <div class="col-md-6  my-3">
			 <label class="required fw-bold fs-6 mb-2">Dish Price</label>
			 <input type="number" class="form-control" name="price" value="Enter Dish Price" required>
		 </div>
		 <div class="col-md-12  my-3">
			 <label class="fw-bold fs-6 mb-2">Dish Description</label>
			 <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
		 </div>
      </div>
	 <button type="submit" class="btn btn-success  d-block mt-2"><i class="fas fa-save"></i>Save</button>
</form>
       
</div>
@endsection
