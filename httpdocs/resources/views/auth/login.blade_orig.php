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
						<!--begin::Logo-->
					
					<!--end::Logo-->
						<!--begin::Form-->
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
												@if(session()->has('message'))
										<div class="alert alert-success">
												{{ session()->get('message') }}
										</div>
								@endif
                        
						<form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate" autocomplete="off" name="login">
                            
                            @csrf
                            <!--begin::Heading-->
							<div class="text-center mb-3">
								<!--begin::Title-->
								<h2 class="text-dark mb-3">Sign In </h2>
								<!--end::Title-->
								
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-3">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input class="login-input shadow" name="email" placeholder="Enter email address" :value="old('email')"  type="text" autocomplete="off" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-3">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									<!--end::Label-->
									
								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input class="login-input shadow" type="password" placeholder="Enter password" name="password"  autocomplete="off" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->

                            <div class="text-danger">
                                <x-jet-validation-errors class="mb-4" />
                            </div>

							<!--begin::Actions-->
							<div >
								<!--begin::Submit button-->
								<button type="submit" id="login-btn" class="btn hero-section-btn w-25 shadow m-0 p-0" style="height:3rem;">
									<span class="indicator-label"> <i class="fa-solid fa-user pe-2 login-icon"></i>Login</span>
									
								</button>
								
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				
				<!--end::Content-->
				
			</div>
			<div class="col-md-6 ">
				<p>
					A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.

				</p>
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
  
</body>

</html>
