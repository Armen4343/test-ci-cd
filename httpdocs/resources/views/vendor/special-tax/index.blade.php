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
<div class="card p-3">
	<div class="card-header align-items-center">
	  <h3 class="fw-bolder m-0">Special Tax</h3>
	</div>
	<div class="card-body">
		<table id="cuisine_table" class="table table-striped table-row-bordered gy-4 gs-7 border rounded">
			<thead>
				<tr class="fw-bolder fs-6 px-7">
					<th>Tax Title</th>					
					<th>Tax Value</th>
					<th>Tax Status</th>
					<th class="d-flex justify-content-end pe-5">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($specialTaxes as $specialTax)
					<tr>
						<td>{{$specialTax->title}}</td>						
						<td>{{$specialTax->value}}%</td>
						<td>
							@if($specialTax->status==1)
								<h6><span class="text-success status">Published</span></h6>
							@else
							<h6><span class="text-danger status">UnPublished</span></h6>
							@endif
						</td>
						<td class="text-end pe-5">
							<div class="dropdown">
							  <a class="dots-btn rounded-circle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-ellipsis-v  fs-4"></i>
							  </a>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item" href="{{route('special-taxes.edit',$specialTax->id)}}">Edit</a></li>
								<form action="{{route('special-taxes.destroy',$specialTax->id)}}" method="POST" class="d-inline">
									@csrf
									@method('DELETE')
									<li><button class="dropdown-item deleteBtn">Delete</button></li>
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
@push('vendor-scripts')
    <script type="text/javascript">
      
   
  $("#cuisine_table").DataTable({
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

		$(document).ready(function (e) {
   $(".deleteBtn").click(function(e){
   e.preventDefault()
	   var form=$(this).parent().parent();
	   const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-danger',
    cancelButton: 'btn btn-secondary'
  },
  buttonsStyling: false
})

	swalWithBootstrapButtons.fire({
  title: 'Are you sure you want to delete?',
  showCancelButton: true,
  confirmButtonText: 'Delete',
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    form.submit();
  } 
})
   })
});
</script>
@endpush


@endsection