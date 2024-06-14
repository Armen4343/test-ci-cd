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
<style>
	.login-input{
    padding: 5px 0px 5px 7px;
    display: block;
    padding: 10px;
    background-color: white !important;
		width: 100%;
	}
	
</style>

</head>
	<!--begin::Body-->
	<body>
    <!-- (((((((((((((((((((((((       navbar      ))))))))))))))))))))))) -->
    <nav class="navbar py-2">
        <div class="container-fluid">
        <div>
            <button class="navbar-toggler nav-icon border-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" style="vertical-align: bottom;margin-top: 1px;">
                <div><i class="fa-solid fa-bars border-none"></i>
                </div>
            </button>
            <a class="flex-start " style="vertical-align: text-bottom;" href="{{ route('home') }}"><img src="{{ secure_asset('front-end/images/logo.png') }}" alt="" class="nav-logo"></a>

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

		<!--begin::Main-->
		<!--begin::Root-->
		<div class="container-fluid">

		<div class="row">
			<!--begin::Authentication - Sign-in -->
			<div class="col-md-6">
				<!--begin::Content-->
				
					
					<!--begin::Wrapper-->
					<div class="p-5 shadow">
				
						
                        
						<form action="{{ route('register') }}" method="POST" class="validatedForm" enctype="multipart/form-data">
                            @csrf  
                            <!--begin::Form-->
            @if ($errors->any())
            <div class="alert alert-danger pb-0">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif        
                            <div class="row">
                
                              <div class="form-group my-2 col-md-6">
                                <label for="">Name : <span class="required"></span></label>
                                <input placeholder="Please enter name" type="text" name="name"  class="login-input shadow" required>
                
                              </div>
                
                              <div class="form-group my-2 col-md-6">
                                <label>Buisness Email : <span class="required"></span></label>
                                <input  required type="text" name="email" placeholder="demo@demo.com" class="login-input shadow">
                              </div>
                
                              <div class="form-group my-2 col-md-6">
                                <label for="">Phone :</label>
                                <input placeholder="+1-000-000-0000" required type="tel" value="+1" name="phone" pattern="[+]{1}[0-1]{1}-[0-9]{3}-[0-9]{3}-[0-9]{4}" class="login-input shadow" title="e.g: +1-000-000-0000">
                              </div>
                              <div class="form-group my-2 col-md-6">
                                <label>
                                    Country : <span class="required"></span>
                                  </label>
                                <select id="country" required class="login-input shadow" name="country">
                                    <option value="US" selected>United States</option>
                                </select>
                              </div>
                
                              <div class="form-group my-2 col-md-6">
                                <label>
                                    State : <span class="required"></span>
                                  </label>
                                <select onchange="filterCities(this)" name="state" required class="login-input shadow">
                                  <option value="Alabama" data-id="1456">Alabama</option>
                                  
                                  <option value="Alaska" data-id="1400">Alaska</option>
                                  
                                  <option value="American Samoa" data-id="1424">American Samoa</option>
                                  
                                  <option value="Arizona" data-id="1434">Arizona</option>
                                  
                                  <option value="Arkansas" data-id="1444">Arkansas</option>
                                  
                                  <option value="Baker Island" data-id="1402">Baker Island</option>
                                  
                                  <option value="California" data-id="1416">California</option>
                                  
                                  <option value="Colorado" data-id="1450">Colorado</option>
                                  
                                  <option value="Connecticut" data-id="1435">Connecticut</option>
                                  
                                  <option value="Delaware" data-id="1399">Delaware</option>
                                  
                                  <option value="District of Columbia" data-id="1437">District of Columbia</option>
                                  
                                  <option value="Florida" data-id="1436">Florida</option>
                                  
                                  <option value="Georgia" data-id="1455">Georgia</option>
                                  
                                  <option value="Guam" data-id="1412">Guam</option>
                                  
                                  <option value="Hawaii" data-id="1411">Hawaii</option>
                                  
                                  <option value="Howland Island" data-id="1398">Howland Island</option>
                                  
                                  <option value="Idaho" data-id="1460">Idaho</option>
                                  
                                  <option value="Illinois" data-id="1425">Illinois</option>
                                  
                                  <option value="Indiana" data-id="1440">Indiana</option>
                                  
                                  <option value="Iowa" data-id="1459">Iowa</option>
                                  
                                  <option value="Jarvis Island" data-id="1410">Jarvis Island</option>
                                  
                                  <option value="Johnston Atoll" data-id="1428">Johnston Atoll</option>
                                  
                                  <option value="Kansas" data-id="1406">Kansas</option>
                                  
                                  <option value="Kentucky" data-id="1419">Kentucky</option>
                                  
                                  <option value="Kingman Reef" data-id="1403">Kingman Reef</option>
                                  
                                  <option value="Louisiana" data-id="1457">Louisiana</option>
                                  
                                  <option value="Maine" data-id="1453">Maine</option>
                                  
                                  <option value="Maryland" data-id="1401">Maryland</option>
                                  
                                  <option value="Massachusetts" data-id="1433">Massachusetts</option>
                                  
                                  <option value="Michigan" data-id="1426">Michigan</option>
                                  
                                  <option value="Midway Atoll" data-id="1438">Midway Atoll</option>
                                  
                                  <option value="Minnesota" data-id="1420">Minnesota</option>
                                  
                                  <option value="Mississippi" data-id="1430">Mississippi</option>
                                  
                                  <option value="Missouri" data-id="1451">Missouri</option>
                                  
                                  <option value="Montana" data-id="1446">Montana</option>
                                  
                                  <option value="Navassa Island" data-id="1439">Navassa Island</option>
                                  
                                  <option value="Nebraska" data-id="1408">Nebraska</option>
                                  
                                  <option value="Nevada" data-id="1458">Nevada</option>
                                  
                                  <option value="New Hampshire" data-id="1404">New Hampshire</option>
                                  
                                  <option value="New Jersey" data-id="1417">New Jersey</option>
                                  
                                  <option value="New Mexico" data-id="1423">New Mexico</option>
                                  
                                  <option value="New York" data-id="1452">New York</option>
                                  
                                  <option value="North Carolina" data-id="1447">North Carolina</option>
                                  
                                  <option value="North Dakota" data-id="1418">North Dakota</option>
                                  
                                  <option value="Northern Mariana Islands" data-id="1431">Northern Mariana Islands</option>
                                  
                                  <option value="Ohio" data-id="4851">Ohio</option>
                                  
                                  <option value="Oklahoma" data-id="1421">Oklahoma</option>
                                  
                                  <option value="Oregon" data-id="1415">Oregon</option>
                                  
                                  <option value="Palmyra Atoll" data-id="1448">Palmyra Atoll</option>
                                  
                                  <option value="Pennsylvania" data-id="1422">Pennsylvania</option>
                                  
                                  <option value="Puerto Rico" data-id="1449">Puerto Rico</option>
                                  
                                  <option value="Rhode Island" data-id="1461">Rhode Island</option>
                                  
                                  <option value="South Carolina" data-id="1443">South Carolina</option>
                                  
                                  <option value="South Dakota" data-id="1445">South Dakota</option>
                                  
                                  <option value="Tennessee" data-id="1454">Tennessee</option>
                                  
                                  <option value="Texas" data-id="1407">Texas</option>
                                  
                                  <option value="United States Minor Outlying Islands" data-id="1432">United States Minor Outlying Islands</option>
                                  
                                  <option value="United States Virgin Islands" data-id="1413">United States Virgin Islands</option>
                                  
                                  <option value="Utah" data-id="1414">Utah</option>
                                  
                                  <option value="Vermont" data-id="1409">Vermont</option>
                                  
                                  <option value="Virginia" data-id="1427">Virginia</option>
                                  
                                  <option value="Wake Island" data-id="1405">Wake Island</option>
                                  
                                  <option value="Washington" data-id="1462">Washington</option>
                                  
                                  <option value="West Virginia" data-id="1429">West Virginia</option>
                                  
                                  <option value="Wisconsin" data-id="1441">Wisconsin</option>
                                  
                                  <option value="Wyoming" data-id="1442">Wyoming</option>
                                </select>
                              </div>
                
                              <div class="form-group my-2 col-md-6">
                            <!-- Alabama-->
                            <label>
                                City : <span class="required"></span>
                              </label>
                                <select id="city" required class="login-input shadow cities-tb" name="city">

                                </select> 
                            </div>
                              <div class="col-md-12 ">
                                <div class="row">
                                  <div class="form-group my-2 col-md-6">
                                    <label for="">Password : <span class="required"></span></label>
                                    <div class="input-group">
                                      <input name="password" required type="password" id="password" class="login-input shadow" autocomplete="current-password" placeholder="Enter new password">
                                    
                                    </div>
                                  </div>
                                  <div class="form-group my-2 col-md-6">
                                    <label for="">Confirm Password : <span class="required"></span></label>
                                    <div class="input-group">
                                      <input placeholder="Enter password again to confirm" id="password_confirm" type="password" required name="password_confirm" class="login-input shadow">
                                     
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group my-2 col-md-6">
                                <label for="exampleInputSlug"> Choose Profile picture :<sup class="redstar text-danger">*</sup></label><br>
                                <div class="input-group mb-3">
                                  <div class="custom-file">
                                    <input type="file" required class="login-input shadow" name="profile" class="custom-file-input" >
                                    
                                  </div>
                                </div>
                              </div>
                
                            <div class="form-group my-2 ">
                              
                              <button type="reset"  class="btn hero-section-btn shadow w-25 m-0 p-0" style="height:3rem;"><i class="fa fa-refresh"></i> Reset</button>
                               
                                  
                              <button type="submit" class="btn hero-section-btn shadow w-25 m-0 p-0" style="height:3rem;"><i class="fa fa-check-circle"></i>
                                Register</button>
                               
                                
                            </div>
                
                        </form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				
				<!--end::Content-->
				
			</div>
			<div class="col-md-6 ">
      <div class="auth-bg p-5">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		
		</div>
		<!--end::Root-->

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



	  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/lokijs@^1.5/build/lokijs.min.js"></script>
    <script src="{{ secure_asset('front-end/js/app.js') }}"></script>
		<script>
			$(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
        });
		</script>
  
</body>

</html>
