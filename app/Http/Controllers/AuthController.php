<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

use function PHPSTORM_META\type;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        $request->session()->put('state', $request->get('state'));

        // dd(session());
        $user = Socialite::driver('google')->user();
        
        $existUser = User::where("UUID", $user->id)->first();
        
        $checkEmail = $user->email == "hanifnandaafrian7@gmail.com";

        if(isset($existUser)){
            
            $existUser->email = $user->email;
            $existUser->user_token = $user->token;
            $existUser->refreshToken = $user->refreshToken;

            $existUser->save();

            if($checkEmail){
                return $this->redirectLogin($existUser,'/su-admin');
            } else{
                return $this->redirectLogin($existUser);
            }
            
        } else{

            $newData = [
                "UUID" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "avatar" => $user->avatar,
                "user_token" => $user->token,
                "refreshToken" => $user->refreshToken,
            ];

            if($checkEmail){
                $newData += [
                    "type" => "admin"
                ];
            };
            
            $newUser = User::create($newData);
        
            if($checkEmail){
                return $this->redirectLogin($newUser,'/su-admin');
            } else{
                return $this->redirectLogin($newUser);
            }
        }

    }

    private function redirectLogin($user, $url = '/profile/')
    {
        Auth::login($user);

        $rUrl = ($url == '/su-admin') ? $url : $url . Auth::user()->UUID;

        return redirect($rUrl)->with('status', ['success','Successfully <strong>Login</strong>']);
    }

    public function logout()
    {    
        Auth::logout();

        session()->invalidate();
        
        session()->regenerateToken();

        return redirect('/')->with('status',['success','Successfully <strong>Logout</strong>']);
    }
}
