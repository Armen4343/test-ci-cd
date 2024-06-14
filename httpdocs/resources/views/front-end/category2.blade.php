@extends('layouts.front.master')

@section('front')
<style>
    #location-list {
        position: relative;
        top: calc(100% + 10px);
        left: 0;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        background-color: #fff;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        z-index: 999;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    #location-list li {
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    #location-list li:hover {
        background-color: #f5f5f5;
    }
	 .category-image {
    width: 296px;
    height: 196px;
}
	 .badge {
    position: absolute;
    top: 5px;
    right: 5px;
    border-radius: 20px !important;
    z-index: 10;
    background-color: #ff0066 !important;
    color: #fff !important;
    padding: 10px 10px 10px;
}
</style>
@push('front-styles')
		<link href="{{ asset('front-end/category.css') }}" rel="stylesheet" type="text/css" />
@endpush
@php
	function is_decimal( $val )
	{
	return is_numeric( $val ) && floor( $val ) != $val;
	}

	@endphp
  {{-- Category start--}}
  <div class="contaniner-fluid front-main">
	  <div class="page_header element_to_stick">
		  <div class="row p-3">
			  <div  id="search-results" style="color:#ff0065;"></div>
			  <!--<div class="col-xl-5 col-lg-5 col-md-5 d-none d-md-block">
			  </div>-->
			  <div class="col-xl-7 col-lg-7 col-md-7">
				  <div class="hero-section-main-div mt-0">

					  <div class="hero-section-input-div">
						  <i class=" location fa-solid fa-location-dot  bg-white  ps-1 pt-1 pe-1"></i>

							 <form id="search-form" action="{{route('search_vendor')}}" method="post">

        @csrf
    <input id="location-input" type="text" name="vendor_location" value="" placeholder="Inserisci Posizione" class="hero-section-input">

					  </div>
					  <div class="hero-section-input-div">
						  <i class="location fa-solid fa-magnifying-glass  bg-white  ps-1 pt-1 pe-1"></i>
						  <input type="text" placeholder="Cerca Articolo" class="hero-section-input">
					  </div>
					  <button class="hero-section-btn">Cerca</button>
						  </form>

				  </div>

			  </div>
			  <ul id="location-list" class="list-unstyled"></ul>
		  </div>
	  </div>
	  <div class="row p-3">
		  <div class="col-12">
		  	<h3>{{ $restaurants->count() }} Negozi Trovati</h3>
		  </div>
	  </div>
    <div class="row p-3 ">
      <!-- Next Column Items -->
      <div class="col-xl-10 col-lg-9 order-lg-1 order-2">
        <div class="row">


          @foreach($restaurants as $restaurant)
		<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
			  <div class="strip">
				   @php
				   if (isset($restaurant->item_id)){
					    $restaurant_item = \App\Models\Items::where([ 'id' => $restaurant->item_id])->inRandomOrder()->first();
					}
                    else{
                       $restaurant_item = \App\Models\Items::where([ 'user_id' => $restaurant->id])->where('image', '!=' , null)->inRandomOrder()->first();
                    }

                      if($restaurant_item && $restaurant_item->image){
							$restaurant_image = $restaurant_item->image;
					  } else{
					  	$restaurant_image = 'default-banner.jpg';
					  }
					  @endphp
				  <figure>
					  @if($restaurant_item && $restaurant_item->discount)
					  <span class="ribbon off">-{{$restaurant_item->discount}}%</span>
					  @endif

					    <img src="{{ asset($restaurant_image) }}" style=" min-width: 286px; min-height: 190px; " data-src="img/location_1.jpg" class="img-fluid lazy loaded" alt="" data-was-processed="true">

					  <a href="{{ route('cat_singleitems', ['id' => encrypt($restaurant->id)]) }}" class="strip_info text-decoration-none">
						<div class="item_title">
							  <h3>{{$restaurant->name}}</h3>
							  <small>{{$restaurant->city}}, {{$restaurant->state}}</small>
						  </div>
						   @if($restaurant_item && $restaurant_item->price)
						   <div class="ps-3" style=" background: rgba(0,0,0,0.4); color: #ffffff!important; ">
							   <h5 class="py-0 my-0">{{$restaurant_item->name}}</h5>
							  <small>&euro;{{number_format($restaurant_item->price, 2, ',', '.')}}</small>
						  </div>
						  @endif
					  </a>
				  </figure>
				   @php

				  $rating = \App\Models\Rating::where(['vendor_id' => $restaurant->id])->sum('rating');
				  $total = \App\Models\Rating::where(['vendor_id' => $restaurant->id])->count();
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

				<div><img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="20px"> Nessun Rating</div>
						 @endif

			  </div>
			</div>
			@endforeach
        </div>
      </div>
		<div class="col-xl-2 col-lg-3 order-lg-2 order-1">
			<form action="{{ route('filter.category.restaurants') }}" method="post" name="filterform" id="filterform">
				@csrf
			<div class="clearfix">
					<div class="sort_select">
							<select name="sort" id="sort" onchange="this.form.submit()">
                                <option value="popularity" {{isset($selectedSort) && $selectedSort === 'popularity' ? 'selected' : ''}}>Ordina per Popolarita'</option>
                                <option value="rating" {{isset($selectedSort) && $selectedSort === 'rating' ? 'selected' : ''}}>Ordina per Rating</option>
                                <option value="date" {{isset($selectedSort) && $selectedSort === 'date' ? 'selected' : ''}}>Ordina dal piu' Recente</option>
                                <option value="price" {{isset($selectedSort) && $selectedSort === 'price' ? 'selected' : ''}}>Ordina per prezzo: prima il piu' basso</option>
                                <option value="price-desc" {{isset($selectedSort) && $selectedSort === 'price-desc' ? 'selected' : ''}}>Ordina per prezzo: prima il piu' alto</option>
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
                Categorie
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
              <div class="accordion-body">
				  <ul>
					 @foreach($categories as $category)
					   <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" name="categories[]" onchange="this.form.submit()"  value="{{ $category->id }}"
									@php
									 if(isset($selectedCategories)){
										 if(in_array($category->id, $selectedCategories)){
											echo "checked";
										}
									}
							@endphp
									 >
							  <label class="form-check-label" >
								{{$category->title}}
							  </label>
						</div>
                           @php
                               $user_ids = \App\Models\Items::where('category_id', $category->id)->groupBy('user_id')->select('user_id')->get();
                               $users = \App\Models\User::whereIn("id", $user_ids)->where("disable_restaurant", "no")
                							->distinct('id')
                							->get();
                           @endphp
						<div> {{ count($users) }}</div>
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
              <div class="accordion-body ps-2">
                <ul>
					<li class="d-flex justify-content-between py-0">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="" onchange="this.form.submit()" name="ratingfilter"
									 checked>
							  <label class="form-check-label" for="defaultCheck1" >
								 <ul type="none" class=" p-0 m-0" style="float:left;">
					   <li>

