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
	  <h3 class="fw-bolder m-0">Edit Cuisine</h3>
	</div>
	<div class="card-body">
		<form action="{{route('cuisines.update',$data->id)}}" method="post" enctype="multipart/form-data">
			@csrf
			@method("PUT")
			<div class="row">
			 <div class="col-md-6 my-3">
				 <label class="required fw-bold fs-6 mb-2">Cuisine Title</label>
				 <input type="text" class="form-control" name="title" placeholder="Enter Cuisine Title" value="{{$data->title}}">
			 </div>
			<div class="col-md-6 my-3">
				 <label class="required fw-bold fs-6 mb-2">Category Status</label>
				 <select class="form-select" name="status">
				  <option value="1" {{ $data->status==1 ? 'selected' : '' }}>Publish</option>
				  <option value="0" {{ $data->status==0 ? 'selected' : '' }}>UnPublish</option>
				</select>
			 </div>
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>
</div>


@endsection