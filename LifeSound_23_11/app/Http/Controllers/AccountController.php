<?php

namespace App\Http\Controllers;
use Mail;
use Validator;
use App\Rules\Captcha;
use App\Models\Account;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LocalAccountController;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use stdClass;

// use Illuminate\Support\Facades\Mail;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class AccountController extends Controller{
    
    public function index()
    {
        if(isset($_SESSION['id_loginEd']))
        {
            $account = Account::where('id_account','=',$_SESSION['id_loginEd'])->get();
            if(count($account)>0)
            {
                return view('account.profile', ['account'=>json_decode($account[0])]);
            }
        }
        else
        {
            return redirect('/');
        }
        // print_r(json_decode($account));
    }
    public function getInfoBasicAccount()
    {
        $result =Account::select(array(
            'account_numphone'
            ,'fname'
            ,'lname'
            ,'email'
            ,'url_avatar_account'
            ,'google_id'
        ))->where(
            'id_account','=',$_SESSION['id_loginEd']
        )->get()[0];
        
        $result->type=((isset($result->google_id) || isset($result->facebook_id)));
        unset($result->google_id);
        return response()->json(['result'=>$result]);
    }
    public function signIn()
    {
        return view('account.signIn',['note'=>"Welcome Sign In!!!"]) ;
    }
    public function handleSignIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|max:225',
            'password' => 'bail|required|min:6|max:18',
        ]);

        if ($validator->passes()) {
            $error_validated = null;
            $email = $request->input('email'); // Lấy dữ liệu email từ request
            $password = $request->input('password'); // Lấy dữ liệu password từ request

            $result = Account::where('email', '=', $email)->where('password', '=', $password)->get();

            if (count(json_decode($result)) == 1) {
                $_SESSION['id_loginEd'] = json_decode($result)[0]->id_account;
                $account = true;
            } else {
                $account = null;
            }
        } else {
            $account = null;
        }

        return response()->json([
            'account' => $account,
            'validateErrors' => $error_validated,
        ]);
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
            $new_account->id_account = AccountController::getMaxID_account();
            LocalAccountController::add_localAccount_whenSignUp($new_account);
            return response()->json(['account'=>true]);
        }
        else
        {
            return response()->json(['account'=>null]);
        }
    }
    public static function getMaxID_account()
    {
        return (Account::orderBy('id_account', 'DESC')->get(array('id_account')))[0]->id_account;
    }
    public function getEmailAccount_withIDAccount($IDAccount)
    {
        $result =Account::where('id_account','=',$IDAccount)->get();
        if(count(json_decode($result))>0)
        {
            return json_decode($result)[0]->email; 
        }
        else
        {
            return null; 
        }
    }

    public function handleCheckLoginEd()
    {
        if(isset($_SESSION['listProductOrder_cart']))
        {
            if(isset($_SESSION['id_loginEd']))
            {
                CartController::SaveListProductCart_forController_withEmail(AccountController::getEmailAccount_withIDAccount($_SESSION['id_loginEd']));
            }
        }
        if(isset($_SESSION['id_loginEd'])) {
            $avt_url = DB::table('accounts')->where('id_account', '=', $_SESSION['id_loginEd'])->get('url_avatar_account');
            $fname = DB::table('accounts')->where('id_account', '=', $_SESSION['id_loginEd'])->get('fname');
            $cut_long_name = explode(" ", $fname[0]->fname);
            $after_cut = end($cut_long_name);
            $name_customer = substr($after_cut, 0, 7);
            return response()->json(['account'=>isset($_SESSION['id_loginEd']), 'id_account'=>$_SESSION['id_loginEd'], 'avt_url' => json_decode($avt_url), 'name_customer' => $name_customer]);
        }
        return response()->json(['account'=>isset($_SESSION['id_loginEd']),'avt_url' => '', 'name_customer' => '']);
    }

    public function handleSignOut()
    {
        unset($_SESSION['id_loginEd']);
        return response()->json(['signOuted'=>!isset($_SESSION['id_loginEd']) ]) ;
    }

    function updateInfoBasicAccount()
    {
        $result = Account::where('id_account','=',$_SESSION['id_loginEd'])
        ->limit(1)->update(array(
            'fname'=>$_POST['fname']
            ,'lname'=>$_POST['lname']
        ));
        return response()->json(['result'=>true]);
    }

    function updateAvatarAccount(Request $request )
    {   
        $urlImg='upload/images/AvatarAccount/';
        $imageName = AccountController::getEmailAccount_withIDAccount($_SESSION['id_loginEd']).'_'.$_SESSION['id_loginEd'].'.'.$request->avatar->extension();
        $result=Account::where('id_account','=',$_SESSION['id_loginEd'])
        ->limit(1)->update(array(
            'url_avatar_account'=>('/'.$urlImg.$imageName)
        ));
        if($request->avatar->move(public_path($urlImg), $imageName))
        {
            return response()->json(['result'=>true]);
        }
    }
    function RestorePass()
    {
        $result=Account::where([
            ['email','=',$_POST['email']]
            ,['google_id','=',null]
        ])
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
        $result=Account::where('id_account','=',$_SESSION['id_loginEd'])
        ->where('password','=',$_POST['oldPass'])
        ->get();
        if(count(json_decode($result))==1)
        {

            if(isset($_SESSION['code']))
            {
                if($_POST['code']==$_SESSION['code'])
                {
                    $result=Account::where('id_account','=',$_SESSION['id_loginEd'])
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
            return response()->json(['result'=>"ErrorPass"]);
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

    public function uploadFileChat(Request $request) {
        $inforLogin = $_SESSION['id_loginEd'];
        if($inforLogin){

            $mess_text = $request->mess_text;
            $mess_image = [];
            foreach($request->allFiles('mess_image') as $file) {
                $mess_image[count($mess_image)] = $file;
            }
            // dd($mess_image);

            $mess_image_for = [];
            foreach($mess_image as $sub_mess_image) {
                if($sub_mess_image) {
                    $getNameFileImage = $sub_mess_image->getClientOriginalName();
                    $nameFile_ = current(explode('.',$getNameFileImage));
                    $nameFile = explode('_',$nameFile_)[0];
                    if($nameFile == 'mess') {
                        $get_name_image = $sub_mess_image->getClientOriginalName();
                        $name_image = current(explode('.',$get_name_image));
                        $new_image = $name_image.rand(0,99).'.'.$sub_mess_image->getClientOriginalExtension();
                        $sub_mess_image->move('upload/Mess/',$new_image);
                        $new_link_image = '/upload/Mess/'.$new_image;
                        $mess_image_for[count($mess_image_for)] = $new_link_image;
                        $mess_image_data = $new_link_image;
                        $insertImage = DB::table('message')->insert([
                            'id_send' => $inforLogin,
                            'id_receive' => 0,
                            'mess_image' => $mess_image_data,
                        ]);
                    } 
                }
            }

            if($mess_text != '') {
                $insertText = DB::table('message')->insert([
                    'id_send' => $inforLogin,
                    'id_receive' => 0,
                    'mess_text' => $mess_text,
                ]);
            }

            $dataMess = new stdClass();
            $dataMess->mess_image = $mess_image_for;
            $dataMess->mess_text = $mess_text;


            return response()->json($dataMess);
        }else{
            return Redirect::to('/');
        }
    }

    public function loadChat() {
        $inforLogin = isset($_SESSION['id_loginEd']);
        if($inforLogin){
            $resultData = DB::table('message')
            ->where(['id_send' => $_SESSION['id_loginEd'], 'id_receive' => '0'])
            ->orWhere(function($query) 
            {
                $query->where("id_send", '0')
                    ->where("id_receive", $_SESSION['id_loginEd']);
            })
            ->get(
                array(
                    'id_mess',
                    'id_send',
                    'id_receive',
                    'mess_text',
                    'mess_image',
                    'mess_time'
                    )
            );
            return response()->json($resultData);
        } else {
            return Redirect::to('/');
        }
    }
}

