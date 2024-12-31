<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        $user = Socialite::with('google')->user();
        
        $existUser = User::where("UUID", $user->id)->first();
        
        if(isset($existUser)){
            
            $existUser->email = $user->email;
            $existUser->user_token = $user->token;
            $existUser->refreshToken = $user->refreshToken;

            $existUser->save();
            
            return $this->redirectLogin($existUser);
            
        } else{

            $newUser = User::create([
                "UUID" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "avatar" => $user->avatar,
                "user_token" => $user->token,
                "refreshToken" => $user->refreshToken,
            ]);
            
            return $this->redirectLogin($newUser);
        }

    }

    private function redirectLogin($user)
    {
        Auth::login($user);
        return redirect('/profile')->with('status', 'Successfully <strong>Login</strong>');
    }

    public function logout()
    {    
        Auth::logout();

        session()->invalidate();
        
        session()->regenerateToken();

        return redirect('/')->with('status','Successfully <strong>Logout</strong>');
    }
}
