<?php

class MeAPI_Config_ResponseCode {

    public static function getCode() {
        return array(
            'INVALID_PARAMS' => -1, 
            'INVALID_TOKEN' => -2,     
            'REQUEST_SUCCESS' => 1000,    
            'REQUEST_ERROR' => 1001,   
            'LIKE_EXIST' => 1002,   
            'DEVICE_NOT_EXIST' => 1003,   
            'SHARE_TIME_ERROR' => 1004,   
            'SHARE_LIMIT_ERROR' => 1005,   
            'INVATE_ACTIVED' => 1006,   
            'EVENT_EXIST' => 1007,
            'CHECK_PHONE' => 2000,
            'PHONE_EXIST' => 2001,
               
        );
    }

}
