@extends('layouts.front.master')

@section('front')
@push('front-styles')
		<link href="{{ asset('front-end/category.css') }}" rel="stylesheet" type="text/css" />
@endpush
  {{-- Category start--}}
  <div class="contaniner-fluid front-main">
	  <div class="page_header element_to_stick">
		  <div class="row p-3">
			  <div class="col-xl-5 col-lg-5 col-md-5 d-none d-md-block">
			  </div>
			  <div class="col-xl-7 col-lg-7 col-md-7">
				  <div class="hero-section-main-div mt-0">
					  <div class="hero-section-input-div">
						  <i class=" location fa-solid fa-location-dot  bg-white  ps-1 pt-1 pe-1"></i>
						  <input type="text" placeholder="Inserisci la tua posizione" class="hero-section-input">
					  </div>
					  <div class="hero-section-input-div">
						  <i class="location fa-solid fa-magnifying-glass  bg-white  ps-1 pt-1 pe-1"></i>
						  <input type="text" placeholder="Cerca" class="hero-section-input">
					  </div>
					  <button class="hero-section-btn">Cerca</button>
				  </div>
			  </div>
		  </div>
	  </div>
	  <div class="row p-3">
		  <div class="col-12">

		  	
			  	<h3>{{ $vendors->count() }} restaurants founded</h3>

		  </div>
	  </div>
    <div class="row p-3 ">
      <!-- Next Column Items -->
      <div class="col-xl-10 col-lg-9 order-lg-1 order-2">
        <div class="row">
          

          @foreach($vendors as $vendor)
		<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
			  <div class="strip">
				  <figure >
					  <span class="ribbon off">-30%</span>
					  <img src="{{asset($vendor->banner_photo_path)}}" data-src="img/location_1.jpg" class="img-fluid lazy loaded" alt="" data-was-processed="true" style="z-index: 0;">
					  <!--<a href="{{ route('cat_items',['id' => $vendor->id]) }}" class="strip_info">-->
					  <a href="{{ route('cat_singleitems', ['id' => encrypt($vendor->id)]) }}">
						
						  <div class="item_title">
							  <h3>{{$vendor->name}}</h3>
							  <small>{{$vendor->city}}, {{$vendor->state}}</small>
						  </div>
					  </a>
				  </figure>
				  <ul>
					   <li>
						  <img src="{{asset('front-end/images/leaf-full.png')}}" width="20px">
						   <img src="{{asset('front-end/images/leaf-half.png')}}" width="20px">
						  <img src="{{asset('front-end/images/leaf-unfilled.png')}}" width="20px">
						  <img src="{{asset('front-end/images/leaf-unfilled.png')}}" width="20px">
						  <img src="{{asset('front-end/images/leaf-unfilled.png')}}" width="20px">
						  
						  <strong>1.2 (180 ratings)</strong>
					  </li>
					  <li>
						  <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div>
					  </li>
				  </ul>
			  </div>
			</div>
			@endforeach
        </div>
      </div>
		<div class="col-xl-2 col-lg-3 order-lg-2 order-1">
			<div class="clearfix">
					<div class="sort_select">
							<select name="sort" id="sort">
                                <option value="popularity" selected="selected">Ordina per Popolarita'</option>
                                <option value="rating">Sort by Average rating</option>
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by Price: low to high</option>
                                <option value="price-desc">Sort by Price: high to low</option>
							</select>
						</div>
						<a href="#0" class="open_filters btn_filters" id="show-filters-btn"><i class="fas fa-sort-amount-down"></i></a>
			</div>
			<div class="filter_col">
				<div class="inner_bt"><a href="#" class="open_filters" id="hide-filters-btn"><i class="fas fa-times"></i></a></div>
        <!-- Accordian -->
        <div class="accordion" id="accordionExample">

          <!-- Sort -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class=" accordion-button button-text" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Categories
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
              <div class="accordion-body">
				  <ul>
					 @foreach($categories as $category)
					   <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							  <label class="form-check-label" for="defaultCheck1">
								{{$category->title}}
							  </label>
						</div>
						<div>12</div>
					  </li>
					  @endforeach
					  
				  </ul>
              </div>
            </div>
          </div>

          <!-- Form Uber Eats -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button button-text" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                Rating
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
              <div class="accordion-body">
                <ul>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							  <label class="form-check-label" for="defaultCheck1">
								Superb 9+ 
							  </label>
						</div>
						<div>12</div>
					  </li>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" value="" checked="checked">
							  <label class="form-check-label" for="defaultCheck1">
								Very Good 8+ 
							  </label>
						</div>
						<div>12</div>
					  </li>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							  <label class="form-check-label" for="defaultCheck1">
								Good 7+ 
							  </label>
						</div>
						<div>12</div>
					  </li>
					<li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							  <label class="form-check-label" for="defaultCheck1">
								Pleasant 6+ 
							  </label>
						</div>
						<div>12</div>
					  </li>
				  </ul>
              </div>
            </div>
          </div>

          <!-- Dietar -->

          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button button-text" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                Price
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree">
              <div class="accordion-body">
                <ul>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="" name="price" checked="checked">
							  <label class="form-check-label" for="defaultCheck1">
								0 - 5%
							  </label>
						</div>
						<div>12</div>
					  </li>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="" name="price">
							  <label class="form-check-label" for="defaultCheck1">
								0 - 10%
							  </label>
						</div>
						<div>12</div>
					  </li>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="" name="price">
							  <label class="form-check-label" for="defaultCheck1">
								0 - 15%
							  </label>
						</div>
						<div>12</div>
					  </li>
					<li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="" name="price">
							  <label class="form-check-label" for="defaultCheck1">
								0 - 25%
							  </label>
						</div>
						<div>12</div>
					  </li>
					<li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="" name="price">
							  <label class="form-check-label" for="defaultCheck1">
								0 - 50%
							  </label>
						</div>
						<div>12</div>
					  </li>
					<li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="" name="price">
							  <label class="form-check-label" for="defaultCheck1">
								0 - 75%
							  </label>
						</div>
						<div>12</div>
					  </li>
				  </ul>
              </div>
            </div>
          </div>
			<div class="accordion-item">
				<div class="accordion-body">
					<button class="filter-btn">Filter</button>
				</div>
			</div>
        </div>
				</div>
      </div>
    </div>
  </div>

  {{-- Category end--}}

    <!-- map text  section -->
    <div class="map-text-main-div">
        <div class="map-div  w-100">


            <div class="map-text-div ">
                <a href="">Abredeen</a>
                <a href="">Belfast</a>
                <a href=""> Birmingham, UK</a>
                <a href=""> Brighton and Sussex</a>
                <a href="">Cambridge and East Anglia</a>
                <a href="">Cardiff</a>
            </div>
            <div class="map-text-div ">
                <a href=""> Edinburgh</a>
                <a href="">Glasgow</a>
                <a href="">Hull</a>
                <a href="">Leeds</a>
                <a href="">Leicester</a>
                <a href="">London</a>
            </div>
        </div>
        <div class="map-div w-100">

            <div class="map-text-div ">
                <a href=""> Manchester</a>
                <a href=""> Merseyside</a>
                <a href=""> North East, UK</a>
                <a href=""> Northampton and Milton Keynes</a>
                <a href="">Oxford, UK</a>
                <a href=""> Nottingham</a>
            </div>
            <div class="map-text-div ">
                <a href="">Sheffield</a>
                <a href="">South coast, UK</a>
                <a href="">South West, UK</a>
                <a href="">Stok</a>
            </div>
        </div>
    </div>
@push('front-scripts')
<script>
	$("#show-filters-btn").click(function(){
	  $(".filter_col").addClass("show");
	});
	$("#hide-filters-btn").click(function(){
	  $(".filter_col").removeClass("show");
	});
</script>
@endpush
@endsection 
