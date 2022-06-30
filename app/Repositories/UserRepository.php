<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(){
        return $this->user->with('profile')->get();
    }

    public function create($request, $api_token){
        $user = new $this->user;

        $user->name = $request['name'];
        $user->email =$request['email'];
        $user->password = $request['password'];
        $user->api_token = $api_token;
        $user->save();
        
        return $user->fresh();
    }

    public function get($id){
        return $this->user
            ->where('id', $id)
            ->get();
    }

    public function update($request){
        Auth::user()->update($request->all());
    }

    public function delete($id){
        if($user = $this->user->find($id)){
            $user->delete();
            return true;
        }
        return false;
    }
}