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
    
    
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('front-end/slick/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('front-end/slick/slick-theme.css') }}">

</head>

<body>
    <!-- (((((((((((((((((((((((       navbar      ))))))))))))))))))))))) -->
    <div class="home2-main">
    <nav class="navbar  py-2">
        <div class="container-fluid">
            <button class="navbar-toggler nav-icon border-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"> 
                <div><i class="fa-solid fa-bars border-none"><img src="{{ secure_asset('front-end/images/logo.png') }}" alt="" class="nav-logo"></i>
                </div> 
            </button>
            <div class="flex-end ">
                <button class="login me-1 shadow  ">
                    <i class="fa-solid fa-user pe-2 bg-white login-icon"></i><span class="login-text bg-white">Log
                        in</span>
                </button>
                <button class="signup  ">Sign up</button>
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
                        <li class="nav-item"> <a class="nav-link" aria-current="page" href="index.html">Home</a> </li>
                        <li class="nav-item"><a class="nav-link" href="home2.html">Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Get help</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Add your restaurant</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Sign up to deliver</a></li>
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
    <!-- <div class="home2-main"> -->
        <div class="hero-section-content">
            <strong class="hero-section-title text-light">Order food to your door</strong>
            <div class="hero-section-main-div ">
                <div class="hero-section-input-div">
                    <i class=" location fa-solid fa-location-dot  bg-white  ps-1 pe-1"></i>
                    <input type="text" placeholder="Enter delivery address" class="hero-section-input">
                </div>
                <div class="dropdown">
                    <button class="dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-clock "></i> Deliver now </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fa-sharp fa-solid fa-basket-shopping"></i>
                                Collection only</a></li>
                        <li><a class="dropdown-item" href="#"> <i class="fa-solid fa-calendar-days"></i> Schedule for
                                later</a></li>
                    </ul>
                </div>
                <button class="hero-section-btn">Find food</button>
            </div>
            <p class="mt-4" class="hero-section-text text-light"  style="color: white ; font-size: 13px; font-weight: 600;">
                <a href="#"
                    style="text-decoration: none; color: white; padding-bottom: 4px;
                 border-bottom: 0.1rem solid black;"  >Sign in </a>  for your recent addresses
            </p>
        </div>
        <img src="{{ secure_asset('front-end/images/hero-section-1.png') }} " style="display: none;" alt="" class="hero-section-images1">
        <img src="{{ secure_asset('front-end/images/hero-section-2.png') }} " style="display: none;" alt="" class="hero-section-images2">
        <img src="{{ secure_asset('front-end/images/hero-section-3.png') }} " style="display: none;" alt="" class="hero-section-images3">
    </div>


  

    <!-- slider -->


   
 <div class="slider-main-div">
   
    <div class="slider-section-row">
        <strong>Categories </strong>
        <a href="" style="color: black; " class="mt-3">View all 100+ Categories </a>
    </div>
    <section class="regular slider">     
        <div>
          <img src="{{ secure_asset('front-end/images/slider-1.png') }}">
          <h3 class="slider-title">Burgers.</h3>
          <p class="slider-text">Variety of Burgers</p>
        </div>
        <div>
          <img src="{{ secure_asset('front-end/images/slider-2.png') }}">
          <h3 class="slider-title">Stir fry.</h3>
          <p class="slider-text">Stir fries recipients</p>
        </div>
        <div>
          <img src="{{ secure_asset('front-end/images/slider-3.png') }}">
          <h3 class="slider-title">Pizza.</h3>
          <p class="slider-text">A big selection of Pizza</p>
        </div>
        <div>
          <img src="{{ secure_asset('front-end/images/slider-2.png') }}">
          <h3 class="slider-title">Stir fry.</h3>  
          <p class="slider-text">Stir fry</p>
        </div>
        <div>
          <img src="{{ secure_asset('front-end/images/slider-3.png') }}">
          <h3 class="slider-title">Pizza.</h3>
          <p class="slider-text">Home made Pizzas</p>
        </div>
        <div>
          <img src="{{ secure_asset('front-end/images/slider-1.png') }}">
          <h2 class="slider-title">Burgers.</h2>
          <p class="slider-text">View our huge selection of Burgers</p>
        </div>
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
				<a href=""> Nordeste</a>
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
        <p  class="footer-text">Zeepup Legal Terms of Service apply</p>
        <p  class="footer-text">© 2023 Mercato Family DE.</p>
    </div>
   



  
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{ secure_asset('front-end/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>

  <script type="text/javascript">
    $(document).on('ready', function() {

$(".regular").slick({
  dots: false,
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  autoplay: true,
  autoplaySpeed: 2000,

    pauseOnHover: true,

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
          slidesToShow: 1,
          slidesToScroll: 1
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
  </script>
</body>

</html>
