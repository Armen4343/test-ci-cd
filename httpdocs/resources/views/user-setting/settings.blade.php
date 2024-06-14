<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>ZeepUp</title>
	

	</head>
	<!--end::Head-->
<style>
    h3,p{
        color: black !important;
    }
    .relative{
        display: none !important;
    }
    input ~ p {
  color: red!important;
}
</style>


</head>

<body class="h-100vh error-bg" >


        <div style="background-color:#44c4fa; background-image: linear-gradient(to right, #ededed , #eeeeee);">


        <div class="page">
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mx-auto">
                        <x-app-layout >


                            <div style="background-color:#44c4fa; background-image: linear-gradient(to right, #ededed , #eeeeee);">
                                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                        @livewire('profile.update-profile-information-form')

                                        <x-jet-section-border />
                                    @endif

                                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                        <div class="mt-10 sm:mt-0">
                                            @livewire('profile.update-password-form')
                                        </div>

                                        <x-jet-section-border />
                                    @endif
                                    <div class="mt-10 sm:mt-0">
                                        @livewire('profile.logout-other-browser-sessions-form')
                                    </div>

                                </div>
                            </div>
                            </x-app-layout>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
</div>



	</body>
	<!--end::Body-->
</html>
