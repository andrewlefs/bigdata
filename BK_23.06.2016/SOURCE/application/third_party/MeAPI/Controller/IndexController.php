<?php

class MeAPI_Controller_IndexController extends MeAPI_Core_Bootstraps implements MeAPI_Interface_IndexInterface {
    
    protected $_response;
    
    public function index(MeAPI_RequestInterface $request) {    	    	    	
       $this->CI->load->MeAPI_Library('SendDevicePush');
        $this->CI->load->MeAPI_Model('MiniAppModel');
        
        $db = $this->CI->MiniAppModel->get_device("device_push");  
        foreach ($db as $key => $value) {
            $params_push = array(
                "deviceToken" => $value['device_token'],
                "deviceModel" => $value['user_agent'],
                "os" => $value['platform'],
            );
            $a = $this->CI->SendDevicePush->send_device($params_push);
            echo $key.":   ".$a."<br/>";
        }
        $this->_response = new MeAPI_Response_APIResponse($request, 'DATA_EMPTY');
        

    }

}
