@extends('layouts.super-admin.master')

@section('super-admin')
<h3 class="text-muted">Terms and conditions</h3>
@if($terms)
<div class="my-2 me-0 ms-auto">
    @if($terms->terms_and_condition)
        <a href="{{ url('terms-and-conditions/' . $terms->terms_and_condition) }}" target="_blank" class="btn btn-sm btn-success ">Download Terms and condition</a>
    @endif
    @if($terms->privacy_policy)
        <a href="{{ url('terms-and-conditions/' . $terms->privacy_policy) }}" target="_blank" class="btn btn-sm btn-success ">Download Privacy Policy/Cookie policy</a>
    @endif
	{{--@if($terms->pdf_1)
		<a href="{{ url('terms-and-conditions/'.$terms->pdf_1) }}" target="_blank" class="btn btn-sm btn-success ">Download Terms and conditions 1</a>
	@endif
	@if($terms->pdf_2)
		<a href="{{ url('terms-and-conditions/'.$terms->pdf_2) }}" target="_blank" class="btn btn-sm btn-success ">Download Terms and conditions 2</a>
	@endif
	@if($terms->pdf_3)
		<a href="{{ url('terms-and-conditions/'.$terms->pdf_3) }}" target="_blank" class="btn btn-sm btn-success ">Download Terms and conditions 3</a>
	@endif
	@if($terms->pdf_4)
		<a href="{{ url('terms-and-conditions/'.$terms->pdf_4) }}" target="_blank" class="btn btn-sm btn-success ">Download Terms and conditions 4</a>
	@endif--}}
</div>
@endif
@if(isset($message))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 <form action="{{ route('super.admin.terms.and.conditions.save') }}" method="post" enctype="multipart/form-data">
	 @csrf
	  @isset($terms->id)
        <input type="hidden" name="id" value="{{$terms->id}}"/>
      @endisset
	 <div class="row">
         <div class="col-md-6">
             <div class="mb-3">
                 <label for="terms_and_condition" class="form-label">Terms and conditions</label>
                 <input class="form-control" type="file" name="terms_and_condition" id="terms_and_condition" accept="application/pdf" />
             </div>
         </div>
         <div class="col-md-6">
             <div class="mb-3">
                 <label for="privacy_policy" class="form-label">Privacy Policy/Cookie policy</label>
                 <input class="form-control" type="file" name="privacy_policy" id="privacy_policy" accept="application/pdf" />
             </div>
         </div>

		 {{--<div class="col-md-6">
			<div class="mb-3">
			  <label for="pdf_1" class="form-label">Terms and conditions 1</label>
			  <input class="form-control" type="file" name="pdf_1" accept="application/pdf" />
			</div>
		</div>
		 <div class="col-md-6">
			<div class="mb-3">
			  <label for="pdf_2" class="form-label">Terms and conditions 2</label>
			  <input class="form-control" type="file" name="pdf_2" accept="application/pdf" />
			</div>
		</div>

		 <div class="col-md-6">
			<div class="mb-3">
			  <label for="pdf_3" class="form-label">Terms and conditions 3</label>
			  <input class="form-control" type="file" name="pdf_3" accept="application/pdf" />
			</div>
		</div>

		 <div class="col-md-6">
			<div class="mb-3">
			  <label for="pdf_4" class="form-label">Terms and conditions 4</label>
			  <input class="form-control" type="file" name="pdf_4" accept="application/pdf" />
			</div>
		</div>--}}
	</div>

	 <button type="submit" class="btn btn-success  d-block m-auto me-0 mt-2"><i class="fas fa-save"></i>Save</button>
</form

@endsection
