<?php

namespace App\Http\Controllers;
use Mail;
use App\Rules\Captcha;
use App\Models\Account;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
use Validator;
session_start();
class AccountController extends Controller{
    
    public function index()
    {
        $accounts = DB::table('accounts')->get();
        // return 'OKI';
        // print_r(json_decode($accounts));
        return view('account.profile', ['accounts'=>(array)json_decode($accounts)[0]]);
    }
    public function signIn()
    {
        return view('account.signIn',['note'=>"Welcome Sign In!!!"]) ;
    }
    public function handleSignIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'bail|required|max:225',
            'password'=>'bail|required|min:6|max:18',
        ]);
        if($validator->passes())
        {
        $error_validated=null;
            $email = $_POST['email'];
        $password = $_POST['password'];
        $result = Account::where('email','=',$email)->where('password','=',$password)->get();
             if(count(json_decode($result))==1)
             {
                $_SESSION['email']=$email;
                // print_r(json_decode($result));
                $account = true;
             }
             else
             {
                $account=null;
             }
        }
        else
        {
            $account=null;
        }
        return response()
            ->json(['account'=>$account,
                'validateErrors'=>$error_validated,
            ]) ;
    }
    public function handleSignUp()
    {
        $secret = env('CAPTCHA_SECRET');
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        {

            $new_account = new Account;
            
            $new_account->email=$_POST['email'];
            $new_account->password=$_POST['password'];
            $new_account->fname=$_POST['fname'];
            $new_account->lname=$_POST['lname'];
            $new_account->account_numphone=$_POST['account_numphone'];
            $new_account->save();
            return response()->json(['account'=>true]);
        }
        else
        {
            return response()->json(['account'=>null]);
        }
    }
    public function handleCheckLoginEd()
    {
        // echo isset($_SESSION['email']);
        return response()->json(['account'=>isset($_SESSION['email']) ]) ;
    }
    public function handleSignOut()
    {
        unset($_SESSION['email']);
        return response()->json(['signOuted'=>!isset($_SESSION['email']) ]) ;
    }
    function RestorePass()
    {
        $result=Account::where('email','=',$_POST['email'])
        ->get();
        if(count(json_decode($result))==1)
        {

            if(isset($_SESSION['code']))
            {
                if($_POST['code']==$_SESSION['code'])
                {
                    $result=Account::where('email','=',$_POST['email'])
                    ->limit(1)->update(array('password'=>$_POST['newPass']));
                    unset($_SESSION['code']);
                    return response()->json(['result'=>true]);
                }
                else
                {
                    return response()->json(['result'=>false]);
                }
            }
            else
            {
                $this->sendCodeChangePass((json_decode($result)[0])->email);
                return response()->json(['result'=>'code']);
            }
        }
        else
        {
            return response()->json(['result'=>"ErrorEmail"]);
        }
    }
    function changePass()
    {
        $result=Account::where('email','=',$_SESSION['email'])
        ->where('password','=',$_POST['oldPass'])
        ->get();
        if(count(json_decode($result))==1)
        {

            if(isset($_SESSION['code']))
            {
                if($_POST['code']==$_SESSION['code'])
                {
                    $result=Account::where('email','=',$_SESSION['email'])
                    ->limit(1)->update(array('password'=>$_POST['newPass']));
                    unset($_SESSION['code']);
                    return response()->json(['result'=>true]);
                }
                else
                {
                    return response()->json(['result'=>false]);
                }
            }
            else
            {
                $this->sendCodeChangePass((json_decode($result)[0])->email);
                return response()->json(['result'=>'code']);
            }
        }
        else
        {
            return response()->json(['result'=>"ErrorEmail"]);
        }
    }
    public function sendCodeChangePass($emailTo)
    {
        $_SESSION['code']= rand(10000,99999);
        Mail::send([],['emailTo'=>$emailTo], function ($message) use ($emailTo) {
            $message->from('ilovethubumbi@gmail.com', 'Code Verification from Life-Sound');
            $message->to($emailTo);
            $message->subject("Adu Vip");
            $message->setBody( 'Code : '.$_SESSION['code']);
        });
        return response()->json(['Restore Password']);
    }
}
?>
