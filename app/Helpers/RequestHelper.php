<?php
namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Facade;

class RequestHelper extends Facade{

    public static function sendRequest($params){
        $client = new Client();
        $response = $client->request(
            $params['request_method'],
            $params['base_uri'], 
            $params['options']
        );
        return $response->getBody();
    }
}