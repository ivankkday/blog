<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Flower;
use App\Models\Profile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Flower::with('profile')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([//驗證規則
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:flowers'],
            'password' => ['required', 'string', 'min:8','max:12'],
        ]);
        $api_token= Str::random(10);//隨機token驗證用
        $Create=Flower::create([
            'name' =>$request['name'],
            'email' =>$request['email'],
            'password' => $request['password'],
            'api_token' => $api_token,
        ]);

        if ($Create)
            return "註冊成功...$api_token";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Auth::user();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name',
            'email' => 'unique:users|email',
            'password',
        ]);

        Auth::user()->update($request->all());

        echo  '資料修改成功，以下爲修改結果';
        return  $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flower = Flower::where('id',$id);
        if ($flower && $flower -> delete()){
            return 'Flower deleted successfully';
        }
        else{
            return '未成功刪除';
        }
    }
}
