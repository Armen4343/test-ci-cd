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
<div class="card p-3">
	<div class="card-header align-items-center">
	  <h3 class="fw-bolder m-0">Subscriptions</h3>
	</div>
	<div class="card-body">
		<table id="subscription_table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
			<thead>
				<tr class="fw-bolder fs-6 px-7">
					<th>Email</th>				
					<th>Created At</th>
					<th class="d-flex justify-content-end pe-5">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($subscriptions as $subscription)
					<tr>
						<td class="text-lowercase">{{$subscription->email}}</td>
						<td>{{$subscription->created_at}}</td>
						<td class="text-end pe-5">
							<div class="dropdown">
							  <a class="dots-btn rounded-circle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-ellipsis-v  fs-4"></i>
							  </a>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item" href="{{route('subscriptions.edit',$subscription->id)}}">Edit</a></li>
								<form id="delete-tax-form-{{$subscription->id}}" action="{{route('subscriptions.destroy',$subscription->id)}}" method="POST" class="d-inline">
									@csrf
									@method('DELETE')
									<li><button class="dropdown-item deleteBtn" data-id="{{$subscription->id}}">Delete</button></li>
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
@push('super-admin-scripts')
    <script type="text/javascript">
  $("#subscription_table").DataTable({
	  dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                      columns: [ 0, 1 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                     columns: [ 0, 1 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1 ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1 ]
                }
            }
        ]
    } );

		$(document).ready(function (e) {
   $(".deleteBtn").click(function(e){
   e.preventDefault()
	   var id = $(this).data('id');
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