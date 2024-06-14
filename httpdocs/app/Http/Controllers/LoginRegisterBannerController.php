<?php

namespace App\Http\Controllers;

use App\Models\LoginRegisterBanner;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\Storage;
class LoginRegisterBannerController extends Controller
{
    //
    public function index()
    {
        //
        $loginRegisterBanner = LoginRegisterBanner::first();

        return view('super-admin.settings.login-register-banner', compact('loginRegisterBanner'));
    }

    public function save(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [
            "login_banner" => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            "register_banner" => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $loginRegisterBanner = LoginRegisterBanner::first();

        if (!$loginRegisterBanner) {
            $loginRegisterBanner = new LoginRegisterBanner();
        }

		if ($request->login_banner) {
			$originalImage= $request->file('login_banner');
			$bannerPath = 'banner_name/' . hexdec(uniqid()) . '.' . $originalImage->getClientOriginalExtension();

        // Resize the logo image before uploading to S3
        $resizedbanner = Image::make($originalImage)->resize(1280,720);

        // Convert the Intervention Image instance to a stream for storage
        $resizedbannerStream = $resizedbanner->stream();

        // Upload the resized logo image to S3
        Storage::disk('s3')->put($bannerPath, $resizedbannerStream->__toString(), 'public');

        // Get the S3 URL for the uploaded logo image
        $banner_name = Storage::disk('s3')->url($bannerPath);


            //$name_gen = hexdec(uniqid()).".".($originalImage->getClientOriginalExtension());
            //Image::make($originalImage)->resize(1280,720)->save(public_path().'/front-end/images/'.$name_gen );
            //$banner_name = "front-end/images/".$name_gen;
            $loginRegisterBanner->login_banner = $banner_name;
		}

        if ($request->register_banner) {
            $originalImage= $request->file('register_banner');

			 $bannerPath = 'banner_name/' . hexdec(uniqid()) . '.' . $originalImage->getClientOriginalExtension();

        // Resize the logo image before uploading to S3
        $resizedbanner = Image::make($originalImage)->resize(1280,720);

        // Convert the Intervention Image instance to a stream for storage
        $resizedbannerStream = $resizedbanner->stream();

        // Upload the resized logo image to S3
        Storage::disk('s3')->put($bannerPath, $resizedbannerStream->__toString(), 'public');

        // Get the S3 URL for the uploaded logo image
        $banner_name = Storage::disk('s3')->url($bannerPath);
            //$name_gen = hexdec(uniqid()).".".($originalImage->getClientOriginalExtension());
            //Image::make($originalImage)->resize(1280,720)->save(public_path().'/front-end/images/'.$name_gen );
           //$banner_name = "front-end/images/".$name_gen;

           $loginRegisterBanner->register_banner = $banner_name;
        }
            $loginRegisterBanner->save();
        $message = "Updated Successfully!";

        return Redirect::back()->with(compact('loginRegisterBanner', 'message'));
    }
}
