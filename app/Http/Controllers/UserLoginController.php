<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Str;

class UserLoginController extends Controller
{
    public function UserLogin (Request $request)
    {
        $user = User::where([
            'email' => $request->FEmail,
            'password' => $request->FPassword
            ])->first();

        $apiToken = Str::random(10);
        if ($user->update(['api_token'=>$apiToken])) {         
                              //  update api_token

            return "login as User, your api token is $apiToken";
        }
    }
}
