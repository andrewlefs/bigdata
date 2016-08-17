<?php

function log_server($name, $data){
    /* @var $ci CI_Controller */
    
        $ci = & get_instance();
        $ci->load->config("log_config");
        $log_ip = $ci->config->item("log_ip_test");
        $log_port = $ci->config->item("log_port_test");
        $ci->logstashlog->config(array('host' => $log_ip, 'port' => $log_port));
        $param = "[ ". $data ." ] [". $_SERVER['HTTP_REFERER'] ." ] [". $_SERVER['REQUEST_URI']." ]";
//        $ci->logstashlog->write($name, $param);
        
}

?>
