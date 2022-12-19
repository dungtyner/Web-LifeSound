<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LocalAccountController;
use App\Http\Controllers\AccountController;

use App\Models\UserGmail;
use App\Models\Account;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;

session_start();
class LoginSpecialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            // dd($user);
            $finduser = UserGmail::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
                
                $newUser=Account::firstOrCreate(array(
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'fname'=>$user->name,
                    'url_avatar_account'=>$user->avatar
                ));
                $newUser->id_account = AccountController::getMaxID_account();
                LocalAccountController::add_localAccount_whenSignUp($newUser);
                
                $_SESSION['id_loginEd']=
                (Account::where('google_id',json_decode($finduser)->google_id)->get()[0])->id_account;
                return redirect('/');
       
            }else{
                $newUser = UserGmail::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
                
                Auth::login($newUser);
                $newUser=Account::firstOrCreate(array(
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'fname'=>$user->name,
                    'url_avatar_account'=>$user->avatar
                ));
                $newUser->id_account=AccountController::getMaxID_account();
                LocalAccountController::add_localAccount_whenSignUp($newUser);

                $_SESSION['id_loginEd']=
                (Account::where('google_id',json_decode($newUser)->google_id)->get()[0])->id_account;
                return redirect('/');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
