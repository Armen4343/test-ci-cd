<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMobile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use App\Mail\NewRestaurantAdmin;
use App\Mail\NewBuyerAdmin;
use App\Mail\VendorRegister;
use App\Mail\Register;
use Carbon\Carbon;
class UsersController extends Controller
{
    //
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ]
        ]);
        if(request()->hasfile('profile')){
            $profileName = rand().time().'.'.request()->profile->getClientOriginalExtension();
            request()->profile->move(public_path('avatars'), $profileName);
            $profileName = 'avatars/'.$profileName;
        }
        // dd($profileName);
        $email_confirm_code = random_int(1000000, 9999999);
        $token = Str::random(64);

         $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'phone' => request()->phone,
            'country' => request()->country,
            'state' => request()->state,
            'city' => request()->city,
            'role' => 'buyer',
            'token' => null,
            'status' => 'active',
            'termsandconditions' => request()->termsandconditions,
            'profile_photo_path' => $profileName ?? NULL,
            'password' => Hash::make(request()->password),
            'email_confirm_code' => null,
            'email_verified_at' => Carbon::now(),
        ]);

		// send mail to admin
		$details = [
        	'name' => request()->name,
            'email' => request()->email,
            'phone' => request()->phone,
            'country' => request()->country,
            'state' => request()->state,
            'city' => request()->city,
            'zipcode' => request()->zipcode,
            'role' => 'Buyer',
            'status' => 'active',
            'profile_photo_path' => $profileName ?? NULL
       ];
		 Mail::to('info@zeepup.com')->send(new NewBuyerAdmin($details));
		 //Mail::to('nomanali7788459@gmail.com')->send(new NewBuyerAdmin($details));

        Auth::login($user);
         return redirect()->to('/login')->with('message', 'Registrato con successo! Inserisci il codice ricevuto via email')->with('email', request()->email)->with('isCodeModal', true);
    }

    public function verifyEmail(Request $request)
    {
        $user = User::where(DB::raw('BINARY `email`'), $request->get('email'))->first();

        if (!$user) {
            return redirect()->route('login')->with('message', 'Utente non registrato');
        }

        if ($user->email_confirm_code !== $request->get('code')) {
            return redirect()->route('login')->with(['codeMessage' => 'Codice invalido', 'isCodeModal' => true, 'email' => $request->get('email')]);
        }

        $user->email_verified_at = Carbon::now();
        $user->email_confirm_code = null;
        $user->token = null;
        $user->save();

        return redirect()->route('login')->with('message', 'Email verificata con successo!');
    }

    public function resendCode(Request $request)
    {
        $user = User::where(DB::raw('BINARY `email`'), $request->get('email'))->first();

        if (!$user) {
            return response()->json(['message' => 'Utente non registrato', 'class' => 'alert-danger']);
        }

        $email_confirm_code = random_int(1000000, 9999999);
        $token = Str::random(64);

        $user->email_confirm_code = $email_confirm_code;
        $user->token = $token;
        $user->save();

        $details = [
            'name' => $user->name,
            'token' => $token,
            'email_confirm_code' => $email_confirm_code
        ];
        Mail::to($user->email)->send(new RegisterMobile($details));

        return response()->json(['message' => 'Comunicazione inviata al tuo indirizzo email', 'class' => 'alert-success']);
    }

	public function storeVendorAjax(Request $request)
    {
		$validator=Validator::make($request->all(), [

			'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
        if(request()->hasfile('profile_photo_path')){
            $profileName = rand().time().'.'.request()->profile_photo_path->getClientOriginalExtension();
            request()->profile_photo_path->move(public_path('avatars'), $profileName);
            $profileName = 'avatars/'.$profileName;
        }
        if(request()->hasfile('banner_photo_path')){
            $bannerName = rand().time().'.'.request()->banner_photo_path->getClientOriginalExtension();
            request()->banner_photo_path->move(public_path('avatars'), $bannerName);
            $bannerName = 'avatars/'.$bannerName;
        }

        $token = Str::random(64);
         User::create([
            'name' => request()->name,
            'manager_name' => request()->manager_name,
            'email' => request()->email,
            'token' => $token,
            'phone' => request()->phone,
            'country' => request()->country,
            'state' => request()->state,
            'city' => request()->city,
            'zipcode' => request()->zipcode,
            'business_description' => request()->business_description,
            'address' => request()->address,
            'street_number' => request()->street_number,
            'role' => 'vendor',
            'status' => 'active',
			 'termsandconditions' => request()->termsandconditions,
            'profile_photo_path' => $profileName ?? NULL,
            'banner_photo_path' => $bannerName ?? NULL,
            'password' => Hash::make(request()->password),

             'company_name' => request()->company_name,
             'tax_id' => request()->tax_id,
             'vat_number' => request()->vat_number,
             'sdi_code' => request()->sdi_code,
             'pec' => request()->pec
        ]);
        // send mail to admin
		$details = request()->all();
		$details = [
        	'name' => request()->name,
            'email' => request()->email,
            'phone' => request()->phone,
            'country' => request()->country,
            'state' => request()->state,
            'city' => request()->city,
            'zipcode' => request()->zipcode,
            'role' => 'vendor',
            'status' => 'active',
            'business_description' => request()->business_description,
            'profile_photo_path' => $profileName ?? NULL,
            'banner_photo_path' => $bannerName ?? NULL
       ];
		 Mail::to('info@zeepup.com')->send(new NewRestaurantAdmin($details));

	// Send mail to user
		$details = [
        	'name' => request()->name,
        	'token' => $token
    ];
		 Mail::to(request()->email)->send(new VendorRegister($details));
        return response()->json(['success' => 'Registrato con successo, controlla la tua casella di posta elettronica.']);
        // return redirect()->to('/login')->with('message', 'Register successfully!');
    }
	// verify Account
	 public function verifyAccount($token)
    {
        $verifyUser = User::where('token', $token)->first();

        $message = 'Prova di nuovo a inserire i tuoi dettagli';

        if(!is_null($verifyUser) ){
            if(!$verifyUser->email_verified_at) {
                $data = User::find($verifyUser->id);
				$data->email_verified_at = Carbon::now();
				$data->token = '';
				$data->status = 'active';
				$data->save();
                $message = "La tua email e' stata verificata. Ora puoi accedere.";
            } else {
                $message = "La tua email e' stata verificata. Ora puoi accedere";
            }
        }

      return redirect()->route('login')->with('message', $message);
    }
	public function checkVendorAjaxEmail(Request $request){
		# check user if match with database user
		$email = request()->email;
		$users = User::where('email', $email)->get();

		# check if email is more than 1
		if(sizeof($users) > 0){
			return response()->json(['error' => 'Email non disponibile']);
		}
		return response()->json(['success' => 'Nessun utente registrato con questa email']);

	}

}
