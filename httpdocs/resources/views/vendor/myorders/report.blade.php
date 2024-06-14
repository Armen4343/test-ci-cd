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
	  <h3 class="fw-bolder m-0">Seleziona Data</h3>
	</div>
	<div class="card-body">
		<form action="{{ route('vendor.myorder.reports.filters') }}" method="POST">
      @csrf
      <div class="row">
		  <div class="col-md-5">
			  <div class="form-group">
				<label for="start-date">A partire da:</label>
				<input type="date" class="form-control" id="start" name="startdate" required>
			  </div>
		  </div>
      
		 <div class="col-md-5">
			  <div class="form-group">
				<label for="end-date">Fino a:</label>
				<input type="date" class="form-control" id="end" name="enddate" required>
			  </div>
			</div>
		 <div class="col-md-2 pt-1">
     			 <button type="submit" class="btn main-btn-dark mt-5">Filtra</button>
		</div>
	  </div>
      
    </form>
	</div>
</div>
<div class="card p-3">
	<div class="card-header align-items-center">
	  <h3 class="fw-bolder m-0">Report Ordini</h3>
	</div>
	<div class="card-body">
		
		<div class="card card-p-0 card-flush">
 <div class="card-header align-items-center py-5 gap-2 gap-md-5">
  <div class="card-title">
   <!--begin::Search-->
   <div class="d-flex align-items-center position-relative my-1">
    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cerca Report" />
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
 <div class="card-body">
  <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">
   <thead>
    <!--begin::Table row-->
    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
     <th>Identificativo Ordine</th>					
					<th>Nome Cliente</th>
                    <th>Orario Ritiro</th>
					<th>Metodo Pagamento</th>
                    <th>Orario Ordine</th>
					<th>Totale</th>
                    <th>Recevuta</th>
    </tr>
    <!--end::Table row-->
   </thead>
   <tbody class="fw-bold text-gray-600">
    	@if(isset($orders))
				@foreach($orders as $order)
					<tr>
						<td><span class="ordernumber">{{$order->order_number}}</span></td>
						<td>{{$order->custname}}</td>	
                        <td>{{date("Y-m-d H:i:s", strtotime($order->delivery_date." ".$order->delivery_time))}}</td>	
                        <td>{{$order->payment_type}}</td>	
                        <td>{{$order->creditcardtime}}</td>	
                        <td>{{$order->total}}</td>
						<td  class=" my-0 py-1">
							<div class="dropdown my-0 py-1">
							  <button class="btn btn-sm main-btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								Ricevuta 
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li><a class="dropdown-item" target="_blank" href="{{ route('vendor.myorder.view.order', ['id'=>$order->id]) }}">Aprire</a></li>
								<li><a class="dropdown-item" target="_blank"  href="{{ route('vendor.myorder.download.order', ['id'=>$order->id]) }}">Scaricamento</a></li>
							  </ul>
							</div>
						</td>
                    </tr>
				@endforeach
				
				@endif
   </tbody>
  </table>
 </div>
</div>
	</div>
</div>
@push('vendor-scripts')
    <script type="text/javascript">
   
   
 
		
	"use strict";

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
                    title: documentTitle
                },
                {
                    extend: 'csvHtml5',
                    title: documentTitle
                },
                {
                    extend: 'pdfHtml5',
                    title: documentTitle
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
