@extends('layouts.front.master')

@section('front')
@push('front-styles')
	<link href="{{ asset('front-end/details.css') }}" rel="stylesheet" type="text/css" />
<style>
.hero{
	width: 100%;
    height: 300px;
    position: relative;
    overflow: hidden;
    margin-top: 16px;	
}
.hero-background{
    position: absolute;
    left: 0px;
    top: 0px;
    border-radius: 16px;
    overflow: hidden;
    width: 100%;
    height: 250px;
}
.hero-background img{
    width: 100%;
    object-fit: cover;
}
.hero-logo{
	width: 80px;
    height: 80px;
    position: absolute;
    bottom: 12px;
    left: 16px;
    border-radius: 50%;
    overflow: hidden;
    background-color: rgb(255, 255, 255);
    border: 2px solid rgb(255, 255, 255);
    box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px;
}
.hero-logo-background{
    height: 76px;
    position: absolute;
    left: 0px;
    top: 0px;
    border-radius: 50%;
    overflow: hidden;
}
.hero-logo-background img{
	width: 100%;
    height: 100%;	
}
</style>
@endpush
<main style="transform: none;" class="front-main">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="hero">
					<div class="hero-background">
						<img src="https://img.cdn4dd.com/cdn-cgi/image/fit=cover,width=1000,height=300,format=auto,quality=80/https://doordash-static.s3.amazonaws.com/media/store/header/68a5a075-3de9-4f1b-b7c5-4753bf183a74.jpg" alt="" height="250" class="sc-a4eba1bb-3 fjDMJR">
					</div>
					<div class="hero-logo">
						<div class="hero-logo-background">
							<img src="https://img.cdn4dd.com/p/fit=contain,width=1200,height=76,format=auto,quality=95/media/restaurant/cover_square/2d593cd8-cf51-480d-9aa9-d406b5fd84da.png " alt="Sticky Rice">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</main>
@push('front-scripts')

@endpush
@endsection   