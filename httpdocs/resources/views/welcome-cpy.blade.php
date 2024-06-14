<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZeepUp</title>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ secure_asset('front-end/index.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('front-end/mediaquery.css') }}">
     <!-- ---- Boxicons CSS ---- -->
     <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('front-end/slick/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('front-end/slick/slick-theme.css') }}">


<style>
  

</style>

</head>

<body>
	
    <!-- (((((((((((((((((((((((       navbar      ))))))))))))))))))))))) -->
    <nav class="navbar py-2">
        <div class="container-fluid">
            <div>
            <button class="navbar-toggler nav-icon border-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" style="vertical-align: bottom;">
                <div><i class="fa-solid fa-bars border-none"></i>
                </div>
            </button>
            <a class="flex-start " style="text-align: bottom;" href="{{ route('home') }}"><img src="{{ secure_asset('front-end/images/logo.png') }}" alt="" class="nav-logo"></a>

            </div>
            <div class="flex-end ">
                <a href="{{ secure_url(route('login')) }} " class="login me-1 shadow  btn" style="text-decoration:none;color:black;">
                    <i class="fa-solid fa-user pe-2 bg-white login-icon"></i><span class="login-text bg-white">Log
                        in</span>
                </a>
                {{-- <button class="signup  ">Sign up</button> --}}
                <a href="{{route('register')}}" class="signup btn" style="text-decoration:none;color:white;">
                    Sign up
                </a>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header ">
                    <h5 class="offcanvas-title " id="offcanvasDarkNavbarLabel"> <img src="{{ secure_asset('front-end/images/logo.png') }}" alt=""
                            class="nav-logo-side"> </h5>
                    <button type="button" class="btn-close  btn-close-dark" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body  d-flex flex-column align-items-center  text-center">
                    <ul class="navbar-nav ">
                        <li class="nav-item"> <a class="nav-link" aria-current="page" href="#">Dashboard</a> </li>
                        <li class="nav-item"><a class="nav-link" href="home2.html">Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Get help</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Add your restaurant</a></li>
                       <!-- <li class="nav-item"><a class="nav-link" href="#">Sign up to deliver</a></li> -->
                        <li class="nav-item"> <a class="nav-link" href="#">Create a business account</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#">Promotions</a></li>
                    </ul>
                    <button class="signup-btn  shadow">Sign up</button>
                    <button class="login-btn me-1 shadow "><i class="fa-solid fa-user pe-2 bg-white "></i><span
                            class=" bg-white">Login</span></button>
                </div>
            </div>
        </div>
    </nav>


    <!-- (((((((((((((((((((((((       hero section      ))))))))))))))))))))))) -->
    <div class="hero-section">
        <div class="hero-section-content ">
            <strong class="hero-section-title">Order food to your door</strong>
            <div class="hero-section-main-div ">
                <div class="hero-section-input-div">
                    <i class=" location fa-solid fa-location-dot  bg-white  ps-1 pt-1 pe-1"></i>
                    <input type="text" placeholder="Enter delivery address" class="hero-section-input">
                </div>
                <div class="dropdown">
                    <button class="dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-clock "></i> Deliver now </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fa-sharp fa-solid fa-basket-shopping"></i>
                                Collect</a></li>
                        <li><a class="dropdown-item" href="#"> <i class="fa-solid fa-calendar-days"></i> Schedule for
                                later</a></li>
                    </ul>
                </div>
                <button class="hero-section-btn">Find food</button>
            </div>
            <p class="mt-4" class="hero-section-text">
                <a href="#" style="text-decoration: none; color: #707070; padding-bottom: 4px; border-bottom: 0.1rem solid black;">Sign
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
        <a href="" style="color: black; " class="mt-3">View all {{count($categories)>100? "100+" : count($categories)}} Categories </a>
    </div>
    <section class="regular slider">     
       @foreach($categories as $category)
		 <div class="product-container">
			<h5 class="badge bg-warning text-dark">Collection Only</h5>
			<div class="product">
			  <img src="{{ $category->image }}">
			  <h3 class="slider-title">{{$category->title}}</h3>
			  <p class="slider-text">{{$category->description}}</p>
			</div>
        </div>
		@endforeach
        <!--<div class="product-container">
			<h5 class="badge bg-warning text-dark">Available for Delivery</h5>
			<div class="product">
			  <img src="{{ secure_asset('front-end/images/slider-1.png') }}">
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



    <!-- bg image sectinon -->

    <div class="bg-image">
        <div class="bg-image-div">
            <h1 class="bg-image-text">Stay In The Know</h1>
            <strong>Subscribe to our newsletter & don’t miss out on exclusive deals, offers & news from the Factory Shop
                !</strong>

            <div class="bg-image-input-div mt-3">
                <input type="email" placeholder="Enter Your Email Address" class="bg-image-input">
                <button type="submit" class="bg-image-btn"> Submit</button>
            </div>
        </div>
    </div>


    <!-- footer -->
    <div class="footer">
        <img src="{{ secure_asset('front-end/images/logo.png') }}" alt="" class="footer-logo">
        <div class="footer-div">
            <div class="footer-div-1">
                <p>A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.</p>
                <img src="{{ secure_asset('front-end/images/n_63bdc9b0f1e7c9e.png') }}" alt="" class="footer-div-logo">
                <img  src="{{ secure_asset('front-end/images/apple-bas.jpg') }}" alt="" class="footer-div-logo ">
            </div>
            <div class="footer-div-2">
                <a href=""> Get help</a>
                <a href="">Add your restaurant</a>
                <a href="">Sign up to deliver</a>
                <a href="">Create a business account</a>
                <a href="">Promotions</a>
            </div>
            <div class="footer-div-2">
                <a href=""> Restaurants near me</a>
                <a href="">View all cities</a>
                <a href="">View all countries</a>
                <a href="">Pick-up near me</a>
                <a href="">About ZeepUp</a>
                <a href="">English</a>
            </div>
        </div>  
    </div>

    
    <!-- last content -->
    <div class="footer-second">
        <div class="footer-icon-div">
            <div>
                <a href="" target="_blank"
                    style="text-decoration: none; color: black; font-size: 1.6rem; margin-left:6px;">
                    <i class="fa-brands fa-square-instagram"></i></a>
                <a href="" target="_blank"
                    style="text-decoration: none; color: black; font-size: 1.6rem; margin-left:6px;">
                    <i class="fa-brands fa-square-facebook"></i></a>
                <a href="" target="_blank"
                    style="text-decoration: none; color: black; font-size: 1.6rem; margin-left:6px;">
                    <i class="fa-brands fa-square-twitter"></i></a>      
            </div>
             <p class="footer-text">Privacy Policy Terms Pricing Do not sell or share my personal information</p>  
        </div>
        <p  class="footer-text">ZeepUp legal terms os service apply</p>
        <p  class="footer-text">© 2023 Mercato Family DE.</p>
    </div>


    <!--  Codes -->
   <div class="wrapper">
      <div class="title-box">
        <i class="bx bx-cookie"></i>
        <h3>Cookies Consent </h3>
      </div>
      <div class="info">
        <p>
          Il nostro sito utilizza cookie, compresi cookie analitici e di profilazione, al fine di raccogliere informazioni statistiche e per garantirti un’esperienza ottimizzata. Puoi accettare tutti i cookie oppure declinare rifiutando i cookie opzionali. Per maggiori informazioni consulta la nostra Cookie Policy.
        </p>
        <a href="#" class="terms-link">Terms and conditions</a>
      </div>
      <div class="buttons">
        <button class="button" id="acceptBtn">Accept</button>
        <button class="button" style="color: black;background: white;">Decline</button>
      </div>
    </div>
	 <!-- <button type="button" class="btn btn-primary py-3 px-4" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
							  Launch Modal 04
							</button>-->
	<div class="modal" id="wizardmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close d-flex align-items-center justify-content-center" data-bs-dismiss="modal" aria-label="Close">
		          <i class="fas fa-times"></i>
		        </button>
		      </div>
		      <div class="row gx-0">
			      <div class="col-md-6 d-flex">
				      <div class="modal-body p-5 img d-flex" style="background-image: url({{ secure_asset('front-end/images/bg-1.jpg') }});
																	background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;">
				      </div>
				    </div>
				    <div class="col-md-6 d-flex">
				      <div class="modal-body p-5 d-flex align-items-center">
				      	<div class="text w-100 py-5">
				      		<h2 class="mb-0">10<span>%</span> Off</h2>
				      		<h4 class="mb-4">All Restaurants on ZeeUp platform</h4>
				      		<form action="#" class="code-form">
		                <div class="form-group d-flex">
		                  <input type="text" class="form-control" placeholder="Enter Email">
		                </div>
								<div class="form-check mt-2">
									<input class="form-check-input mb-2" type="checkbox" value="" id="terms">
									<label class="form-check-label" for="terms">By claiming up you are opting for ZeeUp to reciev the email and agree to <a href="#">ZeeUp Privacy Policy</a> and <a href="#">Terms of Use</a>. Some Items may be excluded from promotions</label>
								</div>
						<button class="btn wizard-btn d-block py-3 w-100 mt-3">Claim Offer</buttton>
						<button class="btn btn-link d-block py-3 w-100 mt-3" data-bs-dismiss="modal">No, Thanks</buttton>
		              </form>
				      		
				      	</div>
				      </div>
				    </div>
				  </div>
		    </div>
		  </div>
		</div>
	
	

<script>
    // ---- ---- Const ---- ---- //
const cookiesBox = document.querySelector('.wrapper'),
  buttons = document.querySelectorAll('.button');

// ---- ---- Show ---- ---- //
const executeCodes = () => {
  if (document.cookie.includes('AlexGolovanov')) return;
  cookiesBox.classList.add('show');

  // ---- ---- Button ---- ---- //
  buttons.forEach((button) => {
    button.addEventListener('click', () => {
      cookiesBox.classList.remove('show');

      // ---- ---- Time ---- ---- //
      if (button.id == 'acceptBtn') {
        document.cookie =
          'cookieBy= AlexGolovanov; max-age=' + 60 * 60 * 24 * 30;
      }
    });
  });
};

window.addEventListener('load', executeCodes);

</script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{ secure_asset('front-end/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>

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
</body>

</html>
