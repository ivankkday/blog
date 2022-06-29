<?php
namespace App\Helpers;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Facade;

class RequestHelper extends Facade{

    public static function sendRequest($params){
        $client = new Client();
        $response = $client->request(
            $params['request_method'],
            $params['uri'], 
            $params['options']
        );
        return $response;
    }
}