<?php
class SendDevicePush {

    var $url = "http://203.162.79.56/PushGateway/device/service_mobo?";
    var $key = "wVrxwyXnRf84xAdW";
    var $partner  = '1';
    var $service_id = '97';
    var $package_name = array(
        'ios' => 'id935124291',
        'android' => 'id935124291',
    );
    function __construct() {
        
    }
    
    public function send_device($params){
        $params['platform'] = '1';
        $params['packageName'] = $this->package_name[$params['os']];
        $params['env'] = '2';
        $params['lang'] = 'vn';
        $params['partner'] = $this->partner;
        $params['service_id'] = $this->service_id;
        $params['gender'] = 'male';
        
        $params['token'] = md5($params['deviceToken'] . $params['deviceModel'] . $params['platform'] . $params['os'] . $params['packageName'] . $params['env'] . $params['lang'] . $params['partner'] . $params['service_id'] . $params['secretKey']. $this->key) ;
        
        
        $link = $this->url . http_build_query($params);
        
        $result = @file_get_contents($link);
        MeAPI_Log::writeCsv(array($link, $result), 'send_device_' . date('H'));
		return $result;
    }

}

?>
