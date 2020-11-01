<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\DirectBonus;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

use Socialite;

class SocialiteController extends Controller
{
    //

    



    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {


        $user = Socialite::driver($provider)->user(); 


        $exist = User::where('provider_id', $user->getId() )->first();

        if ($exist) {
            # code...

            auth()->login($exist);

            return redirect('/home');

        }else{

            $regCode = "VICOINS-2020-" .rand(111,999);

            $user_data = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'account_no' => $regCode,
                'avatar' => $user->getAvatar(),
                'provider' =>$provider,
                'provider_id' => $user->getId(),
                'password' => Hash::make($regCode),
            ]);
    
            $db = DirectBonus::create([
                'referree' => $regCode,
                'referral' => $provider,
                'points' => 1200,
                
            ]);
    
            auth()->login($user_data);
    
            return redirect('/home');
        }

             

        

        // $user->token;
    }
}
