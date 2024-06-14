@extends('layouts.front.master')

@section('front')
@push('front-styles')
<style>
  
  body {
      overflow-x: hidden;
    }
  .all-store-col {

/* width: 110px; */
/* height: 100vh;*/
/* overflow-y: scroll !important; */
/* overflow-x: hidden;  */

/* position: fixed; */


}

.accordion-button:not(.collapsed) {
/* color: white !important; */
background-color: white !important;
/* box-shadow: inset 0 calc(-1 * var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color); */
}

.accordion-button:focus {
box-shadow: none !important;
}


.button-text {
color: black !important;
font-size: 1.3rem !important;
font-weight: bold;
}

.radio-label,
.switch-label {
font-size: 1.1rem !important;
font-weight: bold;
}

.form-check-input:checked {
background-color: black !important;
color: black !important;
box-shadow: none !important;
border: 4px solid black !important;
}

.form-check-input:focus {
box-shadow: none;
color: black !important;
}

.uber-eats .form-check .form-check-input {
float: right;
}

.custom-card {
border: none !important;
}

.custom-card .card-body .btn {
--bs-btn-padding-x: 0.21rem !important;
--bs-btn-padding-y: 0.1rem !important;
}

.custom-card .custom-card-img {
width: 100% !important;
height: 12rem !important;
}

.custom-card-img-div {
width: 100%;
height: 160px;
background-image: url('https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC84OTA4YmUyNS1lNDY0LTRiNjAtOTk3Yi03ZDI2YjYwNjc2ZjAuanBlZw==');
background-size: cover;
/* background-repeat: no-repeat; */
}



.favourite i {
color: white;
}

i:hover {
color: white;
fill: white;
}

.custom-card .favourite {
right: 4%;
top: 4%;
}

.custom-card .btn-circle {
background-color: #EEEEEE;
}

.custom-card .offer {
background-color: #05A357;
color: white;
font-weight: bold;
width: 50%;
border-radius: 0px 20px 20px 0px;
padding: 1px 2px 1px 2px;
position: absolute;
top: 10%;
}

.items-column {
margin-left: 25%;
}

.show-all-store {
display: none;
width: 50%;

}




/* MEDIA QUERIES */
@media (max-width:776px) {
.all-store-col {
  display: none;
}

.items-column {
  margin-left: auto;
}

.show-all-store {
  display: block;
  z-index: 9;
}

}
</style>
@endpush
  {{-- Category start--}}
  <div class="contaniner-fluid front-main">
    <!-- All Store Data -->
    <button class="btn  btn-danger show-all-store" onclick="hideColumn()">hie All Store</button>
    <button class="btn  btn-danger show-all-store" onclick="showColumn()">Show All Store</button>
    <div class="row p-3 ">
      

      <!-- Next Column Items -->
      <div class="col-md-9 mt-md-5">
        <div class="row">
          <!-- First Col -->
          <div class="col-lg-4 col-md-6">
            <!-- Simple Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">
              </div>
              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
              <button type="button" class="btn  offer">
                Buy 1,Get 1 Free
              </button>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Simple Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">
              </div>
              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Simple Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">
              </div>
              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Simple Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">
              </div>
              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Simple Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">
              </div>
              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Simple Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">
              </div>
              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Simple Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">
              </div>
              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Simple Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">
              </div>
              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">

              </div>

              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <!-- Offer Card -->
            <div class="card custom-card position-relative" style="width: auto;">
              <div class="custom-card-img-div">

              </div>

              <div class="card-body d-flex  justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Ben's Cookies</h5>
                  <p class="card-text">💰1.29 Delievery Fee <span class="text-muted">.10-15 min</span></p>
                </div>
                <div>
                  <a href="#" class="btn   rounded-circle btn-circle">4.7</a>
                </div>
              </div>
              <span class="favourite position-absolute"><i class="fa-regular fa-heart"></i></span>
              <button type="button" class="btn  offer">
                Buy 1,Get 1 Free
              </button>
            </div>
          </div>
        </div>

      </div>
		<div class="col-md-3 all-store-col" id="all-store">
        <h2 class="">All Stores </h2>
        <!-- Accordian -->
        <div class="accordion" id="accordionExample">

          <!-- Sort -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class=" accordion-button button-text" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Sort
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
              <div class="accordion-body">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label radio-label" for="flexRadioDefault1">
                    Picked for you (default)
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                  <label class="form-check-label radio-label" for="flexRadioDefault2">
                    Most popular
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input " type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                  <label class="form-check-label radio-label" for="flexRadioDefault3">
                    Rating

                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                  <label class="form-check-label radio-label" for="flexRadioDefault4">
                    Delivery Time
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Form Uber Eats -->
          <div class="accordion-item uber-eats">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button button-text" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                ZeepUP
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
              <div class="accordion-body d-flex flex-column gap-3">
                <div class="form-check form-switch p-0">
                  <label class="form-check-label switch-label" for="flexSwitchCheckDefault"><i
                      class="fa-solid fa-medal"></i> Deals</label>
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                </div>
                <div class="form-check form-switch p-0">
                  <label class="form-check-label switch-label" for="flexSwitchCheckDefault"><i
                      class="fa-solid fa-medal"></i>
                    Top Eats</label>
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                </div>

              </div>
            </div>
          </div>

          <!-- Dietar -->

          <div class="accordion-item">
            <h2 class="accordion-header dietary" id="headingThree">
              <button class="accordion-button button-text" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                Dietary
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree">
              <div class="accordion-body d-flex flex-column justify-content-space-between">
                <div class="d-flex gap-2">
                  <button type="button" class="btn btn-light  rounded-pill fw-bolder">
                    <span class="badge text-bg-light "><i class="fa-solid  fa-medal"></i> </span> Vegetarian
                  </button>
                  <button type="button" class="btn btn-light  rounded-pill fw-bolder">
                    <span class="badge text-bg-light "><i class="fa-solid  fa-medal"></i> </span> Vegan
                  </button>
                </div>
                <div class="d-flex gap-2 mt-3">
                  <button type="button" class="btn btn-light  rounded-pill fw-bolder">
                    <span class="badge text-bg-light "><i class="fa-solid  fa-medal"></i> </span> Gluten-free
                  </button>
                  <button type="button" class="btn btn-light  rounded-pill fw-bolder">
                    <span class="badge text-bg-light "><i class="fa-solid  fa-medal"></i> </span> Halal
                  </button>
                </div>
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
        <h3>Cookies Consent</h3>
      </div>
      <div class="info">
        <p>
          This website use cookies to help you have a superior and more relevant
          browsing experience on the website.
        </p>
        <a href="#" class="terms-link">Terms and conditions</a>
      </div>
      <div class="buttons">
        <button class="button" id="acceptBtn">Accept</button>
        <button class="button" style="color: black;background: white;">Decline</button>
      </div>
    </div>

@endsection    