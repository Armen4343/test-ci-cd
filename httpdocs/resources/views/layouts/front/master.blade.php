<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZeepUp</title>
	<link rel="icon" href="{{ asset('front-end/images/favicon.png') }}" type="image/png" sizes="64x64">
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
     <!-- ---- Boxicons CSS ---- -->
     <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />

        <link rel="stylesheet" type="text/css" href="{{ secure_asset('front-end/slick/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('front-end/slick/slick-theme.css') }}">

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
	<!-- Loader style-->

	 <!-- Owl Stylesheets -->
      <link rel="stylesheet" href="{{asset('assets/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/owl.theme.default.min.css')}}">
	 <!-- javascript -->
      <script src="{{asset('assets/jquery.min.js')}}"></script>
      <script src="{{asset('assets/owl.carousel.js')}}"></script>

    <script src='https://www.google.com/recaptcha/api.js'></script>

<style>

    #loader {
        border: 12px solid #f3f3f3;
        border-radius: 50%;
        border-top: 12px solid #ff0066;
        width: 70px;
        height: 70px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }

    .center {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }
	body{
	visibility:hidden;
	}
	#loader{
	visibility:visible;
	}
	.main-color{
	color:#ff0066!important;
	}

	.main-bg-color{
	background-color:#ff0066!important;
	}
</style>

@stack("front-styles")

</head>

<body>

	<div id="loader" class="center"></div>
    <!-- (((((((((((((((((((((((       navbar      ))))))))))))))))))))))) -->
   	@include('layouts.front.header')



@yield('front')



@include('layouts.front.footer')

    <!--  Codes -->
   <div class="wrapper" style="z-index:1;">
      <div class="title-box">
        <i class="bx bx-cookie"></i>
        <h3>Cookies </h3>
      </div>
      <div class="info">
        <p>
          Il nostro sito utilizza cookie, compresi cookie analitici e di profilazione, al fine di raccogliere informazioni statistiche e per garantirti un’esperienza ottimizzata. Puoi accettare tutti i cookie oppure declinare rifiutando i cookie opzionali. Per maggiori informazioni consulta la nostra Cookie Policy.
        </p>
          @php
              $termsAndConditions = App\Models\TermsAndConditions::first();
          @endphp
        <a href="terms-and-conditions/{{$termsAndConditions['privacy_policy']}}" target="_blank" class="terms-link">Cookie Policy</a>
		  <br/>
        <a href="terms-and-conditions/{{$termsAndConditions['terms_and_condition']}}" target="_blank" class="terms-link">Termini e condizioni</a>
      </div>
      <div class="buttons">
        <button class="button" id="acceptBtn">Accetta</button>
        <button class="button" style="color: black;background: white;">Rifiuta</button>
      </div>
    </div>
	 <!-- <button type="button" class="btn btn-primary py-3 px-4" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
							  Launch Modal 04
							</button>-->
		@php
	$PopupBanner = App\Models\PopupBanner::firstOrNew();
	@endphp
	@if(!empty($PopupBanner->is_active) && $PopupBanner->is_active !== false)
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
				      <div class="modal-body p-5 img d-flex" style="background-image: url({{ !empty($PopupBanner->image) && $PopupBanner->image !== null ? $PopupBanner->image : '' }});
																	background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;">
				      </div>
				    </div>
				    <div class="col-md-6 d-flex">
				      <div class="modal-body p-5 d-flex align-items-center">
				      	<div class="text w-100 py-5">
				      		<h2 class="mb-0">{{ !empty($PopupBanner->title) && $PopupBanner->title !== null ? $PopupBanner->title : '' }}</h2>
				      		<h4 class="mb-1">{{ !empty($PopupBanner->description) && $PopupBanner->description !== null ? $PopupBanner->description : '' }}</h4>
							@if(!empty($PopupBanner->url) && $PopupBanner->url !== null)
							<p><a href="{{$PopupBanner->url}}" class="mb-1">
								@php
								$url_info = parse_url($PopupBanner->url);
								echo $url_info['host'];
								@endphp


								</a></p>
							@endif
							@if(!empty($PopupBanner->discount_code) && $PopupBanner->discount_code !== null)
							<h5 class="mb-1"  style="color:#ff0066;font-weight:800;font-family:monospace;letter-spacing:0.1em;font-size:2em;text-transform:uppercase;">{{$PopupBanner->discount_code}}</h5>
							@endif
							<!--
				      		<form action="#" class="code-form">
		                <div class="form-group d-flex">
		                  <input type="text" class="form-control" placeholder="Enter Email">
		                </div>
								<div class="form-check mt-2">
									<input class="form-check-input mb-2" type="checkbox" value="" id="terms">
									<label class="form-check-label" for="terms">By claiming up you are opting for ZeepUp to receive the email and agree to <a href="https://drive.google.com/file/d/1RzOjbcNhRdUJZmISdEbX4RPWCrxswg9l/view?usp=drive_link" target="_blank">ZeepUp Privacy Policy</a> and <a href="https://drive.google.com/file/d/1iDFgRUFPiYOdQp_g5Z-G_I8Dig0hDYs4/view?usp=drive_link" target="_blank">Terms of Use</a>. Some Items may be excluded from promotions</label>
								</div>
						<button class="btn wizard-btn d-block py-3 w-100 mt-3">Claim Offer</buttton>
						<button class="btn btn-link d-block py-3 w-100 mt-3" data-bs-dismiss="modal">No, Thanks</buttton>
		              </form>-->

				      	</div>
				      </div>
				    </div>
				  </div>
		    </div>
		  </div>
		</div>
	@endif



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
    <script src="{{ secure_asset('front-end/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>

