<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        $request->session()->put('state', $request->get('state'));

        // dd(session());
        $user = Socialite::driver('google')->user();
        
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
        return redirect("/profile/". Auth::user()->UUID)->with('status', ['success','Successfully <strong>Login</strong>']);
    }

    public function logout()
    {    
        Auth::logout();

        session()->invalidate();
        
        session()->regenerateToken();

        return redirect('/')->with('status',['success','Successfully <strong>Logout</strong>']);
    }
}
