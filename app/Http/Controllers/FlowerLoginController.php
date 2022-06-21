<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower;
use Str;

class FlowerLoginController extends Controller
{
    public function FlowerLogin (Request $request)
    {
        $flower = Flower::where([
            'email' => $request->FEmail,
            'password' => $request->FPassword
            ])->first();

        $apiToken = Str::random(10);
        if ($flower->update(['api_token'=>$apiToken])) {         
                              //  update api_token

            return "login as Flower, your api token is $apiToken";
        }
    }
}
