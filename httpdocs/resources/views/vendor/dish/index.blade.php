@extends('layouts.vendor.master')

@section('vendor')
<div class="card mb-3">
	  <div class="card-header align-items-center">
		  <h3 class="fw-bolder m-0">Items List</h3>
	  </div>
	  <div class="card-body">'
	  <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
			<thead>
				<tr class="fw-bolder fs-6 text-gray-800 px-7">
					<th>Name</th>
					<th>Image</th>
					<th>Quantity</th>
					<th>Inventory</th>
					<th>Status</th>
					<th class="d-flex justify-content-end pe-5">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Buger and Fries</td>
					<td>
						<img src="{{asset('front-end/images/burger.jpg')}}" class="list-image rounded"/>
					</td>
					<td>12</td>
					<td>
						<h6>
							<span class="badge badge-success">In Stock</span>
						</h6>
					</td>
					<td>
						<h6>
							<span class="badge badge-danger">UnPublished</span>
						</h6>
					</td>
					<td class="d-flex justify-content-end pe-5">
						<div class="dropdown-center">
							<button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-ellipsis-v  fs-4"></i>
							</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Edit</a></li>								
								<li><a class="dropdown-item" href="#">Delete</a></li>
							</ul>
						</div>	
					</td>
				</tr>
				<tr>
					<td>Pizza</td>
					<td>
						<img src="{{asset('front-end/images/pizza.jpg')}}" class="list-image rounded"/>
					</td>
					<td>30</td>
					<td>
						<h6>
							<span class="badge badge-danger">Out of Stock</span>
						</h6>
					</td>
					<td>
						<h6>
							<span class="badge badge-success">Published</span>
						</h6>
					</td>
					<td class="d-flex justify-content-end pe-5">
						<div class="dropdown-center">
							<button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-ellipsis-v  fs-4"></i>
							</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Edit</a></li>								
								<li><a class="dropdown-item" href="#">Delete</a></li>
							</ul>
						</div>	
					</td>
				</tr>
			</tbody>
		</table>
	  </div>
</div>
@push("vendor-scripts")
	<script>
		$("#kt_datatable_example_5").DataTable({
			 "language": {
			  "lengthMenu": "Show _MENU_",
			 },
			 "dom":
			  "<'row'" +
			  "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
			  "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
			  ">" +

			  "<'table-responsive'tr>" +

			  "<'row'" +
			  "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
			  "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
			  ">"
			});
	</script>
@endpush
@endsection