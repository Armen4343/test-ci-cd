@extends('layouts.vendor.master')

@section('vendor')
<style>
    .ordernumber{
        cursor:pointer;
    }
</style>


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
	  <h3 class="fw-bolder m-0">Rating</h3>
	</div>
	<div class="card-body">
		<table id="cuisine_table" class="table table-striped table-row-bordered gy-4 gs-7 border rounded">
			<thead>
				<tr class="fw-bolder fs-6 px-7">
					<th >Numero Ordine</th>					
					<th>Nome Cliente</th>
					<th>Rating</th>
                    <th>Data</th>
                    <th>Commento</th>
                    <th>Rispondi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($ratings as $rating)
					<tr class="fw-bolder fs-6 px-7">
					<td class="text-nowrap">{{ $rating->order_number }}</td>
					<td class="text-nowrap">{{ $rating->name }}</td>	
					<td class="text-nowrap">{{ $rating->rating }}</td>	
					<td class="text-nowrap">{{ date('Y-m-d', strtotime($rating->created_at)) }}</td>
					<td>{{ $rating->comment }}</td>	
					<td>
						@if($rating->reply)
							{{$rating->reply}}
						@else
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-dark btn-sm py-2 px-3"  data-bs-toggle="modal" data-bs-target="#reply-{{$rating->id}}">
							  Rispondi
							</button>

							<!-- Modal -->
							<div class="modal fade" id="reply-{{$rating->id}}" tabindex="-1" aria-labelledby="reply-{{$rating->id}}" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header" style="background-color:#ffbf00;">
									<h5 class="modal-title" id="exampleModalLabel">{{ $rating->order_number }}</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								  </div>
								  <div class="modal-body">
										<form action="{{ route('vendor.reply.ratings') }}" method="get">
											@csrf
											<input type="hidden" name="id" value="{{$rating->id}}" />
											<div class="mb-3">
										  <label for="exampleFormControlTextarea1" class="form-label">Reply:</label>
										  <textarea class="form-control" id="reply" name="reply" rows="3"></textarea>
										</div>
										<button type="button" class="btn btn-secondary py-2 px-3" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-dark py-2 px-3">Save changes</button>
									  </form>
								  </div>
								</div>
							  </div>
							</div>
						@endif
					</td>		
					</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
</div>
<div class="modal fade" id="ordermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 exampleModalLabel" id="exampleModalLabel">Order Number:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body orderdetail" style="height: 600px; overflow-y:auto;">
                
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn bg-white text-dark shadow rounded-0" data-bs-dismiss="modal">Close</button>
            </div>-->
        </div>
    </div>
</div>
@push('vendor-scripts')
    <script type="text/javascript">
        $('.ordernumber').click(function(){
            //var ordernumber = $(this).html();
            var ordernumber = $(this).find('.ordernumber').val();
            $('.exampleModalLabel').html('Order Number: <span style="color:#FF0066">'+ordernumber+'</span>');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('vendor.myorder.detail')}}",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: {ordernumber: ordernumber},
                success: function(response) {
                    //console.log(response);
                    //return;
                    //alert('Item added to cart!');
                    $('#ordermodal').modal('toggle');
                    $('.orderdetail').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Error fetching order details');
                }
            });
        });

      
   
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
