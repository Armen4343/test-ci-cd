@extends('layouts.vendor.master')

@section('vendor')
<div class="card mb-3">
	<div class="card-body d-flex justify-content-end">
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fas fa-plus"></i> Add Category</button>
	</div>
</div>
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
<div class="card p-3">
	<div class="card-header align-items-center">
	  <h3 class="fw-bolder m-0">Category</h3>
	</div>
	<div class="card-body">
		<table id="datatable" class="table" style="width:100%">
			<thead>
				<tr>
					<th>Title</th>
					<th>Image</th>
					<th>Status</th>
					<th class="d-flex justify-content-end pe-5">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{$category->title}}</td>
						<td><img src="{{$category->image}}" width="70px" class="rounded-1"/></td>
						<td>
							@if($category->status==1)
								<h6><span class="badge bg-success">Published</span></h6>
							@else
							<h6><span class="badge bg-danger">UnPublished</span></h6>
							@endif
						</td>
						<td class="d-flex justify-content-end pe-5">
							<div class="dropdown-center">
							  <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-ellipsis-v  fs-4"></i>
							  </button>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item" href="{{route('categories.edit',$category->id)}}">Edit</a></li>
								<form action="{{route('categories.destroy',$category->id)}}" method="POST" class="d-inline">
									@csrf
									@method('DELETE')
									<li><button class="dropdown-item" type="submit">Delete</button></li>
								</form>
							  </ul>
							</div>		
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>	
	</div>
</div>