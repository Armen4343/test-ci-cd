@extends('layouts.super-admin.master')

@section('super-admin')
<h3 class="text-muted">Home page banner</h3>
@isset($homePageBanner->id) 
 <img src="{{ asset($homePageBanner->banner_name) }}" class="img img-thumbnail w-md-25 mb-3">
@endisset 
 <form action="{{ route('super.admin.home.page.banner.save') }}" method="post"  enctype="multipart/form-data">
	 @csrf
	  @isset($homePageBanner->id) 
        <input type="hidden" name="id" value="{{$homePageBanner->id}}"/>
      @endisset

         <input type="file" class="form-control" name="banner_name" required accept=".png, .jpg, .jpeg" />

 <!--end::Image input-->
	 <div class="d-flex justify-content-end">
	 	<button type="submit" class="btn btn-primary  d-block mt-2">Save</button>
	 </div>
</form
       
@endsection