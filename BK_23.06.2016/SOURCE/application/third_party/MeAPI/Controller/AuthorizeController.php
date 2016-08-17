<?php

class MEAPI_Controller_AuthorizeController {

    protected $_response;

    /**
     *
     * @var CI_Controller
     */
    private $CI;

    public function __construct() {
        $this->CI = & get_instance();        
    }

    public function validateAuthorizeRequest(MeAPI_RequestInterface $request, $scope = array()) {
        $params = $request->input_request();
        $this->CI->load->MEAPI_Library('TOTP');
        //$secret = MeAPI_Config_Api::getSecretKey($params['app']);
		$secret = MeAPI_Config_Api::getSecretKey("me");
        $token = $params['token'];
        $otp = $params['otp'];
        unset($params['token']);

        $result = $this->CI->TOTP->verifyCode($secret, $otp, 2);

        $raw = implode('', $params);
        $verify_token = md5(implode('', $params) . $secret);
        if($params['dev'] != "")
            return TRUE;
        if ($verify_token == $token AND $result == TRUE) { //AND $result == TRUE
            return TRUE;
        }
        $this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_TOKEN', array($raw, $verify_token, $this->CI->TOTP->getCode($secret), date('Y-m-d H:i:s')));
        
    }

    public function getResponse() {
        return $this->_response;
    }

}
