@extends('layouts.front.master')

@section('front')

	<div class="container-fluid p-3" style="margin-top: 100px;">
		@isset($aboutUs->about_us_text) 
       	{!!$aboutUs->about_us_text!!}
      	@endisset
	</div>




@endsection
