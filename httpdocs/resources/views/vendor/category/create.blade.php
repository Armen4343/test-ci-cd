@extends('layouts.vendor.master')

@section('vendor')
  <div class="card mb-3">

<div class="card-header align-items-center">
  <!--begin::Title-->
  <h3 class="fw-bolder m-0">Add Category</h3>
  <!--end::Title-->
  </div>

 <form action="{{route('dish-categories.store')}}" method="post">
	 @csrf
     <div class="row">
		 <div class="col-md-6  my-3">
			 <label class="required fw-bold fs-6 mb-2">Category Title</label>
			 <input type="text" class="form-control" name="title" value="Enter Category Title" required>
		 </div>
      </div>
	 <button type="submit" class="btn btn-dark rounded-0  d-block mt-2"><i class="fas fa-save"></i>Save</button>
</form>
       
</div>
@endsection
