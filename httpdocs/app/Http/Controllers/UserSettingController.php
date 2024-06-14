<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class UserSettingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ChangePassword(){
        return view();
    }

    public function ChangeProfileImage(Request $request){

        $validated = $request->validate([
            'profile' => 'mimes:jpg,jpeg,png',
        ],
        [
            'profile.required' => 'Profile type must be JPG,JPEG or PNG',
        ]);



        $profile = $request->file('profile'); 
        $name_gen = hexdec(uniqid()).".".($profile->getClientOriginalExtension());
        Image::make($profile)->resize(250,250)->save('avatars/'.$name_gen );
        $last_img = "avatars/".$name_gen;
       DB::table('users')->where('id', Auth::user()->id)->update([
            'profile_photo_path' => $last_img,
            'updated_at' => Carbon::now()
        ]);

    
        $notifications = array(
            'message' => 'aggiornato con successo!',
            'alert-type' => 'updated'
        );
         return Redirect()->route('user.redirects')->with($notifications);
    }
    public function ChangeImageIndex(){
         return view('user-setting.changeprofile');
    }
    public function UserSettings(){
        return view('user-setting.settings');
   }
    public function VendorProfileSettings(){
        return view('vendor.profile.index');
   }
    public function VendorProfileUpdate(Request $request){
		$validated = $request->validate([
			'logo' => 'mimes:jpg,png,jpeg|max:2048',
			'banner' => 'mimes:jpg,png,jpeg|max:2048'
        ]);
        $old_logo = $request->old_logo;
        $old_banner = $request->old_banner;
        $logo = $request->file('logo');
        $banner = $request->file('banner');
        $phone = ($request->phone) ? $request->phone : Auth::user()->phone;
        $zipcode = ($request->zipcode) ? $request->zipcode : Auth::user()->zipcode;
        /* if(($logo) && !empty($old_logo) ){
			
            if (file_exists(public_path().'/'.$old_logo)){
            unlink(public_path().'/'.$old_logo);
        	}
        }     
		*/
       /* if(($banner) && !empty($old_banner) ){
            if (file_exists(public_path().'/'.$old_banner)){
            unlink(public_path().'/'.$old_banner);
        	}
        }
		*/
        if ($logo) {
        $originalLogoImage = $request->file('logo');
			
			
      $path = Storage::disk('s3')->put('Logobanner', $originalLogoImage, 'public');
			 
			 
	

$logoUrl = Storage::disk('s3')->url($path); // Get the URL from S3.
			
    } else {
        $logoUrl = $old_logo;
    }
		
		
         if($banner){
			 $originalbannerImage = $request->file('banner');
 
 
 
        $bannerPath = 'Logobanner/' . hexdec(uniqid()) . '.' . $originalbannerImage->getClientOriginalExtension();
        // Resize the logo image before uploading to S3
        $resizedbanner = Image::make($originalbannerImage)->resize(1182, 294);

        // Convert the Intervention Image instance to a stream for storage
        $resizedbannerStream = $resizedbanner->stream();

        // Upload the resized logo image to S3
        $path = Storage::disk('s3')->put('Logobanner', $originalbannerImage, 'public');

        // Get the S3 URL for the uploaded logo image
        $bannerUrl = Storage::disk('s3')->url($path);

         }else{
		 $bannerUrl = $old_banner;
		 }
		
		
		DB::table('users')->where('id', Auth::user()->id)->update([
                'phone' => $phone,
                'zipcode' => $zipcode,
                'profile_photo_path' => $logoUrl,
                'banner_photo_path' => $bannerUrl,
                 'updated_at' => Carbon::now()
             ]);
         
         $notifications = array(
            'message' => 'Profilo aggiornato con successo!',
            'alert-type' => 'success'
        );
        return Redirect()->route('vendor.profile.settings')->with($notifications);
     }
	public function VendorProfileImageRemove($key){
	$data = User::find(Auth::user()->id);
        $data->$key= NULL;
        $data->save();
		return Redirect()->route("vendor.profile.settings")->with("success","cancellato con successo!");
	}
	
	public function updateVendorPaymentPassword(Request $request){
		
		$this->validate($request, [
'new_vendor_payment_password' => 'min:8|required_with:confirm_vendor_payment_password|same:confirm_vendor_payment_password',
'confirm_vendor_payment_password' => 'min:8'
]);
		
	$user = User::findOrFail(Auth::user()->id);
		if (Hash::check($request->vendor_payment_password, $user->vendor_payment_password)) { 
			DB::table('users')->where('id', Auth::user()->id)->update([
					'vendor_payment_password' => Hash::make($request->vendor_payment_password),
					 'updated_at' => Carbon::now()
				 ]);
			
		$notifications = array(
            'message' => 'aggiornato con successo!',
            'alert-type' => 'success'
        );
        return Redirect()->route('dashboard')->with($notifications);
		}
		else{
		return \Redirect::back()->withErrors(['msg' => 'Digita password finanziaria attuale!']);
		}
		
	}
	
	

}
