<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class FacebookLoginController extends Controller
{
    public function redirectToProvider($provider){

        return Socialite::driver($provider)->redirect();
    }

    public function handelRedirectCallback($provider){

        $getInfo = Socialite::driver($provider)->user();
     
        $user = $this->createUser($getInfo,$provider);
     
        auth()->login($user);
     
        return redirect()->to('/');
    }

    function createUser($getInfo,$provider){
 
        $user = User::where('provider_id', $getInfo->id)->first();
        
        if (!$user) {
            $user = User::create([
               'name'     => $getInfo->name,
               'email'    => $getInfo->email,
               'password' => encrypt('user@123'),
               'provider' => $provider,
               'provider_id' => $getInfo->id
           ]);
        }
        return $user;
    }
}
