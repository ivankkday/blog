<?php
namespace App\Repositories;

use App\Models\Flower;
use Illuminate\Support\Str;

class FlowerRepository{

    private $flower;

    public function __construct(Flower $flower)
    {
        $this->flower = $flower;
    }

    public function create($request, $api_token){
        $Create= $this->flower->save([
            'name' =>$request['name'],
            'email' =>$request['email'],
            'password' => $request['password'],
            'api_token' => $api_token
        ]);
        return $Create;
    }
}