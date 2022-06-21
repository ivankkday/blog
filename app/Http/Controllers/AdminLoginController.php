<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Str;

class AdminLoginController extends Controller
{
    $admin = Admin::where([
        'email' => $request -> AEmail,
        'password' => $request -> APassword
    ])->first();

    $apiToken = Str::random(10);

    if ($gardener->update(['api_token'=>$apiToken])) { //update api_token

        return "管理員成功登入, 你的 api token is $apiToken";
}
