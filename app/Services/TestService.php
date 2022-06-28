<?php
namespace App\Services;
use App\Helpers\RequestHelper;

class TestService{
    public function test(){
        $params['request_method'] = 'GET';
        $params['base_uri'] = 'httpbin.org/get';
        $params['options'] = [];

        $response = RequestHelper::sendRequest($params);

        return $response;
    }
}