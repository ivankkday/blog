<?php
namespace App\Repositories;

use App\Models\Flower;

class FlowerRepository{

    private $flower;

    public function __construct()
    {
        $this->flower = new Flower();
    }

    public function create($request, $api_token){
        $Create= Flower::create([
            'name' =>$request['name'],
            'email' =>$request['email'],
            'password' => $request['password'],
            'api_token' => $api_token
        ]);
        return $Create;
    }
}