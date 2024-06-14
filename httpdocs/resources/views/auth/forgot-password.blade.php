@extends('layouts.front.master')

@section('front')

@push("front-styles")
		<style>
	.login-input{
        padding: 5px 0px 5px 7px;
        display: block;
        padding: 10px;
        background-color: white !important;
        width: 100%;
	}
	
</style>
@endpush




		<!--begin::Main-->
		<!--begin::Root-->
		<div class="auth-container" style="margin-top:100px;">

		<div class="row gx-0 h-100 py-5" >
			<!--begin::Authentication - Sign-in -->
			<div class="col-lg-6">
				<div class="widget">
					<div class="login-widget shadow">
                       <!--begin::Heading-->
							<div class="text-center mb-3">
								<!--begin::Title-->
								<h2 class="text-dark mb-3">Hai dimenticato la password?</h2>
								<!--end::Title-->
								
							</div>
							<!--begin::Heading-->
                        
						  <div class="mb-4 text-sm text-gray-600">
            {{ __('Nessun problema. Inserisci il tuo indirizzo email e ti invieremo un nuovo link per creare una nuova password.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-success">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4 text-danger" />

        <form method="POST" action="{{ route('password.email') }}" >
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full w-100 form-control" type="email" name="email" :value="old('email')" required autofocus />
            </div>
			<div class="row mt-3">
				<div class="col-md-9">
 <button type="submit"  class="btn btn-warning w-100 shadow ">
									<span class="indicator-label"> <i class="fa-solid fa-user-lock pe-2 login-icon"></i>Invia email per resettare la password</span>
								</button>
				</div>
				<div class="col-md-3">
 <a href="{{ route('login') }}"  class="btn btn-primary w-100 shadow">
									<i class="fa-solid fa-user pe-2 login-icon"></i>Login
								</a>
				</div>
			</div>

        </form>
					</div>
					<!--end::Wrapper-->
				
				<!--end::Content-->
				</div>
			</div>
			<div class="col-lg-6 ">
				<div class="auth-bg" style="background-image:url({{ secure_asset('forgot_password_animal.jpg') }}); background-size:cover; background-repeat:no-repeat; background-position:center center; height:100%;">
					<div class="content" >
						<!--<div class="date">
						February 21, 2023
						</div>
						<h3 class="heading">Heading goes here</h3>
						<p>
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
						</p>
						<a href="#">Read More</a>
					</div>
				</div> -->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		
		</div>
		<!--end::Root-->


@push("front-scripts")
		<script>
			$(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
        });
		</script>
@endpush
@endsection
