@extends('layouts.vendor.master')
@php
	function is_decimal( $val )
	{
	return is_numeric( $val ) && floor( $val ) != $val;
	}
									
	@endphp
@section('vendor')
   <div class="row">
		<div class="col-6 col-lg-3">
			<div class="small-box bg-light">
				<div class="inner">
					<h4>Rating del tuo Esercizio</h4>
					<hr style=“border-style:dotted;”>
				</div>
				<div>
					 @php
						 
				  $rating = \App\Models\Rating::where(['vendor_id' => Auth::user()->id])->sum('rating'); 
				  $total = \App\Models\Rating::where(['vendor_id' => Auth::user()->id])->count(); 
				  if($total > 0){
				  $IntAvg = intval($rating / $total);
				  $avg = round($rating / $total , 2);
				  }
				  @endphp
						  @if($total > 0)
						
						 <ul type="none" class="ps-1 p-0 m-0" style="float:left;">
					   <li>
						     @for ($i = $IntAvg; $i > 0; $i--)
						  	<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="20px">
							@endfor
						   
						   @if(is_decimal($avg))
						   <img src="https://it.zeepup.com/front-end/images/leaf-half.png" width="20px">
						   @endif
						  
							@for ($i = $avg+1; $i <= 5; $i++)
						  	<img src="https://it.zeepup.com/front-end/images/leaf-unfilled.png" width="20px">
							@endfor
						  	
						  <strong>{{ round($rating / $total , 2) }} ({{$total}} ratings)</strong>
					  </li>
				  </ul>
						  @else
						 
				<div><img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="20px"> Non ancora valutata!</div>
						 @endif
				</div>
			</div>
		</div>
	   <div class="col-6 col-lg-3">
			<div class="small-box bg-success text-white">
				<div class="inner">
					<h4 class="text-white">Vendite del Giorno</h4>
					<hr style=“border-style:dotted;”>
					<p>Ordini Recenti</p>
						<div>
								<p>
									@php $state =  \App\Models\Tax::where(['state' => Auth::user()->state])->first();
																	@endphp
									@if($state)
												 State Tax: {{$state->tax}}%
												@else
												State Tax: 0%
												@endif</p>
											</div>
				</div>
				<div class="icon">
					<i class="fas fa-chart-bar"></i>
				</div>
			</div>
		</div>
	   <div class="col-6 col-lg-3">
			<div class="small-box bg-primary  text-white">
				<div class="inner">
					<h4 class="text-white">Group Items / Prodotti /Basket Offerta Prodotti</h4>
					<hr style=“border-style:dotted;”>
					<p>{{count($menus)}}</p>
				</div>
				<div class="icon">
					<i class="fas fa-utensils"></i>
				</div>
			</div>
		</div>
	   <div class="col-6 col-lg-3">
			<div class="small-box bg-danger text-white">
				<div class="inner">
					<h4 class="text-white">Tutte le tue SottoCategorie {{count($cuisines)}}</h3>
					<hr style=“border-style:dotted;”>
					<p>In vendita / pubblicate</p>
					@if(count($cuisines)>0)
					<ul style="list-style:none; padding:0px">
						@foreach($cuisines as $cuisine)
						<li class="py-2">
							<i class="fa-solid fa-check text-white"></i> {{$cuisine->title}}
						</li>
						@endforeach
					</ul>
					@else
					<p>Non hai ancora creato alcuna SottoCategoria</p>
					@endif
					
				</div>
				<div class="icon">
					<i class="fas fa-pizza-slice"></i>
				</div>
				<a href="#" class="small-box-footer" data-bs-toggle="modal" data-bs-target="#addCuisineModal">Clicca e aggiungi <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
<div class="row">
	<div class="col-12">
		<div class="card card-bordered">
			<div class="card-body">
				<canvas id="kt_chartjs_1" class="mh-400px"></canvas>
			</div>
		</div>	
	</div>
</div>
@push("vendor-scripts")
<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script>
	var ctx = document.getElementById('kt_chartjs_1');

// Define colors
var primaryColor = KTUtil.getCssVariableValue('--bs-primary');
var dangerColor = KTUtil.getCssVariableValue('--bs-danger');
var successColor = KTUtil.getCssVariableValue('--bs-success');

// Define fonts
var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');

// Chart labels
const labels = [<?php echo $monthWiseDateArray; ?>];

// Chart data
const data = {
    labels: labels,
    datasets: [
        {
        label: 'Monthly Orders',
        data: [<?php echo $monthWiseArray; ?>],
		backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
        borderWidth: 1
      }
    ]
};

// Chart config
const config = {
    type: 'bar',
    data: data,
    options: {
        plugins: {
            title: {
                display: false,
            }
        },
        responsive: true,
        interaction: {
            intersect: false,
        },
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true
            }
        }
    },
    defaults:{
        global: {
            defaultFont: fontFamily
        }
    }
};

// Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
var myChart = new Chart(ctx, config);
</script>
@endpush
@endsection