<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
						  	<small>All</small>
					  </li>
				  </ul>
							  </label>
						</div>
					  </li>
					  <li class="d-flex justify-content-between py-0">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="4.5" onchange="this.form.submit()" name="ratingfilter"
									 @php if(isset($selectedRating) && ($selectedRating == '4.5')){ echo 'checked'; } @endphp
									 >
							  <label class="form-check-label" for="defaultCheck1" >
								 <ul type="none" class=" p-0 m-0" style="float:left;">
					   <li>

<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-half.png" width="18px" style="vertical-align: baseline;">
                           @php
                               $ratingVendor = DB::table('ratings')
                                    ->select([
                                        'vendor_id',
                                        DB::raw("SUM(rating) AS rating"),
                                        DB::raw("count(rating) AS totalrating"),
                                        DB::raw("SUM(rating)/count(rating) AS avg"),
                                    ])
                                    ->groupBy('vendor_id')
                                    ->get()
                                    ->toArray();
                               $ratings = collect($ratingVendor)->where('avg', '>=', '4.50')->all();
                               $ids = array_map(function($item) {
							    return $item->vendor_id;
								}, $ratings);

                               $users = DB::table('users')
						  	 ->whereIn('users.id', $ids)
			 				  ->where("disable_restaurant","=","no")
							 ->distinct('users.id')
							->get();

                           @endphp
						  	<small>4.5+ ({{ count($users) }})</small>
					  </li>
				  </ul>
							  </label>
						</div>
					  </li>
					  <li class="d-flex justify-content-between py-0">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="4.0" onchange="this.form.submit()" name="ratingfilter"
									  @php if(isset($selectedRating) && ($selectedRating == '4.0')){ echo 'checked'; } @endphp
									 >
							  <label class="form-check-label" for="defaultCheck1">
								 <ul type="none" class=" p-0 m-0" style="float:left;">
					   <li>

