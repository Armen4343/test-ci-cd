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
		  <h3 class="fw-bolder m-0">Ordini</h3>
	  </div>
	  <div class="card-body">'
	  <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
			<thead>
				<tr class="fw-bolder fs-6 text-gray-800 px-7">
					<th>Ordine N</th>
                    <th>Prodotto</th>
					<th>Nome Negozio</th>
					<th>Metodo di Pagamento</th>
                    <th>Data e Ora Ordine</th>
					<th>Totale</th>
                    <th>CO2(Kgs)</th>
                    <th>H2O(L)</th>
                    <th>Ritirato</th>
                    <th>Opzione</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
					<tr id="{{ $order->order_number }}">
						<td><span class="ordernumber">{{$order->order_number}}<input type="hidden" class="ordernumber" value="{{$order->order_number}}" /></span></td>
						<td>
                            @php
                                $nOrderID = $order->id;
                            @endphp
                            {{$arrItems["$nOrderID"]}}
                        </td>
                        <td>{{$order->vendname}}</td>
                        <td>{{$order->payment_type}}</td>
                        <td>{{date("d-m-Y H:i:s", strtotime($order->creditcardtime))}}</td>
                        <td>{{$order->total}}</td>
                        <td>{{$order->co2_avg}}</td>
                        <td>{{$order->h2o_avg}}</td>
                        <td><input type="checkbox" disabled  @if($order->collected=='yes') checked @endif /></td>
                        <td>
                            @if($order->status=='cancel_client' || $order->status=='cancel_vendor')
                                Canceled
                            @elseif($order->status=='paid' && $order->collected=='no')
                                <a href="{{route('vendor.myorder.cancel')}}" class="ordercancel" data-id="{{$order->order_number}}" >
                                    <input type="hidden" value="{{$order->order_number}}" class="orderid"> Cancel
                                </a>
                            @elseif($order->collected=='yes')
                                Already Collected
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
@section("customjs")
    <script type="text/javascript">
        $('.ordercancel').click(function(event){
            event.preventDefault();
            const popupText = "{!! trans('order.cancel_popup_confirmation_text') !!}"

            if(confirm(popupText))
            {
                var ordernumber = $(this).attr("data-id");
                $('.exampleModalLabel').html('Order Number: <span style="color:#FF0066">'+ordernumber+'</span>');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{route('buyer.myorder.cancel')}}",
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: {ordernumber: ordernumber},
                    success: function(response) {
                        $('#ordermodal').modal('toggle');

                        if(response == "{!! trans('payment.order_can_be_cancel_in_2_hours')!!}"  ||
                            response == "{!! trans('payment.order_canceled_successfully')!!}")
                        {
                            $(`#${ordernumber}`).remove();
                        }
                        $('.orderdetail').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        alert('Errore dettagli ordine');
                    }
                });
            }

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
                    alert('Errore dettagli ordine');
                }
            });
        });


    </script>
@stop
@endsection
