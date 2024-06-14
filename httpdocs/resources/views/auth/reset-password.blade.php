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
		<div class="auth-container">

		<div class="row gx-0 h-100">
			<!--begin::Authentication - Sign-in -->
			<div class="col-lg-6">
				<div class="widget">
					<div class="login-widget shadow">
                       <!--begin::Heading-->
							<div class="text-center mb-3">
								<!--begin::Title-->
								<h2 class="text-dark mb-3">Bentornato!</h2>
								<!--end::Title-->
								
							</div>
							<!--begin::Heading-->

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-success">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4 text-danger" />

         <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Conferma Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

           <div class="mt-4">
								<!--begin::Submit button-->
								<button type="submit"  class="btn btn-success shadow w-100" >
									<span class="indicator-label"> <i class="fa-solid fa-user pe-2 login-icon"></i>Ripristina Password</span>
									
								</button>
								
							</div>
        </form>
					</div>
					<!--end::Wrapper-->
				
				<!--end::Content-->
				</div>
			</div>
			<div class="col-lg-6 ">
				<div class="auth-bg" style="background-image:url({{ secure_asset('front-end/images/login-bg-new.png') }}); background-size:cover; background-repeat:no-repeat; background-position:center center; height:100%; ">
					<div class="content">
						<div class="date">
						<!--Login-->
						</div>
						<!--<h3 class="heading">Login</h3> -->
						<p>
						</p>
						<!--<a href="#">Read More</a>-->
					</div>
				</div>
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
