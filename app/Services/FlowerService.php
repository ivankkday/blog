<?php
namespace App\Services;

use App\Models\Flower;
use APP\Repositories\FlowerRepository;
use Illuminate\Support\Str;

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
        $Create = $this->flowerRepo->create($request->all(), $api_token);
        return $Create;
    }
}