@stack("front-scripts")

	<script>
		//subscription form
				$("#subscription-form").on('submit', function(e){

        e.preventDefault();
     var form=document.querySelector('#subscription-form')
        $.ajax({
           type:'POST',
           url:"{{route('send-subcription-email')}}",
           data:new FormData(form),
		   dataType:'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,
           success:function(data){
                if($.isEmptyObject(data.error)){
						 Swal.fire({
							text: data.success,
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok",
							customClass: {
								confirmButton: "btn btn-danger"
							}
						}).then((result) => {
							  /* Read more about isConfirmed, isDenied below */
							  if (result.isConfirmed) {
								 location.reload();
							  }
							});
					setTimeout(function(){
						location.reload();
					},10000);
                }else{
                    printErrorMsg(data.error);
                }
		   }
        });
    });
	//add item end
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

				</script>
  <script>
	//stepper
    $(function() {

        $(document).ready(function() {
            function triggerClick(elem) {
                $(elem).click();
            }
            var $progressWizard = $('.stepper'),
                $tab_active,
                $tab_prev,
                $tab_next,
                $btn_prev = $progressWizard.find('.prev-step'),
                $btn_next = $progressWizard.find('.next-step'),
                $tab_toggle = $progressWizard.find('[data-toggle="tab"]'),
                $tooltips = $progressWizard.find('[data-toggle="tab"][title]');

            // To do:
            // Disable User select drop-down after first step.
            // Add support for payment type switching.

            //Initialize tooltips
            $tooltips.tooltip();

            //Wizard
            $tab_toggle.on('show.bs.tab', function(e) {
                var $target = $(e.target);

                if (!$target.parent().hasClass('active, disabled')) {
                    $target.parent().prev().addClass('completed');
                }
                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            // $tab_toggle.on('click', function(event) {
            //     event.preventDefault();
            //     event.stopPropagation();
            //     return false;
            // });

            $btn_next.on('click', function() {
                $tab_active = $progressWizard.find('.active');

                $tab_active.next().removeClass('disabled');

                $tab_next = $tab_active.next().find('a[data-toggle="tab"]');
                triggerClick($tab_next);

            });
            $btn_prev.click(function() {
                $tab_active = $progressWizard.find('.active');
                $tab_prev = $tab_active.prev().find('a[data-toggle="tab"]');
                triggerClick($tab_prev);
            });
        });
    });

	//stepper end
	</script>

	<script>
		// loader script
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
            "body").style.visibility = "hidden";
            document.querySelector(
            "#loader").style.visibility = "visible";
        } else {
            document.querySelector(
            "#loader").style.display = "none";
            document.querySelector(
            "body").style.visibility = "visible";
        }
    };
</script>
</body>

</html>
