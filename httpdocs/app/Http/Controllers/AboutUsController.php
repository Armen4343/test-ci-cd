<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AboutUsController extends Controller
{
    //

    public function index()
    {
        //
		$aboutUs = DB::table('about_us')->first();
		if($aboutUs){
		return view('super-admin.settings.about-us', compact('aboutUs'));
		}
		else{
		return view('super-admin.settings.about-us');
		}
    }

    public function save(Request $request)
    {
        //
		if ($request->has('id')) {
			$aboutUs = DB::table('about_us')
              ->where('id', $request->id)
              ->update(['about_us_text' => $request->about_us_text]);
			$aboutUs = DB::table('about_us')->first();
		 	return view('super-admin.settings.about-us', compact('aboutUs'));
		}
		else{
			DB::table('about_us')->insert([
				'about_us_text' => $request->about_us_text
			]);
			$aboutUs = DB::table('about_us')->first();
		 	return view('super-admin.settings.about-us', compact('aboutUs'));
			}
    }
}
