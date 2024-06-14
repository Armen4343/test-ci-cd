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
	  <h3 class="fw-bolder m-0">Edit Subscription</h3>
	</div>
	<div class="card-body">
		<form action="{{route('subscriptions.update',$data->id)}}" method="post" enctype="multipart/form-data">
			@csrf
			@method("PUT")
			<div class="row">
			 <div class="col-md-6 my-3">
				 <label class="required fw-bold fs-6 mb-2">Subscription Email</label>
				 <input type="email" class="form-control" name="email" placeholder="Enter Subscription Email" value="{{$data->email}}">
			 </div>
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>
</div>


@endsection