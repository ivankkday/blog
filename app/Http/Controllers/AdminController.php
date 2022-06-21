<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:admins'],
            'password' => ['required', 'string', 'min:8','max:12'],
        ]);
        $api_token= Str::random(10);
        $Create=Admin::create([
            'name' =>$request['name'],
            'email' =>$request['email'],
            'password' => $request['password'],
            'api_token' => $api_token,
        ]);
        if ($Create)
            return "管理員註冊成功...$api_token";
    }


    public function show()
    {
       return Flower::all();     // 查詢所有的花兒（會員）資料
    }


    public function update(Request $request)
    {
        $request->validate([
            'name',
            'email' => 'unique:users|email',
            'password',
        ]);
        Auth::user()->update($request->all());
        return 'Admin updated successfully';
    }


    public function destroy($id)        // 需指定型態，用花兒（會員）的id 做辨識
    {
        $flower = Flower::where('id',$id);     
        if ($flower && $flower->delete()){
            return '管理員已刪除' .$id;
        }
        else{
            return '未成功刪除';
        }
    }

}
