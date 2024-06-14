<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ContactUsController extends Controller
{
    //
    public function index()
    {
        //
		$contactUs = DB::table('contact_us')->first();
		if($contactUs){
		return view('super-admin.settings.contact-us', compact('contactUs'));
		}
		else{
		return view('super-admin.settings.contact-us');
		}
    }

    public function save(Request $request)
    {
        //
		if ($request->has('id')) {
			$contactUs = DB::table('contact_us')
              ->where('id', $request->id)
              ->update([
                'email' => $request->email,
				'phone1' => $request->phone1,
				'phone2' => $request->phone2,
				'address' => $request->address,
				'country' => $request->country,
				'postal_code' => $request->postalcode
            ]);
		}
		else{
			DB::table('contact_us')->insert([
				'email' => $request->email,
				'phone1' => $request->phone1,
				'phone2' => $request->phone2,
				'address' => $request->address,
				'country' => $request->country,
				'postal_code' => $request->postalcode
			]);
			}
            
			$contactUs = DB::table('contact_us')->first();
            return view('super-admin.settings.contact-us', compact('contactUs'));
    }
}
