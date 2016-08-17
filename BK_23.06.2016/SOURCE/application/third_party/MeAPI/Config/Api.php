<?php

class MeAPI_Config_Api {

    public static function getSecretKey($app) {
        $config = array(
            'skylight' => '2IFGS3M7EFJUFJOR',
			'me' => '2IFGS3M7EFJUFJOR',
        );
        return $config[$app];
    }
    public static function facebook_config($key){
        $config = array(
            "share_limit" => 300000,
            "share_time_limit" => 60*60*0, //seconds
        );
        return $config[$key];
    }
    
}
