<?php

namespace App\Http\Controllers;

use App\Mail\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    //


 //    User Area Start
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function UserIndex()
     {
         //

         $users = DB::table('users')

             ->get();

         return view('super-admin.user.index',compact('users'));

     }

     public function SuperUserIndex()
     {
         //
         $users = DB::table('users')
             ->where('role', '=' , 'superadmin')
             ->get();
         return view('super-admin.user.super-admin-index',compact('users'));
     }

     public function VendorUserIndex()
     {
         //
         $users = DB::table('users')
             ->where('role', '=' , 'vendor')
             ->get();
         return view('super-admin.user.vendor-index',compact('users'));
     }

     public function CustomerUserIndex()
     {
         //
         $users = DB::table('users')
             ->where('role', '=' , 'buyer')
             ->get();
         return view('super-admin.user.customer-index',compact('users'));
     }
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
      */
     public function Adduser(string $role)
     {
         //

         return view('super-admin.user.add', compact('role'));


     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function StoreUser(Request $request)
     {


         $validated = $request->validate([
             'name' => 'min:4',
             'email' => 'required|unique:users',
             'profile_photo_path' => 'mimes:jpg,jpeg,png',
         ],
             [
                 'name.required' => 'Name unique required',
                 'email.required' => 'Email unique required',
                 'profile_photo_path.required' => 'user Logo type must be JPG,JPEG or PNG',
             ]);


         if($request->role == 'superadmin'){
             $role = 'superadmin';

         }
         elseif($request->role == 'vendor'){
            $role = 'vendor';
         }
         else{
            $role = 'buyer';
         }
         if($request->has('avatar')) {

			 	  $originalImage= $request->file('avatar');

			 $path = Storage::disk('s3')->put('images', $originalImage, 'public');




$last_img = Storage::disk('s3')->url($path); // Get the URL from S3.


            //$originalImage= $request->file('avatar');
           // $name_gen = hexdec(uniqid()).".".($originalImage->getClientOriginalExtension());
            //Image::make($originalImage)->resize(500,500)->save(public_path().'/avatars/'.$name_gen );
            //$last_img = "avatars/".$name_gen;
        }

		 else {
            $last_img = null;
        }

         $token = Str::random(64);

         $data = [
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->new_password),
             'role' => $role,
             'status' => $request->status,
             'profile_photo_path' => $last_img,
             'created_at' => Carbon::now(),
             'email_verified_at' => Carbon::now(),
         ];

         if (isset($request->company_name)) {
             $data['company_name'] = $request->company_name;
         }
         if (isset($request->tax_id)) {
             $data['tax_id'] = $request->tax_id;
         }
         if (isset($request->vat_number)) {
             $data['vat_number'] = $request->vat_number;
         }
         if (isset($request->sdi_code)) {
             $data['sdi_code'] = $request->sdi_code;
         }
         if (isset($request->pec)) {
             $data['pec'] = $request->pec;
         }

         if ($request->role !== 'superadmin' && $request->role !== 'vendor') {
             $data['token'] = $token;

             $details = [
                 'name' => $request->name,
                 'token' => $token,
             ];

             Mail::to(request()->email)->send(new Register($details));
         }

         DB::table('users')->insert($data);

         $notifications = array(
             'message' => 'User Added Successfully!',
             'alert-type' => 'success'
         );
         return Redirect()->route(($role === 'superadmin' ? 'super' : ($role === 'buyer' ? 'customer' : $role)) . '.' . 'user.index')->with($notifications);
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function Showuser($id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function EditUser($id)
     {
         //
         $user = DB::table('users')->where('id', $id)->first();
         return view('super-admin.user.edit',compact( 'user'));

     }
     public function EditVendor($id)
     {
         //
         $user = DB::table('users')->where('id', $id)->first();
         return view('super-admin.user.vendor-edit',compact( 'user'));

     }
     public function EditCustomer($id)
     {
         //
         $user = DB::table('users')->where('id', $id)->first();
         return view('super-admin.user.customer-edit',compact( 'user'));

     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function UpdateSuperUser(Request $request, $id)
     {
         //
         $validated = $request->validate([
             'user_logo' => 'mimes:jpg,jpeg,png',
         ],
             [
                 'user_logo.required' => 'user Logo type must be JPG,JPEG or PNG',
             ]);

         $old_image = $request->old_image;
         $user_image = $request->file('avatar');
         if(!empty($request->new_password) ){
            DB::table('users')->where('id', $id)->update([
                'password' => Hash::make($request->new_password)
             ]);
        }
       /* if(!empty($request->avatar) && !empty($old_image) ){
            if (file_exists(public_path().'/'.$old_image)){
            unlink(public_path().'/'.$old_image);
        	}
        }
		*/
         if($user_image){
             $originalImage= $request->file('avatar');

			 $path = Storage::disk('s3')->put('images', $originalImage, 'public');




$last_img = Storage::disk('s3')->url($path); // Get the URL from S3.
             DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->new_password),
                'status' => $request->status,
                'profile_photo_path' => $last_img,
                 'updated_at' => Carbon::now()
             ]);

         }
         else{
             DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->new_password),
                'status' => $request->status,
                 'updated_at' => Carbon::now()
             ]);
         }

         $notifications = array(
            'message' => 'User Updated Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('super.user.index')->with($notifications);
     }
     public function UpdateVendor(Request $request, $id)
     {
         //
         $validated = $request->validate([
             'user_logo' => 'mimes:jpg,jpeg,png',
         ],
             [
                 'user_logo.required' => 'user Logo type must be JPG,JPEG or PNG',
             ]);

         $old_image = $request->old_image;
         $user_image = $request->file('avatar');
         if(!empty($request->new_password) ){
            DB::table('users')->where('id', $id)->update([
                'password' => Hash::make($request->new_password)
             ]);
        }
       /* if(!empty($request->avatar) && !empty($old_image) ){
            if (file_exists(public_path().'/'.$old_image)){
            unlink(public_path().'/'.$old_image);
        	}
        }
		*/
         if($user_image){
             $originalImage= $request->file('avatar');





        $bannerPath = 'images/' . hexdec(uniqid()) . '.' . $originalImage->getClientOriginalExtension();

        // Resize the logo image before uploading to S3
        $resizedbanner = Image::make($originalImage)->resize(500, 500);

        // Convert the Intervention Image instance to a stream for storage
        $resizedbannerStream = $resizedbanner->stream();

        // Upload the resized logo image to S3
        Storage::disk('s3')->put($bannerPath, $resizedbannerStream->__toString(), 'public');

        // Get the S3 URL for the uploaded logo image
        $last_img = Storage::disk('s3')->url($bannerPath);




            /* $name_gen = hexdec(uniqid()).".".($originalImage->getClientOriginalExtension());
             Image::make($originalImage)->resize(500,500)->save(public_path().'/avatars/'.$name_gen );
             $last_img = "avatars/".$name_gen;
			 */

             DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'disable_restaurant' => $request->disable_restaurant,
                'profile_photo_path' => $last_img,
                 'updated_at' => Carbon::now(),
                 'company_name' => $request->company_name,
                 'tax_id' => $request->tax_id,
                 'vat_number' => $request->vat_number,
                 'sdi_code' => $request->sdi_code,
                 'pec' => $request->pec
             ]);

         }
         else{
             DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'disable_restaurant' => $request->disable_restaurant,
                'updated_at' => Carbon::now(),
                'company_name' => $request->company_name,
                 'tax_id' => $request->tax_id,
                 'vat_number' => $request->vat_number,
                 'sdi_code' => $request->sdi_code,
                 'pec' => $request->pec
             ]);
         }
         if($request->vendor_payment_password){
		 	DB::table('users')->where('id', $id)->update([
                'vendor_payment_password' => NULL,
             ]);
		 }
         if($request->new_password){
		 	DB::table('users')->where('id', $id)->update([
                'password' => Hash::make($request->new_password),
             ]);
		 }
         if($request->vendor_commission && $request->vendor_commission>0){
            DB::table('users')->where('id', $id)->update([
               'vendor_commission' => $request->vendor_commission,
            ]);
        }
         $notifications = array(
            'message' => 'User Updated Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('vendor.user.index')->with($notifications);
     }

     public function UpdateCustomerUser(Request $request, $id)
     {
         //
         $validated = $request->validate([
             'user_logo' => 'mimes:jpg,jpeg,png',
         ],
             [
                 'user_logo.required' => 'user Logo type must be JPG,JPEG or PNG',
             ]);

         $old_image = $request->old_image;
         $user_image = $request->file('avatar');
         if(!empty($request->new_password) ){
            DB::table('users')->where('id', $id)->update([
                'password' => Hash::make($request->new_password)
             ]);
        }
        if(!empty($request->avatar) && !empty($old_image) ){
            if (file_exists(public_path().'/'.$old_image)){
            unlink(public_path().'/'.$old_image);
        	}
        }
         if($user_image){


             $originalImage= $request->file('avatar');





        $bannerPath = 'images/' . hexdec(uniqid()) . '.' . $originalImage->getClientOriginalExtension();

        // Resize the logo image before uploading to S3
        $resizedbanner = Image::make($originalImage)->resize(500, 500);

        // Convert the Intervention Image instance to a stream for storage
        $resizedbannerStream = $resizedbanner->stream();

        // Upload the resized logo image to S3
        Storage::disk('s3')->put($bannerPath, $resizedbannerStream->__toString(), 'public');

        // Get the S3 URL for the uploaded logo image
        $last_img = Storage::disk('s3')->url($bannerPath);
             DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->new_password),
                'status' => $request->status,
                'profile_photo_path' => $last_img,
                 'updated_at' => Carbon::now()
             ]);

         }
         else{
             DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->new_password),
                'status' => $request->status,
                 'updated_at' => Carbon::now()
             ]);
         }

         $notifications = array(
            'message' => 'User Updated Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->route('customer.user.index')->with($notifications);
     }
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function DeleteUser($id)
     {
         //
         $user = DB::table('users')->where('id', $id)->first();
         $old_image = $user->profile_photo_path;
//         unlink($old_image);
         DB::table('users')->where('id', $id)->delete();
         $notifications = array(
             'message' => 'User Deleted Successfully!',
             'alert-type' => 'deleted'
         );
         return Redirect()->back()->with($notifications);
     }
 //    User area End

 }

