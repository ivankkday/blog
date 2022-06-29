<?php
namespace App\Services;

use App\Repositories\FlowerRepository;
use Illuminate\Support\Str;

class FlowerService{
    private $flowerRepo;

    public function __construct(FlowerRepository $flowerRepository){
        $this->flowerRepo = $flowerRepository;
    }

    public function index(){
        return $this->flowerRepo->index();
    }

    public function create($request){
        $api_token= Str::random(10);//隨機token驗證用
        $Create = $this->flowerRepo->create($request, $api_token);
        return $Create;
    }

    public function update($request){
        $this->flowerRepo->update($request);

        echo  '資料修改成功，以下爲修改結果';
    }

    public function destroy($id){
        $flowerDelete = $this->flowerRepo->delete($id);
        if ($flowerDelete){
            return 'Flower deleted successfully';
        }
        else{
            return '未成功刪除';
        }
    }
}