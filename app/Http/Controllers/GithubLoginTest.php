<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GithubLoginTest extends Controller
{
    public function github_login(){

        return Socialite::driver('github')->redirect();
    }

    public function github_callback(){

        try {
            $user = Socialite::driver('github')->user();

            dd($user->getName(), $user->getEmail());

            die;
            
            $is_user = User::where('email',$user->getEmail())->first();

            if(!$is_user){
               $save_user =  User::updateOrCreate(
                    [
                        'github_id' => $user->getId()
                    ],
                    [
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'password' => Hash::make($user->getName().'@'.$user->getId()),

                    ]
                );
            }else{

            $save_user = User::where('email',$user->getEmail())->update([
                    'github_id' => $user->getId(),
                ]);

                $save_user = User::where('email',$user->getEmail())->first();

            }

             Auth::loginUsingId($save_user->id);
             return redirect()->route('home');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
