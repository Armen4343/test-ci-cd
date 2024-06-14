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
        <div class="card py-3">
			<div class="card-header align-items-center">
			  	<h3 class="fw-bolder m-0">Customers</h3>
                <a href="{{ route('add.user', 'customer') }}" class="btn btn-primary text-white">Add Customer</a>
			</div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table id="customers_table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <!-- <th>Profile</th> -->
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th class="d-flex justify-content-end pe-5">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr = 1;
                                @endphp
                                @foreach($users as $user)
                                    <tr>
                                         <td>{{ $sr++ }}</td>
                                           <td>{{ $user->name }}</td>
                                           <td>{{ $user->email }}</td>
                                           <td>{{ $user->phone }}</td>

                                            <td ><span class="badge bg-primary px-3 ">{{ $user->role }}</span> </td>


                                           <td>{{ $user->status }}</td>

                                         <td>{{ $user->created_at }}</td>
                                        <td class="text-end pe-5">
							<div class="dropdown">
							  <a class="dots-btn rounded-circle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-ellipsis-v  fs-4"></i>
							  </a>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item" href="{{ url('super-admin/customer/edit/'.$user->id) }}">Edit</a></li>
								<form id="delete-tax-form-{{$user->id}}" action="{{ url('super-admin/user/delete/'.$user->id) }}" method="POST" class="d-inline">
									@csrf
									@method('DELETE')
									<li><button class="dropdown-item deleteBtn" data-id="{{$user->id}}">Delete</button></li>
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
        </div>
@push('super-admin-scripts')
    <script type="text/javascript">
  $("#customers_table").DataTable({
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