<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-unfilled.png" width="18px" style="vertical-align: baseline;">
                           @php
                               $ratingVendor = DB::table('ratings')
                                ->select([
                                    'vendor_id',
                                    DB::raw("SUM(rating) AS rating"),
                                    DB::raw("count(rating) AS totalrating"),
                                    DB::raw("SUM(rating)/count(rating) AS avg"),
                                ])
                                ->groupBy('vendor_id')
                                ->get()
                                ->toArray();
                           $ratings = collect($ratingVendor)->where('avg', '>=', '4.00')->all();
                           $ids = array_map(function($item) {
							    return $item->vendor_id;
								}, $ratings);

                               $users = DB::table('users')
						  	 ->whereIn('users.id', $ids)
			 				  ->where("disable_restaurant","=","no")
							 ->distinct('users.id')
							->get();
                           @endphp
			<small>4.0+ ({{ count($users) }})</small>
					  </li>
				  </ul>
							  </label>
						</div>
					  </li>

					  <li class="d-flex justify-content-between py-0">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="3.5" onchange="this.form.submit()" name="ratingfilter"
				 @php if(isset($selectedRating) && ($selectedRating == '3.5')){ echo 'checked'; } @endphp
				>
							  <label class="form-check-label" for="defaultCheck1">
								 <ul type="none" class=" p-0 m-0" style="float:left;">
					   <li>

<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-half.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-unfilled.png" width="18px" style="vertical-align: baseline;">
                           @php
                               $ratingVendor = DB::table('ratings')
                                   ->select([
                                       'vendor_id',
                                       DB::raw("SUM(rating) AS rating"),
                                       DB::raw("count(rating) AS totalrating"),
                                       DB::raw("SUM(rating)/count(rating) AS avg"),
                                   ])
                                   ->groupBy('vendor_id')
                                   ->get()
                                   ->toArray();
                              $ratings = collect($ratingVendor)->where('avg', '>=', '3.50')->all();
                              $ids = array_map(function($item) {
							    return $item->vendor_id;
								}, $ratings);

                               $users = DB::table('users')
						  	 ->whereIn('users.id', $ids)
			 				  ->where("disable_restaurant","=","no")
							 ->distinct('users.id')
							->get();
                           @endphp
						  	<small>3.5+ ({{ count($users) }})</small>
					  </li>
				  </ul>
							  </label>
						</div>
					  </li>

					  <li class="d-flex justify-content-between py-0">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="3.0" onchange="this.form.submit()" name="ratingfilter"
				 @php if(isset($selectedRating) && ($selectedRating == '3.0')){ echo 'checked'; } @endphp
				>
							  <label class="form-check-label" for="defaultCheck1">
								 <ul type="none" class=" p-0 m-0" style="float:left;">
					   <li>

