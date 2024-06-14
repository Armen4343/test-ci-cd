<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
	{
		return Socialite::driver('google')->redirect();
	}
	
	public function handleGoogleCallback()
	{
		$user = Socialite::driver('google')->user();
		$password = Hash::make('asdf1234');

		// You can access the user's name and email using $user->name and $user->email

		// Check if the user exists in your database, and if not, create a new user
		$existingUser = User::where('email', $user->email)->first();

		if ($existingUser) {
			Auth::login($existingUser);
		} else {
			$newUser = User::create([
				'name' => $user->name,
				'email' => $user->email,
				'password' => $password, // Generate a hash password
			]);

			Auth::login($newUser);
		}

		return redirect('/home'); // Redirect to the desired page after login
	}
}
