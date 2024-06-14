@extends('layouts.front.master')

@section('front')
 <!-- (((((((((((((((((((((((       hero section      ))))))))))))))))))))))) -->

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
</style>

    <div class="hero-section">
        <div class="hero-section-content ">
            <strong class="hero-section-title">Explore the tastiest deals around you</strong>
			<div  id="search-results" style="color:#ff0065;"></div>
            <div class="hero-section-main-div ">
           <div class="hero-section-input-div">
    <i class="location fa-solid fa-location-dot bg-white ps-1 pt-1 pe-1"></i>
    <form id="search-form" action="{{route('search_vendor')}}" method="post">

        @csrf
    <input id="location-input" type="text" name="vendor_location" value="" placeholder="Enter your location" class="hero-section-input">

</div>
                <div class="dropdown">
                    <button class="dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-clock "></i> Collect Now </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fa-sharp fa-solid fa-basket-shopping"></i>
                                Collect</a></li>
                        <li><a class="dropdown-item" href="#"> <i class="fa-solid fa-calendar-days"></i> Schedule to collect
                                later</a></li>
                    </ul>
                </div>
                <button id="submit" type="submit" class="hero-section-btn">Find food</button>
			       </form>
				
            </div>
            <ul id="location-list" class="list-unstyled"></ul>
            <p class="mt-4" class="hero-section-text">
                <a href="#" style="text-decoration: none; color: #ff0066; padding-bottom: 4px; border-bottom: 0.1rem solid black;">Sign
                    in
                </a>
                for your recent addresses
            </p>
        </div>

      
        <img src="@if(isset($homePageBanner->id)) {{ ($homePageBanner->banner_name) }} @else {{'front-end/images/home-page-banner-image.png'}} @endif" alt="image" alt="" class="hero-section-images1">
     

    </div>



 <div class="slider-main-div">
   
    <div class="slider-section-row">
        <strong>Categories </strong>
        <a href="{{route('all.restaurants')}}" style="color: black; " class="mt-3">View all 
			{{count($cuisines)}} 
			Categories </a>
    </div>
    <section class="regular slider">     
       @foreach($categories as $category)
		 <div class="product-container">
			<h5 class="badge bg-warning text-dark">Collection Only</h5>
			<div class="product">
			  <a href="{{route('category-restaurants',$category->id)}}"><img src="{{ $category->image }}"></a>
				<a href="{{route('category-restaurants',$category->id)}}" class="text-dark" style="text-decoration:none;">
					<h3 class="slider-title text-capitalize">{{$category->title}}</h3></a>
			  <p class="slider-text">{{$category->description}}</p>
			</div>
        </div>
		@endforeach
        <!--<div class="product-container">
			<h5 class="badge bg-warning text-dark">Available for Delivery</h5>
			<div class="product">
			  <img src="{{ asset('front-end/images/slider-1.png') }}">
			  <h2 class="slider-title">Burgers.</h2>
			  <p class="slider-text">Choose your own toppings</p>
			</div>
		</div>-->
      </section>
</div>




    <!-- map section -->
    <div class="map-section">
        <div class="map-section-row">
            <strong>Restaurants near me </strong>
            <a href="" style="color: black; " class="mt-2">View all 50+ Restaurants</a>
        </div>
        <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d784286.9798988559!2d-74.6275161!3d39.837914!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c0fb959e00409f%3A0x2cd27b07f83f6d8d!2sNew%20Jersey%2C%20USA!5e0!3m2!1sen!2s!4v1675248019171!5m2!1sen!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                
        </div>
    </div>

    <!-- map text  section -->
    <div class="map-text-main-div">
        <div class="map-div  w-100">
            <div class="map-text-div ">
                <a href="">Alabama</a>
                <a href="">Alaska</a>
                <a href="">American Samoa</a>
                <a href="">Arizona</a>
                <a href="">Arkansas</a>
                <a href="">Baker Island</a>
				<a href="">California</a>
                <a href="">Colorado</a>
                <a href="">Connecticut</a>
                <a href="">Delaware</a>
                <a href="">District of Columbia</a>
                <a href="">Florida</a>
				<a href="">Georgia</a>
                <a href="">Guam</a>
                <a href="">Hawaii</a>
                <a href="">Howland Island</a>
                <a href="">Idaho</a>
            </div>
            <div class="map-text-div ">
				 <a href="">Illinois</a>
				<a href="">Indiana</a>
                <a href="">Iowa</a>
                <a href="">Jarvis Island</a>
                <a href="">Johnston Atoll</a>
                <a href="">Kansas</a>
                <a href="">Kentucky</a>
				<a href="">Kingman Reef</a>
                <a href="">Louisiana</a>
                <a href="">Maine</a>
                <a href="">Maryland</a>
                <a href="">Massachusetts</a>
                <a href="">Michigan</a>
				<a href="">Midway Atoll</a>
                <a href="">Minnesota</a>
                <a href="">Mississippi</a>
                <a href="">Missouri</a>
            </div>
        </div>
        <div class="map-div w-100">

            <div class="map-text-div ">
				<a href="">Montana</a>
                <a href="">Navassa Island</a>
				<a href="">Nebraska</a>
                <a href="">Nevada</a>
                <a href="">New Hampshire</a>
                <a href="">New Jersey</a>
                <a href="">New Mexico</a>
                <a href="">New York</a>
				<a href="">North Carolina</a>
                <a href="">North Dakota</a>
                <a href="">Northern Mariana Islands</a>
                <a href="">Ohio</a>
                <a href="">Oklahoma</a>
                <a href="">Oregon</a>
				<a href="">Palmyra Atoll</a>
                <a href="">Pennsylvania</a>
                <a href="">Puerto Rico</a>
            </div>
            <div class="map-text-div ">
				<a href="">Rhode Island</a>
                <a href="">South Carolina</a>
                <a href="">South Dakota</a>
				<a href="">Tennessee</a>
                <a href="">Texas</a>
                <a href="">United States Minor Outlying Islands</a>
                <a href="">United States Virgin Islands</a>
                <a href="">Utah</a>
                <a href="">Vermont</a>
				<a href="">Virginia</a>
                <a href="">Wake Island</a>
                <a href="">Washington</a>
                <a href="">West Virginia</a>
                <a href="">Wisconsin</a>
                <a href="">Wyoming</a>
            </div>
        </div>
    </div>
@push("front-scripts")
<script type="text/javascript">
    $(document).on('ready', function() {

            $(".regular").slick({
            dots: true,
            infinite: false,
            slidesToShow: 4,
            autoplaySpeed: 4000,
            speed: 3000,
            slidesToScroll: 4,
            autoplay: true,
            pauseOnHover: true,
            pauseOnFocus: true,

            responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 765,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

            ]


            }); 
       
            });
	   $(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
        });
	  
	  //pop up
	  $(window).on('load',function(){
		  setTimeout(function() {
			 if (!sessionStorage.getItem('shown-modal')){
					$('#wizardmodal').modal('show');
					sessionStorage.setItem('shown-modal', 'true');
				  }
		}, 3000);
		  
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
</script>




@endpush
@endsection