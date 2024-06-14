 <!-- bg image sectinon -->
<!--elisaelisa
    <div class="bg-image">
        <div class="bg-image-div">
            <h1 class="bg-image-text">Mettiti in Contatto</h1>

            <div class="bg-image-input-div my-2">
				<div class="text-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
                <form action="" method="post" id="subscription-form">
					@csrf
					<input type="email" placeholder="Inserisci Indirizzo Email" class="bg-image-input" name="email">
                	<button type="submit" class="bg-image-btn"> Invia</button>
				</form>
				<h3 class="mt-4"><b><span style="color:#ff0066">Iscriviti alla nostra Newsletter  </span>per non perdere le offerte piú gustose</b></h3>
            </div>
{{--			<img src="{{asset('fork.png')}}" class="fork-img"/>--}}
{{--			<img src="{{asset('exclamation.png')}}" class="exclamtion-img"/>--}}
{{--			<img src="{{asset('glob.png')}}" class="glob-img"/>--}}
        </div>
    </div>
<div> 
	@php
	$frontPageimages = App\Models\FrontPageImages::firstOrNew();
	@endphp
	    <img src="{{ !empty($frontPageimages->image4) ? asset($frontPageimages->image4) : asset('assets/media/blank.jpg') }}" class="w-100"/>
</div> elisaelisa-->


    <!-- footer -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="social">
					<img src="{{asset('zeepup_circle_bottom.png')}}" class="bottom-circle">
					<div class="content">
						<img src="{{asset('./footer-logo.png')}}" class="footer-img">
						<div class="social-icons">
						<a href="https://www.instagram.com/zeepupitalia/" class="me-2"><img src="{{asset('zeepup_icon_instagram.png')}}"></a>
						<a href="https://www.facebook.com/profile.php?id=100093111542954" class="me-2"><img src="{{asset('zeepup_icon_facebook.png')}}"></a>
						<a href="https://twitter.com/ZeepupItalia"><img src="{{asset('zeepup_icon_twiter.png')}}"></a>
						</div>

					</div>

				</div>
			</div>
			<div class="col-md-6">
				<ul>
					<li>
						<a href="{{ route('register') }}">
							<h1 class="strip-heading">
							<b>Registrati</b> <br>
								<img src="{{asset('./zeepup_bottom_stripe_up.png')}}" class="strip-img">
							</h1>
						</a>
					</li>
					<li>
						<a href="#"  data-bs-toggle="modal" data-bs-target="#addRestaurantModal">
							<h1 class="strip-heading">
								<b>Aggiungi il tuo negozio</b><br>
								<img src="{{asset('./zeepup_bottom_stripe_down.png')}}" class="strip-img">
							</h1>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul>
					<li><a href="#" data-bs-toggle="modal" data-bs-target="#contactUsModal"><h5>Contattaci</h5></a></li>
                    @php
                        $termsAndConditions = App\Models\TermsAndConditions::first();
                    @endphp
					<li><a href="terms-and-conditions/{{$termsAndConditions['privacy_policy']}}" target="_blank"><h5>Informativa sulla privacy</h5></a></li>
					<li><a href="terms-and-conditions/{{$termsAndConditions['terms_and_condition']}}" target="_blank"><h5>Termini Legali</h5></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
 <!--Contact us model-->
<div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Contattaci</h5>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
				<!--Section: Contact v.2-->
<section class="mb-4">
@php
	$contactUs = \App\Models\contactUs::first();
@endphp
    <div class="row">

        <!--Grid column-->
        <div class="col-md-12 text-center">
			<div class="row">
				@if($contactUs->postal_code)
                <div class="col-md-4">
					<i class="main-color fas fa-map-marker-alt  mt-4  fa-2x"></i>
                    <p>{{ $contactUs->postal_code }}</p>
                </div>
				@endif
				@if($contactUs->address)
                <div class="col-md-4">
					<i class="main-color fas fa-map-marker-alt  mt-4  fa-2x"></i>
                    <p>{{ $contactUs->address }}</p>
                </div>
				@endif
				@if($contactUs->country)
                <div class="col-md-4">
					<i class="main-color fas fa-map-marker-alt  mt-4  fa-2x"></i>
                    <p>{{ $contactUs->country }}</p>
                </div>
				@endif
				@if($contactUs->email)
                <div class="col-md-4">
					<i class="main-color fas fa-envelope mt-4 fa-2x"></i>
                    <p>{{ $contactUs->email }}</p>
                </div>
				@endif
				@if($contactUs->phone1)
                <div class="col-md-4">
					<i class="main-color fas fa-phone mt-4 fa-2x"></i>
                    <p>{{ $contactUs->phone1 }}</p>
                </div>
				@endif
				@if($contactUs->phone2)
                <div class="col-md-4">
					<i class="main-color fas fa-phone mt-4 fa-2x"></i>
                    <p>{{ $contactUs->phone2 }}</p>
                </div>
				@endif

        	</div>
        </div>
        <!--Grid column-->
		<hr/>
        <div class="col-md-12">
			<h5 class="text-center">Hai bisogno di noi? </h5>
    <p class="text-center w-responsive mx-auto mb-5">Il team ZeepUp e' a tua disposizione per qualsiasi domanda.</p>
		</div>
        <!--Grid column-->
        <div class="col-md-12 mb-md-0 mb-5">
            <form id="contact-us-form" name="contact-form" action="{{ route('contact.us') }}" method="POST">
@csrf
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="main-color">Nome e Cognome</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="main-color">Email</label>
                            <input type="text" id="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="main-color">Soggetto</label>
                            <input type="text" id="subject" name="subject" class="form-control" required>
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <label for="message" class="main-color">Il tuo Messaggio</label>
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" required></textarea>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

                <div class="row">
                    <div class="col-md-12 my-2">
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            @endif
                        </div>

                        <span class="text-danger captcha-error d-none">Captcha non valido</span>
                    </div>
                </div>

            <div class="mt-2">
                <button class="btn btn-dark" type="submit">Invia</button>
            </div>
            </form>

            <div class="status"></div>
        </div>
        <!--Grid column-->


    </div>

</section>
<!--Section: Contact v.2-->
      </div>
    </div>
  </div>
</div>
<!--About us modal-->

<div class="modal fade" id="aboutUsModal" tabindex="-1" aria-labelledby="aboutUsModal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">About us</h5>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		  	<div class="container-fluid p-1" >
				@php
				$aboutUs = DB::table('about_us')->first();
				@endphp
		@isset($aboutUs->about_us_text)
       	{!!$aboutUs->about_us_text!!}
      	@endisset
	</div>
      </div>
    </div>
  </div>
</div>

 <script>
     const validateRecaptcha = () => {
         const response = grecaptcha.getResponse();

         return response.length;
     }

     $('#contact-us-form').submit(function (e) {
         if (!validateRecaptcha()) {
             e.preventDefault();
             $('.captcha-error').removeClass('d-none')
             return;
         }
         $('.captcha-error').addClass('d-none')
     })
 </script>
