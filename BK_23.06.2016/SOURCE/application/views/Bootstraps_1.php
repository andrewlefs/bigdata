<?php

class MeAPI_Core_Bootstraps {

    protected $CI;
    protected $_response;
    protected $key = '';
    protected $_key_response = 'INVALID_AUTHORIZE';

    public function getResponse() {
        return $this->_response;
    }

    function __construct() {
        $this->CI = & get_instance();
    }

    public function validate(MeAPI_RequestInterface $request, $params, $param_validate, $str_token) {
        log_server("pay.appone.vn", json_encode($params));
        $token = trim($params[$str_token]);
        $func = $params['func'];
        switch ($params['control']) {
            case 'sms':
                $this->key = $this->_check_sms();
                break;

            case 'card':
                $this->key = $this->_check_card($request, $params, $params[$str_token]);
                break;

            case 'inside':
                $this->key = $this->_check_inside();
                break;

            default:
                break;
        }
        if ($this->key === FALSE) {
            $this->_response = new MeAPI_Response_APIResponse($request, '', $this->_key_response, 'card');
            return FALSE;
        }

        unset($params[$str_token], $params['control'], $params['func']);
        if (is_required($params, $param_validate) == TRUE) {
            $buil_token = md5(implode('', $params) . $this->key);
            if ($token != $buil_token) {
                if ($func == "receive_mo") {
                    $this->_response = new MeAPI_Response_APIResponse($request, '', -1, 'sms');
                    return FALSE;
                }
                $this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_TOKEN');
                return FALSE;
            }
        } else {
            $this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_PARAMS');
            return FALSE;
        }

        return TRUE;
    }

    private function _check_sms() {
        $config = MeAPI_Config_CardSMS::configSms();
        return $config['key'];
    }

    private function _check_inside() {
        $config = MeAPI_Config_CardSMS::config_inside();
        return $config['key'];
    }

    private function _check_card(MeAPI_RequestInterface $request, $params, $token) {
        $this->CI->load->MeAPI_Model('SystemModel');
        $this->CI->load->library('cache');
        $cache = $this->CI->cache->load('memcache', 'system_info');

        $account_info = $cache->store('MeAPI_System_App_CardController' . $params['account'], $this->CI->SystemModel, 'get_app', array($params['account'], $params['app']));
        if ($params['clean'] == 'clean') {
            $cache->clean();
            exit(json_encode($account_info));
        }
        if (empty($account_info) === TRUE) {
            $this->_key_response = array(
                'code' => 10,
                'id' => null,
                'amount' => null,
                'message' => 'Thong tin doi tac khong hop le!'
            );
            return FALSE;
        }

        $real_ip = $this->getRealIpAddr();
        $list_ip = json_decode($account_info['ip'], TRUE);
        if (empty($list_ip[$real_ip]) === TRUE) {
            $this->_key_response = array(
                'code' => 13,
                'id' => null,
                'amount' => null,
                'message' => 'IP doi tac khong hop le! Vui long lien he voi chung toi de biet thong tin!'
            );
            return FALSE;
        }

        if (empty($token) === TRUE) {
            if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || strtolower($_SERVER['PHP_AUTH_USER']) != $params['account']) {
                AuthorizeHeader: {
                    header('WWW-Authenticate: Basic realm="Vui long nhap username=' . $params['account'] . ', password tuong ung voi ' . $params['account'] . '"');
                    header('HTTP/1.0 401 Unauthorized');
                    echo 'Qua trinh chung thuc duoc huy boi nguoi dung';
                    exit;
                }
            } else {
                if ($params['account'] != $_SERVER['PHP_AUTH_USER']) {
                    goto AuthorizeHeader;
                    die('Ban phai nhap username = ' . $params['account']);
                }
                $app_secret = $_SERVER['PHP_AUTH_PW'];
                if ($app_secret != $account_info['key']) {
                    goto AuthorizeHeader;
                    die('Qua trinh chung thuc that bai');
                }
            }
        }

        return $account_info['secret_key'];
    }

    private function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    protected function send_giftcode($action, $app) {
        $code = array(
            'teaser' => 'alawa',
            'phone' => 'helios',
            'game' => 'lolas',
            'like' => 'osmon',
            'setup' => 'ryan',
            'trailer' => 'wadjet',
            'invate' => 'yaksha',
            'hokage' => 'hokage',
            'sms' => 'gr',
            'lucky' => 'rakki',
            'examin' => 'examin',
            'congressmartial' => 'cmartial'
        );
        $this->CI->load->MeAPI_Model('MiniAppModel');        
        $gift_code = $this->CI->MiniAppModel->get_gift_code($code[$action], $app);        
        $statusupdate = $this->update_status_giftcode($gift_code['id'], $action);
        $gift_code['statusupdate'] = $statusupdate;
        return $gift_code;
    }

    protected function update_status_giftcode($id, $note = 'phone') {
        $this->CI->load->MeAPI_Model('MiniAppModel');
        $data = array(
            'status' => 'off',
            'release_date' => date("Y-m-d H:i:s"),
            'note' => $note,
        );
        $where = array('id' => $id, 'status' => 'on');
        return $this->CI->MiniAppModel->update_db('storage_gift_code', $data, $where);
    }

}
