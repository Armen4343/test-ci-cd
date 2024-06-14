<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Image;
use Illuminate\Support\Facades\Storage;
class HomePageBannerController extends Controller
	
{
    //

    public function index()
    {
        //
		$homePageBanner = DB::table('home_page_banner')->first();
		if($homePageBanner){
		return view('super-admin.settings.home-page-banner', compact('homePageBanner'));
		}
		else{
		return view('super-admin.settings.home-page-banner');
		}
    }

    public function save(Request $request)
    {
	
        //
		if ($request->has('id')) {
			
			
            $originalImage= $request->file('banner_name');
			
			 $bannerPath = 'home_page_banner/' . hexdec(uniqid()) . '.' . $originalImage->getClientOriginalExtension();

        // Resize the logo image before uploading to S3
        $resizedbanner = Image::make($originalImage)->resize(700,480);

        // Convert the Intervention Image instance to a stream for storage
        $resizedbannerStream = $resizedbanner->stream();

        // Upload the resized logo image to S3
        Storage::disk('s3')->put($bannerPath, $resizedbannerStream->__toString(), 'public');

        // Get the S3 URL for the uploaded logo image
        $banner_name = Storage::disk('s3')->url($bannerPath);
			
			
			
         
			$homePageBanner = DB::table('home_page_banner')
              ->where('id', $request->id)
              ->update(['banner_name' => $banner_name]);
		}
		else{
           $originalImage= $request->file('banner_name');
			
			 $bannerPath = 'home_page_banner/' . hexdec(uniqid()) . '.' . $originalImage->getClientOriginalExtension();

        // Resize the logo image before uploading to S3
        $resizedbanner = Image::make($originalImage)->resize(700,480);

        // Convert the Intervention Image instance to a stream for storage
        $resizedbannerStream = $resizedbanner->stream();

        // Upload the resized logo image to S3
        Storage::disk('s3')->put($bannerPath, $resizedbannerStream->__toString(), 'public');

        // Get the S3 URL for the uploaded logo image
        $banner_name = Storage::disk('s3')->url($bannerPath);

            DB::table('home_page_banner')->insert([
            	'banner_name' => $banner_name
            ]);
			
			}
            $homePageBanner = DB::table('home_page_banner')->first();
		 	return view('super-admin.settings.home-page-banner', compact('homePageBanner'));
    }
}
