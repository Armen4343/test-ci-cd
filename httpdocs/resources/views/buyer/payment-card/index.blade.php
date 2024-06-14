@extends('layouts.buyer.master')

@section('buyer')
<div class="card mb-3">
	  <div class="card-header align-items-center">
		  <h3 class="fw-bolder m-0">Lista</h3>
	  </div>
	  <div class="card-body">
	  <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
			<thead>
				<tr class="fw-bolder fs-6 text-gray-800 px-7">
					<th>Nome sulla Carta</th>
					<th>Numero Carta</th>
					<th>Tipologia</th>
					<th>Data Scadenza</th>
					<th>Status</th>
					<th>Data Inserimento</th>
					<th class="d-flex justify-content-end pe-5">Opzione</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cards as $card)
				<tr>
					<td>{{ $card->name_on_card }}</td>
					<td>{{ Crypt::decryptString($card->card_number) }}</td>
					<td>{{ optional(decrypt($card->card_number), 'Default Value') }}</td>
					<td>{{ $card->card_type }}</td>
					<td>{{ $card->expiration_date }}</td>
					<td>
					@if($card->status==1)
								<h6><span class="text-success status">Active</span></h6>
							@else
							<h6><span class="text-danger status">Disabled</span></h6>
							@endif
					</td>
					<td>{{ $card->created_at }}</td>
					<td class="d-flex justify-content-end pe-5">
						<div class="dropdown-center">
							<button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-ellipsis-v  fs-4"></i>
							</button>
							<ul class="dropdown-menu">							
								<li>
								 <form action="{{ route('cards.destroy',$card->id) }}" method="POST">
								<a class="dropdown-item" href="{{ route('cards.edit',$card->id) }}">Edit</a>

								@csrf
								@method('DELETE')

								<button type="submit" class="dropdown-item">Rimuovi</button>
							</form>
									</li>
							</ul>
						</div>	
					</td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
	  </div>
</div>
@push("buyer-scripts")
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