<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-full.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-unfilled.png" width="18px" style="vertical-align: baseline;">
<img src="https://it.zeepup.com/front-end/images/leaf-unfilled.png" width="18px" style="vertical-align: baseline;">
                           @php
                               $ratingVendor = DB::table('ratings')
                                ->select([
                                    'vendor_id',
                                    DB::raw("SUM(rating) AS rating"),
                                    DB::raw("count(rating) AS totalrating"),
                                    DB::raw("SUM(rating)/count(rating) AS avg"),
                                ])
                                ->groupBy('vendor_id')
                                ->get()
                                ->toArray();
                           $ratings = collect($ratingVendor)->where('avg', '>=', '3.00')->all();
                           $ids = array_map(function($item) {
							    return $item->vendor_id;
								}, $ratings);

                               $users = DB::table('users')
						  	 ->whereIn('users.id', $ids)
			 				  ->where("disable_restaurant","=","no")
							 ->distinct('users.id')
							->get();
                           @endphp
						  	<small>3.0+ ({{ count($users) }})
					  </li>
				  </ul>
							  </label>
						</div>
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
                Sconto
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree">
              <div class="accordion-body">
                <ul>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="5" onchange="this.form.submit()" name="price"  @php if(isset($selectedPrice) && ($selectedPrice == '5')){ echo 'checked'; } @endphp>
							  <label class="form-check-label ps-1" for="defaultCheck1">
								0 - 5%
							  </label>
						</div>
                          @php
                              $user_ids = \App\Models\Items::where('availability' ,'=','yes')->whereBetween('discount', [0, 5])->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', 1), '%m/%d/%Y'), '%Y-%m-%d') )"), "<=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', -1), '%m/%d/%Y'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where('deleted', 'no')->groupBy('user_id')->select('user_id')->get();
                              $users = \App\Models\User::whereIn("id", $user_ids)->where("disable_restaurant","=","no")
                						->distinct('id')
                						->get();
                          @endphp
						<div>{{ count($users) }}</div>
					  </li>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="10" onchange="this.form.submit()" name="price" @php if(isset($selectedPrice) && ($selectedPrice == '10')){ echo 'checked'; } @endphp>
							  <label class="form-check-label ps-1" for="defaultCheck1">
								0 - 10%
							  </label>
						</div>
                          @php
                              $user_ids = \App\Models\Items::where('availability' ,'=','yes')->whereBetween('discount', [0, 10])
                              ->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', 1), '%m/%d/%Y'), '%Y-%m-%d') )"), "<=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', -1), '%m/%d/%Y'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where('deleted', 'no')->groupBy('user_id')->select('user_id')->get();
                              $users = \App\Models\User::whereIn("id", $user_ids)->where("disable_restaurant","=","no")
                						->distinct('id')
                						->get();
                          @endphp
                          <div>{{ count($users) }}</div>
					  </li>
					  <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="15" onchange="this.form.submit()" name="price" @php if(isset($selectedPrice) && ($selectedPrice == '15')){ echo 'checked'; } @endphp>
							  <label class="form-check-label ps-1" for="defaultCheck1">
								0 - 15%
							  </label>
						</div>
                          @php
                              $user_ids = \App\Models\Items::where('availability' ,'=','yes')->whereBetween('discount', [0, 15])
                              ->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', 1), '%m/%d/%Y'), '%Y-%m-%d') )"), "<=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', -1), '%m/%d/%Y'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where('deleted', 'no')->groupBy('user_id')->select('user_id')->get();
                              $users = \App\Models\User::whereIn("id", $user_ids)->where("disable_restaurant","=","no")
                						->distinct('id')
                						->get();
                          @endphp
                          <div>{{ count($users) }}</div>
					  </li>
					<li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="25" onchange="this.form.submit()" name="price" @php if(isset($selectedPrice) && ($selectedPrice == '25')){ echo 'checked'; } @endphp>
							  <label class="form-check-label ps-1" for="defaultCheck1">
								0 - 25%
							  </label>
						</div>
                        @php
							$user_ids = \App\Models\Items::where('availability' ,'=','yes')->whereBetween('discount', [0, 25])
                              ->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', 1), '%m/%d/%Y'), '%Y-%m-%d') )"), "<=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', -1), '%m/%d/%Y'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where('deleted', 'no')->groupBy('user_id')->select('user_id')->get();
                              $users = \App\Models\User::whereIn("id", $user_ids)->where("disable_restaurant","=","no")
                						->distinct('id')
                						->get();
                        @endphp
                        <div>{{ count($users) }}</div>
					  </li>
					<li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="50" onchange="this.form.submit()" name="price" @php if(isset($selectedPrice) && ($selectedPrice == '50')){ echo 'checked'; } @endphp>
							  <label class="form-check-label ps-1" for="defaultCheck1">
								0 - 50%
							  </label>
						</div>
                        @php
                            $user_ids = \App\Models\Items::where('availability' ,'=','yes')->whereBetween('discount', [0, 50])
                              ->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', 1), '%m/%d/%Y'), '%Y-%m-%d') )"), "<=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', -1), '%m/%d/%Y'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where('deleted', 'no')->groupBy('user_id')->select('user_id')->get();
                              $users = \App\Models\User::whereIn("id", $user_ids)->where("disable_restaurant","=","no")
                						->distinct('id')
                						->get();
                        @endphp
                        <div>{{ count($users) }}</div>
					  </li>
					<li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" value="75" onchange="this.form.submit()" name="price" @php if(isset($selectedPrice) && ($selectedPrice == '75')){ echo 'checked'; } @endphp  >
							  <label class="form-check-label ps-1" for="defaultCheck1">
								0 - 75%
							  </label>
						</div>
                        @php
                            $user_ids = \App\Models\Items::where('availability' ,'=','yes')->whereBetween('discount', [0, 75])
                              ->where(DB::raw("if(expire_date is null, CURDATE(), date_format(str_to_date(expire_date, '%Y-%m-%d'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', 1), '%m/%d/%Y'), '%Y-%m-%d') )"), "<=", date("Y-m-d"))
                              ->where(DB::raw("if(date_range is null, CURDATE(), date_format(str_to_date(SUBSTRING_INDEX(date_range, ' - ', -1), '%m/%d/%Y'), '%Y-%m-%d') )"), ">=", date("Y-m-d"))
                              ->where('deleted', 'no')->groupBy('user_id')->select('user_id')->get();
                              $users = \App\Models\User::whereIn("id", $user_ids)->where("disable_restaurant","=","no")
                						->distinct('id')
                						->get();
                        @endphp
                        <div>{{ count($users) }}</div>
					  </li>
				  </ul>
              </div>
            </div>
          </div>
			<div class="accordion-item">
				<div class="accordion-body">
					<button class="filter-btn" name="resetbtn" value="resetbtn" type="submit">Cancella Filtri</button>
			</div>

        </div>
				</div>
			</form>
      </div>
    </div>
  </div>

  {{-- Category end--}}


