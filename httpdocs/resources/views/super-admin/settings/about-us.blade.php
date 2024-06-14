@extends('layouts.super-admin.master')

@section('super-admin')
<h3 class="text-muted">About us</h3>
 <form action="{{ route('super.admin.about.us.save') }}" method="post">
	 @csrf
	  @isset($aboutUs->id) 
        <input type="hidden" name="id" value="{{$aboutUs->id}}"/>
      @endisset
	<textarea name="about_us_text" id="kt_docs_ckeditor_classic">
		@isset($aboutUs->about_us_text) 
       	{{$aboutUs->about_us_text}}
      	@endisset
	</textarea>
	 <button type="submit" class="btn btn-primary  d-block m-auto me-0 mt-2">Save</button>
</form>
@endsection