@extends('layouts.super-admin.master')

@section('super-admin')

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
	  <h3 class="fw-bolder m-0">Edit Sales Tax</h3>
	</div>
	<div class="card-body">
		<form action="{{route('taxes.update',$data->id)}}" method="post" enctype="multipart/form-data">
			@csrf
			@method("PUT")
			<div class="row">
			 <div class="col-md-6 my-3">
				 <label class="required fw-bold fs-6 mb-2">Tax State</label>
				 <input type="text" class="form-control" name="state" placeholder="Enter Tax State" value="{{$data->state}}">
			 </div>
			 <div class="col-md-6 my-3">
				  <label class="required fw-bold fs-6 mb-2">Tax Value</label>
				 <input type="text" class="form-control" name="tax" placeholder="Enter Tax Value" value="{{$data->tax}}" oninput="this.value = 
 !!this.value && Math.abs(this.value) >= 0 && Math.abs(this.value) <= 99 ? Math.abs(this.value) : null">
			 </div>
				<div class="col-md-6 my-3">
				  <label class="fw-bold fs-6 mb-2">Special Tax Value</label>
				 <input type="text" class="form-control" name="special_tax" placeholder="Enter Special Tax Value" value="{{$data->special_tax}}" oninput="this.value = 
 !!this.value && Math.abs(this.value) >= 0 && Math.abs(this.value) <= 99 ? Math.abs(this.value) : null">
			 </div>
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>
</div>


@endsection