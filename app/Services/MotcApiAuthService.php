<?php
namespace App\Services;

use App\Helpers\RequestHelper;

class MotcApiAuthService{
    const MOTC_API_URL="https://ptx.transportdata.tw/MOTC/";
    const MOTC_ID="449486a53acf442181ec5aa06db7c2f9";
    const MOTC_KEY='EJs6O1ss8BTkgqR11mIQAw9OAPg';

    public function test($health){
       
        $params['request_method'] = 'GET';
        $params['uri'] = self::MOTC_API_URL.'/v2/Rail/THSR/DailyTimetable/TrainDates';
        $params['options'] = [
            "query" => ['health' => $health? "true":"false"],
            "headers" => $this->getHeaders(),
            "http_errors" => false,
            ];
        
        $response = RequestHelper::sendRequest($params);
        echo $response->getBody();
        // return $response->getBody();
    }
    public function authorize($xdate){
        return 'hmac username="'.self::MOTC_ID.'",algorithm="hmac-sha1",headers="x-date",signature="'.$this->signature($xdate).'"';
    }
    public function signature($xdate){
        return base64_encode(hash_hmac('sha1', "x-date: ".$xdate, self::MOTC_KEY, true));
    }

    public function getHeaders(){
        $xdate = $this->getXDate();
        return [
            'Authorization' => $this->authorize($xdate),
            'x-date' => $xdate,
            'Accept' => 'application/json',
            'Accept-Encoding' => 'gzip, deflate'
        ];

    }

    public function getXDate(){
        return date('D, d M Y H:i:s \G\M\T');
    }
}