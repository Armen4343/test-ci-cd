@extends('layouts.front.master')
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

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
						  <input type="text" placeholder="Enter your location" class="hero-section-input">
					  </div>
					  <div class="hero-section-input-div">
						  <i class="location fa-solid fa-magnifying-glass  bg-white  ps-1 pt-1 pe-1"></i>
						  <input type="text" placeholder="Search food, drinks etc" class="hero-section-input">
					  </div>
					 <a href="{{ route('cart.view') }}" id="view-cart-link">
  View Cart({{ array_sum(session('cart.items', [])) }})
</a>
					  <button class="hero-section-btn">Find food</button>
				  </div>
			  </div>
		  </div>
	  </div>
	  <div class="row p-3 position-relative">
  <div class="col-12">
    <img style="width:100%;height:380px;" src="https://it.zeepup.com/uploads/vendor/category/fullsizeoutput_ec71_1759639581836146.jpeg" style="width:100%">
  </div>
  <div class="col-12 position-absolute" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <img style="height: 200px; width: 200px; border-radius: 50%;" src="{{ asset( $vendorimage->profile_photo_path) }}">
  </div>
</div>

    <div class="row p-3 ">
      <!-- Next Column Items -->
      <div class="col-xl-10 col-lg-9 order-lg-1 order-2">
        <div class="row">
          <!--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
			  <div class="strip">
				  <figure>
					  <span class="ribbon off">-30%</span>
					  <img src="{{asset('front-end/images/pizza.jpg')}}" data-src="img/location_1.jpg" class="img-fluid lazy loaded" alt="" data-was-processed="true">
					  <a href="#" class="strip_info">
						  <small>Pizza</small>
						  <div class="item_title">
							  <h3>Da Alfredo Restaurant</h3>
							  <small>27 Old Gloucester St</small>
						  </div>
					  </a>
				  </figure>
				  <ul>
					  <li>
						  <img src="{{asset('front-end/images/leaf-full.png')}}" width="20px">
						  <img src="{{asset('front-end/images/leaf-full.png')}}" width="20px">
						  <img src="{{asset('front-end/images/leaf-full.png')}}" width="20px">
						  <img src="{{asset('front-end/images/leaf-full.png')}}" width="20px">
						  <img src="{{asset('front-end/images/leaf-half.png')}}" width="20px">
						  <strong>4.2 (180 ratings)</strong>
					  </li>
					  <li>
						  <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div>
					  </li>
				  </ul>
			  </div>
			</div>-->



@foreach($groupedItems as $cuisineName => $items)
<div class="section">
    <h2>{{ $cuisineName }}</h2>
    <div class="row">
        @foreach($items as $item)


            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="strip product">
                    <figure>
                        <span class="ribbon off">{{ $cuisineName }}</span>
                        <img src="{{ asset($item->image) }}" class="img-fluid lazy loaded" alt="" data-was-processed="true">



                        <a href="{{ route('cat_items',['id' => $item->id]) }}" class="strip_info">
                            <small id="price">{{ $item->price }}</small>
                            <div class="item_title">
                                <h3 id="name">{{ $item->name }}</h3>
                                <small></small>
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
                    <form class="add-to-cart-form">
                        <div class="input-group mb-3">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-outline-secondary btn-number" data-type="minus" data-field="quantity">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" name="quantity" class="form-control input-number" value="1" min="1" max="10">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus" data-field="quantity">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        <button class="btn_1 add_to_cart" data-id="{{ $item->id }}">Add to cart</button>
                    </form>
                </div>
            </div>
        @endforeach
        @endforeach








        </div>
      </div>
		<div class="col-xl-2 col-lg-3 order-lg-2 order-1">
			<div class="clearfix">
					<div class="sort_select">
							<select name="sort" id="sort">
                                <option value="popularity" selected="selected">Sort by Popularity</option>
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

					   <li class="d-flex justify-content-between">
						<div class="form-check form-check-inline">
							  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							  <label class="form-check-label" for="defaultCheck1">

							  </label>
						</div>
						<div>12</div>
					  </li>


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

  // Quantity input functionality
$('.btn-number').click(function(e) {
    e.preventDefault();

    var input = $(this).closest('.input-group').find('input[name="quantity"]');
    var type = $(this).attr('data-type');
    var currentVal = parseInt(input.val());

    if (!isNaN(currentVal)) {
        if (type == 'minus') {
            if (currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
        }
         else {
            if (currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
        }
    } else {
        input.val(1);
    }
});

// Handle input changes
$('input[name="quantity"]').change(function() {
    var input = $(this);
    var value = parseInt(input.val());

    if (isNaN(value) || value < input.attr('min')) {
        input.val(input.attr('min'));
    } else if (value > input.attr('max')) {
        input.val(input.attr('max'));
    }
});

// Add to cart functionality
// Add to cart functionality
$(document).on('click', '.add_to_cart', function (event) {
	    event.preventDefault();


    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var itemId = $(this).data('id');
    var quantity = $(this).closest('.product').find('input[name="quantity"]').val();

    var name = $(this).closest('.product').find('h3#name').text();
    var price = $(this).closest('.product').find('small#price').text();


    console.log("Add to cart clicked for item " + itemId + " with quantity " + quantity + " and name " + name);

    // Perform ajax call to add the item to the cart
    $.ajax({
        url: '/cart/add',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrfToken},
        data: {id: itemId, quantity: quantity,price:price,name:name},
        success: function(response) {
            console.log(response);
            alert('Item added to cart!');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            alert('Error adding item to cart');
        }
    });

    // Make Ajax request to server to add item to cart
    // $.ajax({
    //   url: '/cart/count',
    //   type: 'POST',
    //    headers: {'X-CSRF-TOKEN': csrfToken},
    //   data: { id: itemId },
    //   success: function(response) {
    //   	console.log(response);


    //     // Update view cart link with cart item count
    //     $('#view-cart-link').text('View Cart (' + response.itemCount + ')');
    //   },
    //   error: function(xhr, status, error) {
    //     // Handle error
    //   }
    // });

});



</script>
@endpush
@endsection


