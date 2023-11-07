<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LocalAccount;
use Illuminate\Support\Facades\DB;
class LocalAccountController extends Controller
{
    function add_localAccount_whenSignUp($obj_account)
    {
        $new_localAccount = LocalAccount::firstOrNew(['id_account'=>($obj_account->id_account)]);
        $new_localAccount->name_account=$obj_account->fname;
        $new_localAccount->phone_account=$obj_account->account_numphone;
        $new_localAccount->email_account=$obj_account->email;

        $new_localAccount->save();

    }
}
