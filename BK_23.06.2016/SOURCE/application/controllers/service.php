<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once APPPATH . 'third_party/MeAPI/Autoloader.php';

class Service extends CI_Controller {

    public function index() {
		$this->benchmark->mark('api_start');
        parent::__construct();
        MeAPI_Autoloader::register();
        $api = new MeAPI_Server();
        $api->start();

        if (is_object($api->getResponse())) {
            $output = $api->getResponse()->getJson();
            if (empty($output) === TRUE) {
                $output = $api->getResponse()->getHTML();;
                $api->getResponse()->send('html');
            } else {
                $api->getResponse()->send();
            }
        } else {
            $response = new MeAPI_Response(array('Welcome to Service ( System Error ) !!!'));
            $output = $response->getJson();
            $response->send();
        }
        $query = '?' . http_build_query($api->request->input_request());
        $this->benchmark->mark('api_end');
        $time_execute = $this->benchmark->elapsed_time('api_start', 'api_end');
        MeAPI_Log::writeCsv(array($_SERVER['REMOTE_ADDR'],$time_execute, $query, $output), 'request_' . date('H'));
        exit;
    }

}
