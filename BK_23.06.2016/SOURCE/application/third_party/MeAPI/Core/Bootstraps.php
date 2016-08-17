<?php

class MeAPI_Core_Bootstraps extends CI_Controller {

    protected $CI;
    protected $_response;
    protected $key = '';
    protected $_key_response = 'INVALID_AUTHORIZE';
	
	public function __construct() {
		$this->CI = &get_instance();
		parent::__construct();
		if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1") {
            $this->_config["memcache"] = array("host" => "127.0.0.1", "port" => 11211);
        } else {
            $this->_config["memcache"] = array("host" => "10.10.20.121", "port" => 11211);
        }
		
    }
	public function write_log($message) {
        $this->CI->config->load('mq_setting');
        $mq_config = $this->CI->config->item('mq');
        $config['routing'] = $mq_config['mq_routing'];
        $config['exchange'] = $mq_config['mq_exchange'];
        $ddd = MeAPI_Mq::push_rabbitmq($config, $message);
        return $ddd;
    }
    public function get_message(&$ret) {
        $this->CI->config->load('mq_setting');
        $mq_config = $this->CI->config->item('mq');
        $config['routing'] = $mq_config['mq_routing'];
        $config['exchange'] = $mq_config['mq_exchange'];
		$ddd = MeAPI_Mq::receive_rabbitmq($config,$ret);
        return $ddd;
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

	protected function store_login($key, $cachetime = 3600) {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $memcache = new Memcache;
        $host = $this->_config["memcache"]["host"];
        $port = $this->_config["memcache"]["port"];
        $status = @$memcache->connect($host, $port);
        if ($status == true) {
            $mkey = md5('session_login' . $key);
            $memcache->set($mkey, session_id(), false, $cachetime);
            $memcache->close();
            return true;
        }
        return false;
    }

    private function unique_id($id) {
        $memcache = new Memcache;
        $host = $this->_config["memcache"]["host"];
        $port = $this->_config["memcache"]["port"];
        $status_memcache = @$memcache->connect($host, $port);
        if ($status_memcache == true) {
            $key = md5($id);
            $value = $memcache->get($key);
            if (empty($value)) {
                $memcache->set($key, $id, false, 3600);
                $memcache->close();
                return false;
            } else {
                return true;
            }
        } else {
            //kiem tra db 
            return false;
        }
    }

    protected function saveMemcache($key, $value, $cachetime = 3600) {
        $memcache = new Memcache;
        $host = $this->_config["memcache"]["host"];
        $port = $this->_config["memcache"]["port"];
        $status = $memcache->connect($host, $port);
        if ($status == true) {
            $mkey = md5($key);
            $memcache->set($mkey, $value, false, $cachetime);
            $memcache->close();
            return true;
        }
        return false;
    }

    protected function getMemcache($key) {
        $memcache = new Memcache;
        $host = $this->_config["memcache"]["host"];
		$port = $this->_config["memcache"]["port"];
		$status = $memcache->connect($host, $port);
		if ($status == true) {
            $mkey = md5($key);
            $value = $memcache->get($mkey);
            $memcache->close();
            return $value;
        }
        return null;
    }
	public function getResponse() {
        return $this->_response;
    }

	public function callback_mobo_events_gameguild($insert = array()){
		set_time_limit(30);
        $params["secret_key"] = "56251abxya8899";
        $params["command"] = "CREATE_GROUP";
        $params["service_id"] = $insert['service_id'];
		$params["guild_id"] = $insert['guild_id'];
		$params["guild_name"] = $insert['guild_name'];
		$params["guild_leader_name"] = $insert['guild_leader_name'];
		$params["group_admin_id"] = $insert['group_admin_id'];
        $params["group_member_ids"] = $insert['group_member_ids'];
		$params["alias"] = $insert['alias'];
        $params["server_id"] = $insert['server_id'];
		//$urlrequest = "http://115.78.161.134:8888/game_guild?";
		$urlrequest = "http://10.0.0.191/game_guild?";
		
		$result = $this->call_api($urlrequest,$params);
        if (!empty($result) && isset($result)) {
            $result = json_decode($result, true);                     
            /*if ($result["code"] == 1 && array_key_exists("code", $result))
                return $result;
            else*/
                return $result;
        }
        return false;
	}
	private function call_api($url,$params, $log_file_name = 'call_api') {
        $this->last_link_request = $url . http_build_query($params) . '&token=' . md5(implode('', $params) . $this->api_secret);
        $ch = curl_init();
       // echo $this->last_link_request ;die;
		
        curl_setopt($ch, CURLOPT_URL, $this->last_link_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $result = curl_exec($ch);
        if (!empty($log_file_name)) {
            //MeAPI_Log::writeCsv(array($this->last_link_request, $result), $log_file_name);
        }
        return $result;
    }
}
