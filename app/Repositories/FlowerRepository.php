<?php
namespace App\Repositories;

use App\Models\Flower;
use Illuminate\Support\Facades\Auth;

class FlowerRepository{

    private $flower;

    public function __construct(Flower $flower)
    {
        $this->flower = $flower;
    }

    public function index(){
        return $this->flower->with('profile')->get();
    }

    public function create($request, $api_token){
        $flower = new $this->flower;

        $flower->name = $request['name'];
        $flower->email =$request['email'];
        $flower->password = $request['password'];
        $flower->api_token = $api_token;
        $flower->save();
        
        return $flower->fresh();
    }

    public function get($id){
        return $this->flower
            ->where('id', $id)
            ->get();
    }

    public function update($request){
        Auth::user()->update($request->all());
    }

    public function delete($id){
        if($flower = $this->flower->find($id)){
            $flower->delete();
            return true;
        }
        return false;
    }
}