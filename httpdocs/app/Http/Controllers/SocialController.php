<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;
use Carbon\Carbon;
class SocialController extends Controller
{
    public function googleRedirect()
    {
        //return Socialite::driver('google')->scopes(['profile','email'])->redirect();
        return Socialite::driver('google')->redirect();
    }
    public function loginWithGoogle()
    {
        try {
    
            $user = Socialite::driver('google')->stateless()->user();
            $existingUser = User::where('google_id', $user->id)->first();
     
            if($existingUser){
                Auth::login($existingUser);
                return redirect('/dashboard');
            }else{
					
				$trimEmail = substr($user->email, 0, strpos($user->email, "@"));
                $createUser = User::create([
                    'name' => $trimEmail,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'status' => 'active',
                    'email_verified_at' => Carbon::now(),
                    'role' => "buyer",
                ]);
    
                Auth::login($createUser);
                return redirect('/dashboard');
            }
    
        } catch (\Throwable $th) {
          throw $th;
       }
    }
	public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
        try {
    
            $user = Socialite::driver('facebook')->stateless()->user();
            $existingUser = User::where('facebook_id', $user->id)->first();
     
            if($existingUser){
                Auth::login($existingUser);
                return redirect('/dashboard');
            }else{
					if($user->email == NULL){
					$email = $user->id;
					}
					else{
					$email = $user->email;
					}
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $email,
                    'facebook_id' => $user->id,
                    'status' => 'active',
                    'email_verified_at' => Carbon::now(),
                    'role' => "buyer",
                    // 'password' => encrypt('admin@123')
                ]);
    
                Auth::login($createUser);
                return redirect('/dashboard');
            }
    
        } catch (\Throwable $th) {
          throw $th;
       }
    }
}