@push('front-scripts')
<script>
	$("#show-filters-btn").click(function(){
	  $(".filter_col").addClass("show");
	});
	$("#hide-filters-btn").click(function(){
	  $(".filter_col").removeClass("show");
	});


</script>

				<script>

  $(function() {
    $('#location-input').keyup(function() {
        var query = $(this).val();

        $.ajax({
            url: '/get-locations',
            method: 'GET',
            data: { query: query },
            success: function(response) {
                console.log(response);

                var locationList = $('#location-list');
                locationList.empty();

                locationList.removeClass('d-none');

                response.forEach(function(location) {
                    var li = $('<li>');
                    li.html(location.address);
                    li.on('click', function() {
                        locationList.addClass('d-none');
                        var selectedLocation = $(this).text();
                        $('#location-input').val(selectedLocation);
                    });
                    locationList.append(li);
                });
            },

        });
    });
});

</script>

<script>
    $(document).ready(function() {
        $('#search-form').submit(function(e) {
            e.preventDefault();
            var location = $('#location-input').val();
            $.ajax({
                url: "{{ route('search_vendor') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    vendor_location: location
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {

						$("#search-form").off('submit');

						$("#search-form").submit();
						$('#submit').trigger('click');
						//document.getElementById("search-form").submit();
                        // If vendors found, redirect to next page

                    } else {
						e.preventDefault();
                        // If no vendors found, display message
                        if (response.message) {
                            $('#search-results').html(response.message);
                        }
                    return false;
					}
                }
            });
        });
    });
	$('.owl-carousel').owlCarousel({
    loop:true,
		autoplay:true,
    margin:16,
    nav:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        750:{
            items:4
        },
        800:{
            items:5
        },
        1000:{
            items:6
        }
    }
		  });
</script>
@endpush
@endsection
