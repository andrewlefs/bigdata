<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'third_party/MeAPI/Core/Bootstraps.php';
//
class Wap extends MeAPI_Core_Bootstraps {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }
    private $api_ginside = "http://local.ginside.mobo.vn/?control=miniapp&func=listapibygame";
    private function curlGet($params){
        $this->last_link_request = $this->api_ginside."&alias_app=".$params;
        $ch = curl_init();
        //echo $this->last_link_request ;die;
        curl_setopt($ch, CURLOPT_URL, $this->last_link_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $result = curl_exec($ch);
        if($result){
            $result = json_decode($result,true);
        }
        return $result;
    }
    public function content($param) {
		
        if($_POST){
			$post = $this->input->post("phone", TRUE);
		}
        $device = $this->input->get("device_id", TRUE);
        $platform = $this->input->get("platform", TRUE);
        $app = $this->input->get("app", TRUE);
        $this->load->helper("phone");
	
        if (!empty($post) and !empty($device) and is_numeric($post)) {
            $this->load->model("m_wap");
            $id_device = $this->m_wap->get_id("device", "device_id", $device);
            if (!empty($id_device)) {
                foreach ($id_device as  $value) {
                    if($value['app'] == $app ){
                        $data = array(
                            "id_device" => $value['id_device'],
                            "number" => format_phone($post),
                        );
                        break;
                    }
                }
                $phone_id = $this->m_wap->insert_db("phone", $data);
                //if (!empty($phone_id)) {
                    $gift_code = $this->send_giftcode('phone', $app);
                    if (!empty($gift_code)) {
                        $data = array(
                            'id_device' =>  $data['id_device'],
                            'app' => $app,
                            'event' => "phone",
                            'code_event' => "phone",
                            'gift_code' => $gift_code['code'],
                        );
                        $id = $this->m_wap->insert_db("gifts_code", $data);
                    }
                    if (!empty($id)) {
                        if (!empty($gift_code)) {
                            $this->m_wap->_table = 'storage_gift_code';
                            $this->m_wap->_key = 'id';
                            $data = array(
                                'status' => 'off',
                                'release_date' => date("Y-m-d H:i:s"),
                                'note' => 'phone',
                            );
                            $this->m_wap->update($gift_code['id'], $data);
                        }
                    }
                //}
            }
        }
        $param = $this->check_security($param);
        if ($param !== FALSE) {
            switch ($param) {
				case "eventbth":
                    $this->eventallgame($device, $app, $platform,'bth');
                    break;
				case "eventmt":
                    $this->eventallgame($device, $app, $platform,'mt');
                    break;
				case "eventnaruto":
                    $this->eventallgame($device, $app, $platform,'naruto');
                    break;
				case "eventgc":
                    $this->eventallgame($device, $app, $platform,'gc');
                    break;
				case "eventmgh":
                    $this->eventallgame($device, $app, $platform,'mgh');
                    break;
				case "eventeden":
                    $this->eventallgame($device, $app, $platform,'eden');
                    break;
				case "eventaow":
                    $this->events($device, $app, $platform,'aow');
                    break;
                case "events":
                    $this->events($device, $app, $platform);
                    break;
                case "event":
                    $this->event($device, $app, $platform);
                    break;
                case "about":
                    $this->about($device, $app);
                    break;
                case "gift_code":
                    $this->gift_code($device, $app);
                    break;

                default:
                    echo "Trang " . $param;
                    break;
            }
        }
    }
	public function events($device, $app, $platform,$viewapp='bth') {
        $this->load->model("m_wap");
		
		$key = "cache_list_miniapp" . $app;
        $getlistevent = $this->getMemcache($key);
		
		if($getlistevent == false){
			$getinfoapp = $this->m_wap->listapibygame($app);
			if($getinfoapp){
				$getlistevent = $getinfoapp;
				$this->saveMemcache($key, $getinfoapp, 24* 10900);
			}
			
        }
		
        $data['listappitem'] = $getlistevent;

        $datalist = $this->get_info_event_device($device, $app);
        $dataparse = array();
		foreach ($datalist as $key => $value) {
            //$data[$value['event']] = $value['code_event'];
            //$data[$value['code_event']] = $value['gift_code'];
            $dataparse[$value['code_event']] = $value;
        }
        $data['parselist']=$dataparse;
        $data['app'] =$app ;
        
        $db  = $this->m_wap->get_id('app', 'alias_app', $app);

        if($platform == 'android')
            $data['link_download'] = $db[0]['dl_android'];
        if($platform == 'ios')
            $data['link_download'] = $db[0]['dl_ios'];
        if($platform == 'wp')
            $data['link_download'] = $db[0]['dl_wp'];

        $this->load->view("view_events", $data,true);
    }
    public function event($device, $app, $platform) {
        $data = $this->get_info_event_device($device, $app);
		if (in_array($_SERVER['REMOTE_ADDR'], array('14.161.5.226', '118.69.76.212'))) {
		}
        foreach ($data as $key => $value) {
            $data[$value['event']] = $value['code_event'];
            $data[$value['code_event']] = $value['gift_code'];
            $data[$value['event']] = $value;
        }
        $this->load->model("m_wap");
        $db  = $this->m_wap->get_id('app', 'alias_app', $app);
        if($platform == 'android')
            $data['link_download'] = $db[0]['dl_android'];
        if($platform == 'ios')			
            $data['link_download'] = $db[0]['dl_ios'];
		if($platform == 'wp')
            $data['link_download'] = $db[0]['dl_wp'];
       
        $this->load->view("view_event", $data);
    }
	public function eventallgame($device, $app, $platform,$viewapp='bth') {
        $getinfoapp = $this->curlGet($app);


        if($getinfoapp['code'] != 0 || $getinfoapp == FALSE){
            echo 'Không hỗ trợ APP';
            die;
        }
        $data['listappitem'] = $getinfoapp['data'];

        $datalist = $this->get_info_event_device($device, $app);
        $dataparse = array();
        foreach ($datalist as $key => $value) {
            //$data[$value['event']] = $value['code_event'];
            //$data[$value['code_event']] = $value['gift_code'];
            $dataparse[$value['code_event']] = $value;
        }
        $data['parselist']=$dataparse;
        $data['app'] =$app ;
        $this->load->model("m_wap");
        $db  = $this->m_wap->get_id('app', 'alias_app', $app);

        if($platform == 'android')
            $data['link_download'] = $db[0]['dl_android'];
        if($platform == 'ios')
            $data['link_download'] = $db[0]['dl_ios'];
        if($platform == 'wp')
            $data['link_download'] = $db[0]['dl_wp'];

        $this->load->view("view_event".$viewapp, $data,true);
    }
	public function homeallgame($viewapp='gc') {
        $this->load->view("home/home_".$viewapp,true);
    }
	public function thuvienallgame($viewapp='gc') {
        $this->load->view("thuvien/thuvien_".$viewapp,true);
    }
	public function sukienallgame($viewapp='gc') {
        $this->load->view("sukien/sukien_".$viewapp,true);
    }

    public function about($device, $app) {
        $data = $this->get_info_event_device($device, $app);

        foreach ($data as $key => $value) {
            if (!empty($value['phone'])) {
                $data['phone'] = $value['phone'];
            }
        }

        $this->load->view("view_about", $data);
    }

    public function gift_code($device, $app) {
        $data = $this->get_info_event_device($device, $app);
        foreach ($data as $key => $value) {
            $data[$value['event']] = $value['code_event'];
            $data[$value['code_event']] = $value['event'];
            $data[$value['event']] = $value;
        }

        $this->load->view("view_gift_code", $data);
    }

    public function get_info_event_device($device, $app) {
        $this->load->model("m_wap");
        $detail = $this->m_wap->get_info_event_device($device, $app);
        foreach ($detail as $key => $value) {
            $detail[$key][$value['event']] = $value['code_event'];
        }
        return $detail;
    }

    public function check_security($param) {
        if (empty($param))
            return FALSE;
        $param = $this->security->xss_clean($param);
        return $param;
    }

public function test() {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $a = array(
            //'alawa',
//            'helios',
            //'lolas',
            //'osmon',
            //'ryan',
            //'wadjet',
            'yaksha',
        );
        $this->load->model("m_wap");
        foreach ($a as $value) {
            $array_gift = array();
            $fileAppUrl = './gift_code/' . $value . '.txt';
            $handle = fopen($fileAppUrl, 'r') or exit("khong tim thay file can mo");
            if ($handle) {
                while (!feof($handle)) {
                    $phone = fgets($handle);
                    if ($phone != '') {
                        $data = array(
                            'id_app' => 1,
                            'code' => trim($phone),
                            'event' => $value,
                        );
                        echo  $this->m_wap->insert_db("storage_gift_code", $data);
                        echo "</br>";
                    }
                }
            }
            fclose($handle); 
            
          
        }
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
        );
        $this->load->model("m_wap");
        $gift_code = $this->m_wap->get_gift_code($code[$action], $app);
        return $gift_code;
    }

}
