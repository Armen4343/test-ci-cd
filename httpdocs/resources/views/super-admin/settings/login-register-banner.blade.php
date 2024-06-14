@extends('layouts.super-admin.master')

@section('super-admin')
    <h3 class="text-muted">Login register banner</h3>
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

    <form action="{{ route('super.admin.login.register.banner.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                @isset($loginRegisterBanner->login_banner)
                    <img src="{{ asset($loginRegisterBanner->login_banner) }}" class="img img-thumbnail h-75 preview_login_banner" alt="{{ $loginRegisterBanner->login_banner }}">
                @endisset
                <div class="mb-3">
                    <label for="login_banner" class="form-label">Login Banner</label>
                    <input class="form-control" type="file" name="login_banner" id="login_banner" required accept=".png, .jpg, .jpeg" />
                </div>
            </div>
            <div class="col-md-6">
                @isset($loginRegisterBanner->register_banner)
                    <img src="{{ asset($loginRegisterBanner->register_banner) }}" class="img img-thumbnail h-75 preview_register_banner" alt="{{ $loginRegisterBanner->register_banner }}">
                @endisset
                <div class="mb-3">
                    <label for="register_banner" class="form-label">Register Banner</label>
                    <input class="form-control" type="file" name="register_banner" id="register_banner" required accept=".png, .jpg, .jpeg" />
                </div>
            </div>
        </div>

        <!--end::Image input-->
        <button type="submit" class="btn btn-success  d-block mt-2"><i class="fas fa-save"></i>Save</button>
    </form

@endsection

@push('super-admin-scripts')
    <script type="text/javascript">
        function readURL(input, item) {
            if (input.files && input.files[0]) {
                const url = URL.createObjectURL(input.files[0])

                $(item).attr('src', url);
            }
        }

        $('#login_banner').change(function(){
            readURL(this, '.preview_login_banner');
        })

        $('#register_banner').change(function(){
            readURL(this, '.preview_register_banner');
        })
    </script>
@endpush
