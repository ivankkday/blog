<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Str;

class UserService{
    private $userRepo;

    public function __construct(UserRepository $userRepository){
        $this->userRepo = $userRepository;
    }

    public function index(){
        return $this->userRepo->index();
    }

    public function create($request){
        $api_token= Str::random(10);//隨機token驗證用
        $Create = $this->userRepo->create($request, $api_token);
        return $Create;
    }

    public function update($request){
        $this->userRepo->update($request);

        echo  '資料修改成功，以下爲修改結果';
    }

    public function destroy($id){
        $userDelete = $this->userRepo->delete($id);
        if ($userDelete){
            return 'User deleted successfully';
        }
        else{
            return '未成功刪除';
        }
    }
}