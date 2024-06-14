<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Stripe;
use Redirect;
use DB;
use Hash;
use Session;

class VendorStripeController extends Controller
{
    //
    public function index()
    {
		if(!(Session::get('vendor_payment_password_validation'))){
			$notifications = array(
            'message' => 'Something went wrong!',
            'alert-type' => 'error'
        );
        return Redirect()->route('dashboard')->with($notifications);
		}
        $nUserID = Auth::user()->id;

        $user = User::where('id',$nUserID)->first();
        $stripe = new Stripe\StripeClient(env('STRIPE_SECRET'));
        $accountID = "";
        if($user->stripe_account_id!="")
        {
            //return view('vendor.vendorstripe.alreadyset');
            $accountID = $user->stripe_account_id;
        }
        else {

            $response = $stripe->accounts->create(['type' => 'express']);
            $accountID = $response->id;
            $arrUpdate = array('stripe_account_id'=>$accountID);
            User::where('id',$nUserID)->update($arrUpdate);
        }
        if($accountID!="")
        {
            $response = $stripe->accountLinks->create([
            'account' => $accountID,
            'refresh_url' => route('vendorstripe.index'),
            'return_url' => route('vendorstripe.thankyou'),
            'type' => 'account_onboarding',
            ]);
            $strURL = $response->url;
            return Redirect::to($strURL);
        }



    }

    public function thankyou()
    {
        return view('vendor.vendorstripe.thankyou');
    }
    public function vendorValidation(Request $request)
    {
		$user = User::findOrFail(Auth::user()->id);

		if (Hash::check($request->code, $user->vendor_payment_password)) {
			Session::put('vendor_payment_password_validation', '1');
			return 1;
		}
		return 0;
    }
}
