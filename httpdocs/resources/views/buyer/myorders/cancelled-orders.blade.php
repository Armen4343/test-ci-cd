@php
date_default_timezone_set('Europe/Rome');
@endphp
@extends('layouts.buyer.master')
<style>
    .ordernumber{
        cursor:pointer;
        color:#FF0066;
    }
</style>
@section('buyer')
<div class="card mb-3">
	  <div class="card-header align-items-center">
		  <h3 class="fw-bolder m-0">Ordini Cancellati</h3>
	  </div>
	  <div class="card-body">'
	  <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
			<thead>
				<tr class="fw-bolder fs-6 px-7">
					<th>Ordine N</th>
                    <th>Items</th>
					<th>Nome Cliente</th>
					<th>Nome Esercente</th>
					<th>Regione</th>
					<th>Data e Ora Ordine</th>
					<th>Tipo di Pagamento</th>
                    <?php /*<th>Sales Tax</th>*/ ?>
					<th>Totale</th>
					<th>Totale Rimborso</th>
                    <th>Cancellato da</th>
					  <th>Status Rimborso</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
					<tr>
						<td><span>{{$order->order_number}}</span></td>
                        <td>
                            @php
                                $nOrderID = $order->id;
                            @endphp
                            {{$arrItems["$nOrderID"]}}
                        </td>
						<td>{{$order->name}}</td>
						<td>{{$order->vendname}}</td>
						<td>{{$order->vendstate}}</td>
                        <td>{{date("d-m-Y H:i:s", strtotime($order->creditcardtime))}}</td>
                        <td>{{$order->payment_type}}</td>
						<?php
                        /*<td>
							@php
								$orderitems = DB::select("SELECT orderitem.total_price, items.tax  as tax
									FROM orderitem
									JOIN items ON items.id=orderitem.itemid
									WHERE orderitem.order_id='$order->id'");
									$tax = 0;
									foreach($orderitems as $item){
										$tax += ($item->total_price * $item->tax/100);
									}
							echo "&euro;".round($tax,2);
								@endphp

						</td>*/
                        ?>
                        <td>&#36;{{$order->total}}</td>
						<td class="text-center">&euro;{{number_format($order->refund_amount, 2, ',', '')}}
						</td>
                        <td>{{$order->status}}
						</td>
						<td>{{$order->refund_status}}
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
@section("customjs")
    <script type="text/javascript">
        $('.ordercancel').click(function(event){
            event.preventDefault();
            //console.log($(this).attr("data-id"));
            var ordernumber = $(this).attr("data-id");
            $('.exampleModalLabel').html('Order Number: <span style="color:#FF0066">'+ordernumber+'</span>');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('buyer.myorder.cancel')}}",
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
        $('.ordernumber').click(function(){
            console.log('in function');
            //var ordernumber = $(this).html();
            var ordernumber = $(this).find('.ordernumber').val();
            $('.exampleModalLabel').html('Order Number: <span style="color:#FF0066">'+ordernumber+'</span>');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('buyer.myorder.detail')}}",
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


    </script>
@stop
@endsection
