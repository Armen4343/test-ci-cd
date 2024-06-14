@php
date_default_timezone_set("Europe/Rome");
@endphp
@extends('layouts.vendor.master')

@section('vendor')
<style>
    .ordernumber{
        cursor:pointer;
    }
	.main-btn{
	border-radius: 0px!important;
	background-color: #ff0066!important;
		color:#ffffff!important;
	}
	.main-btn:hover{
	border-radius: 0px!important;
	background-color: #ff0066!important;
		color:#ffffff!important;
		opacity: 0.9;
	}
	.main-btn-dark{
	border-radius: 0px!important;
	color: #ffffff!important;
	background-color:#000000!important;
	}
	.main-btn-dark:hover{
	border-radius: 0px!important;
	color: #ffffff!important;
	background-color:#000000!important;
		opacity: 0.9;
	}
	.table-responsive{
	overflow:auto;
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
	  <h3 class="fw-bolder m-0">Ordini Ricevuti</h3>
		<div>
			 <div class="card-title">
   <!--begin::Search-->
   <div class="d-flex align-items-center position-relative my-1">
    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Order" />
   </div>
   <!--end::Search-->
   <!--begin::Export buttons-->
   <div id="kt_datatable_example_1_export" class="d-none"></div>
   <!--end::Export buttons-->
  </div>
  <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
   <!--begin::Export dropdown-->
   <button type="button" class="btn main-btn-dark" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
   Esporta Report
   </button>
   <!--begin::Menu-->
   <div id="kt_datatable_example_1_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
     <a href="#" class="menu-link px-3" data-kt-export="copy">
     Copy to clipboard
     </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-3">
     <a href="#" class="menu-link px-3" data-kt-export="excel">
     Export as Excel
     </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-3">
     <a href="#" class="menu-link px-3" data-kt-export="csv">
     Export as CSV
     </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-3">
     <a href="#" class="menu-link px-3" data-kt-export="pdf">
     Export as PDF
     </a>
    </div>
    <!--end::Menu item-->
   </div>
   <!--end::Menu-->
   <!--end::Export dropdown-->
  </div>
		</div>
	</div>
	<div class="card-body">
	<table class="table align-middle border rounded table-row-dashed fs-6 g-5 " id="kt_datatable_example_1">
			<thead>
				<tr class="fw-bolder fs-6 px-7">
					<th>Ordine N.</th>
                    <th>Prodotto</th>
					<th>Nome Cliente</th>
					<th>Nome Esercente</th>
					<th>Regione</th>
					<th>Data Ordine</th>
					<th>Pagamento</th>
                    <th>Totale</th>
                    <th>Status</th>
                    <th>CO2(Kgs)</th>
                    <th>H2O(L)</th>
                    <th>Ricevuta</th>
                    <th>Opzioni</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
					<tr id="{{ $order->order_number }}">
						<td>
                            <span class="ordernumber">
                                {{$order->order_number}}
                                <input type="hidden" class="ordernumber" value="{{$order->order_number}}" />
                            </span>
                        </td>
						<td>
                            @php
                                $nOrderID = $order->id;
                            @endphp
                            {{$arrItems["$nOrderID"]}}
                        </td>
                        <td>{{$order->name}}</td>
						<td>{{Auth::user()->name}}</td>
						<td>{{Auth::user()->state}}</td>
                        <td>{{date("d-m-Y H:i:s", strtotime($order->creditcardtime))}}</td>
                        <td>{{$order->payment_type}}</td>
						<td>&euro;{{number_format($order->total, 2, ',', '')}}</td>
                        <td>
                            @if($order->status=='cancel_client')
                                Canceled-Client
                            @elseif($order->status=='cancel_vendor')
                                Canceled-Vendor
                            @elseif($order->collected=='yes')
								Ritirato
							@elseif($order->collected=='no')
								Non ancora ritirato
							@endif
						</td>

                        <td>
                            {{$order->co2_avg}}
                        </td>
                        <td>
                            {{$order->h2o_avg}}
                        </td>
						<td  class=" my-0 py-1">
							<div class="dropdown my-0 py-1">
							  <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								Ricevuta
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li><a class="dropdown-item" target="_blank" href="{{ route('vendor.myorder.view.order', ['id'=>$order->id]) }}">View</a></li>
								<li><a class="dropdown-item" target="_blank"  href="{{ route('vendor.myorder.download.order', ['id'=>$order->id]) }}">Download</a></li>
							  </ul>
							</div>
						</td>
                        <td>
                            @if($order->status=='cancel_client' || $order->status=='cancel_vendor')
                                Cancellato
                            @elseif($order->collected=='yes')
                                Ritirato
                            @elseif($order->status=='paid' && $order->collected=='no')
                                <a href="#" class="ordercancel" data-id="{{$order->order_number}}">
                                    <input type="hidden" value="{{$order->order_number}}" class="orderid"> Cancella
                                </a>
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
        $('.ordercancel').click(function(event){
            event.preventDefault();
            const popupText = "{!! trans('order.cancel_popup_confirmation_text') !!}"
            //console.log($(this).attr("data-id"));
            if(confirm(popupText))
            {
                var ordernumber = $(this).attr("data-id");
                $('.exampleModalLabel').html('Order Number: <span style="color:#FF0066">'+ordernumber+'</span>');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{route('vendor.myorder.cancel')}}",
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: {ordernumber: ordernumber},
                    success: function(response) {
                        VendorFetchOrders();
                        //console.log(response);
                        //return;
                        //alert('Item added to cart!');
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
                        alert('Error fetching order details');
                    }
                });
            }

        });
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







// Class definition
var KTDatatablesButtons = function () {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatable = function () {
        // Set date data order
       // const tableRows = table.querySelectorAll('tbody tr');

        /*tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
            dateRow[3].setAttribute('data-order', realDate);
        });*/

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
			"bDestroy": true
        });
    }

    // Hook export buttons
    var exportButtons = () => {
        const documentTitle = 'Customer Orders Report';
        var buttons = new $.fn.dataTable.Buttons(table, {
           buttons: [
                {
                    extend: 'copyHtml5',
                    title: documentTitle
                },
                {
                    extend: 'excelHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            body: function(data, row, column, node) {
                                if (column === 7) {
                                    return data.replace(',', '.');
                                }
                                if (column === 11) {
                                    return
                                }
                                return node.textContent.trim()
                            }

                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: documentTitle,
                },
                {
                    extend: 'pdfHtml5',
                    title: documentTitle,
					orientation: 'landscape',
				    pageSize: 'LEGAL',
					exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,12]
					}
                }
            ]
        }).container().appendTo($('#kt_datatable_example_1_export'));

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#kt_datatable_example_1_export_menu [data-kt-export]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();

                // Get clicked export value
                const exportValue = e.target.getAttribute('data-kt-export');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                // Trigger click event on hidden datatable export buttons
                target.click();
            });
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function () {
            table = document.querySelector('#kt_datatable_example_1');

            if ( !table ) {
                return;
            }

            initDatatable();
            exportButtons();
            handleSearchDatatable();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesButtons.init();
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
