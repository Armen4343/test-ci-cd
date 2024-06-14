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
	 .badge{
	  position: absolute;
	  top: 5px;
	  right: 5px;
	  border-radius: 20px !important;
	  z-index: 10;
	  background-color: #ff0066 !important;
	  color: #fff !important;
	  padding:10px 10px 10px;
	 }
	 .category-image{
		width: 100%;
		height:12rem;
	 }
</style>

    <div class="hero-section">
        <div class="hero-section-content ">
            <strong class="hero-section-title">Esplora le offerte intorno a te</strong>
			<div  id="search-results" style="color:#ff0065;"></div>
            <div class="hero-section-main-div ">
           <div class="hero-section-input-div">
    <i class="location fa-solid fa-location-dot bg-white ps-1 pt-1 pe-1"></i>
    <form id="search-form" action="{{route('search_vendor')}}" method="post">

        @csrf
    <input id="location-input" type="text" name="vendor_location" value="" placeholder="Inserisci la tua posizione" class="hero-section-input">

</div>
               <!-- <div class="dropdown">
                    <button class="dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-clock "></i> Collect Now </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fa-sharp fa-solid fa-basket-shopping"></i>
                                Collect</a></li>
                        <li><a class="dropdown-item" href="#"> <i class="fa-solid fa-calendar-days"></i> Schedule to collect
                                later</a></li>
                    </ul>
                </div>-->
                <button id="submit" type="submit" class="hero-section-btn">Cerca</button>
			       </form>
				
            </div>
            <ul id="location-list" class="list-unstyled"></ul>
            <p class="mt-4" class="hero-section-text">
                <a href="{{route('login')}}" style="text-decoration: none; color: #ff0066; padding-bottom: 4px; border-bottom: 0.1rem solid black;">Accedi
                   
                </a>
                per i tuoi indirizzi recenti
            </p>
        </div>

      
        
  <img src="@if(isset($homePageBanner->id)) {{asset($homePageBanner->banner_name)}} @else {{ asset('front-end/images/home-page-banner-image.png')}} @endif" alt="image" alt="" class="hero-section-images1">
     
    </div>


	
 <div class="container">
 	<div class="row">   
		<div class="col-12">
			<h2><strong>Categorie </strong></h2>
		</div>
       @foreach($categories as $category)
		
		<div class="col-md-4 col-lg-3">
		 <div style="position: relative;">
			 @php
			 $discount = App\Models\Items::where('category_id', $category->id)->max('discount');
			 @endphp
			 @if($discount) 
			<h5 class="badge bg-warning text-dark">{{$discount}}&percnt;</h5>
			 @endif
			<div class="product">
			  <a href="{{route('category-restaurants',$category->id)}}">
				  <img src="{{ asset($category->image) }}" class="category-image"></a>
				<a href="{{route('category-restaurants',$category->id)}}" class="text-dark" style="text-decoration:none;">
					<h3 class="slider-title text-capitalize">{{$category->title}}</h3></a>
			  <p class="slider-text">{{$category->description}}</p>
			</div>
		  </div>
        </div>
		@endforeach
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
