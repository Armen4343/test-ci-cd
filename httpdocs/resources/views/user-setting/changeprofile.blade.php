
<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Al-Hijrah" name="description">
    <meta content="Al-Hijrah™" name="author">
    <meta name="keywords" content="laravel ui admin template, laravel admin template, laravel dashboard template,laravel ui template, laravel ui, livewire, laravel, laravel admin panel, laravel admin panel template, laravel blade, laravel bootstrap5, bootstrap admin template, admin, dashboard, admin template">

    <!-- Title -->
    <title></title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('alhijrah/assets/images/alhijrah-logo/favicon.ico') }}" type="image/x-icon"/>

    <!--Bootstrap css -->
    <link href="{{ asset('alhijrah/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('alhijrah/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('alhijrah/assets/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('alhijrah/assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('alhijrah/assets/css/animated.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('alhijrah/assets/plugins/icons/icons.css') }}" rel="stylesheet" />



    <!-- Color Skin css -->
    <link id="theme" href="{{ asset('alhijrah/assets/colors/color1.css') }}" rel="stylesheet" type="text/css"/>



</head>

<body class="h-100vh error-bg">


        <div class="register-2">


        <div class="page">
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col mx-auto">
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-xl-4">

                                    <div class="card">
                                        <div class="card-header " >
                                            <img src="{{ asset('alhijrah/assets/images/alhijrah-logo/logo-1.png') }}" class="header-brand-img desktop-lgo m-auto" style="height: 110px;" alt="Azea logo">
                                    </div>
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <h2 class="mb-2">Change Profile</h2>
                                                <a href="javascript:void(0);" class="">{{ Auth::user()->name }}</a>
                                            </div>
                                            <form class="mt-5" action="{{ route('update.profile.image') }}" method="post" enctype="multipart/form-data">
                                             @csrf
                                            <div class="input-group mb-4">
                                                    <input type="file" class="form-control" name="profile" placeholder="profile" required="">
                                                </div>
                                                <div class="form-group text-center mb-3">
                                                    <input type="submit" class="btn btn-primary btn-lg w-100 br-7" value="Update">
                                                </div>
                                                <div class="form-group text-center mb-3">
                                                    <a href="{{ route('user.redirects') }}" class="btn btn-danger btn-lg w-100 br-7">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Jquery js-->
    <script src="{{ asset('alhijrah/assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap5 js-->
    <script src="{{ asset('alhijrah/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('alhijrah/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--Othercharts js-->
    <script src="{{ asset('alhijrah/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Circle-progress js-->
    <script src="{{ asset('alhijrah/assets/plugins/circle-progress/circle-progress.min.js') }}"></script>

    <!-- Jquery-rating js-->
    <script src="{{ asset('alhijrah/assets/plugins/rating/jquery.rating-stars.js') }}"></script>

    <!-- Show Password -->
    <script src="{{ asset('alhijrah/assets/plugins/bootstrap-show-password/bootstrap-show-password.min.js') }}"></script>



    <!-- Custom js-->
    <script src="{{ asset('alhijrah/assets/js/custom.js') }}"></script>
</div>

</body>

<!-- Mirrored from laravel.spruko.com/azea/azea/login2 by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Dec 2021 15:01:27 GMT -->
</html>

