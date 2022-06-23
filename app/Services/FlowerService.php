<?php
namespace App\Services;

use App\Models\Flower;
use APP\Repositories\FlowerRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FlowerService{
    private $flowerRepo;

    public function __construct(FlowerRepository $flowerRepository){
        $this->flowerRepo = $flowerRepository;
    }

    public function create($request){
        $request->validate([//驗證規則
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:flowers'],
            'password' => ['required', 'string', 'min:6','max:12'],
        ]);
        $api_token= Str::random(10);//隨機token驗證用
        $Create = $this->flowerRepo->create($request, $api_token);
        return $Create;
    }

    public function update($request){
        $request->validate([
            'name',
            'email' => 'unique:users|email',
            'password',
        ]);

        Auth::user()->update($request->all());

        echo  '資料修改成功，以下爲修改結果';
    }
}