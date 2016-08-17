<?php
class MEAPI_Mq {
    public function push_rabbitmq($config, $data) {
        $CI = &get_instance();
        try {
            $CI->load->library('mqclass');
            //Get config params
            $routing = $config['routing'];
            $exchange = $config['exchange'];
            //log
            //MEAPI_Log::writeCsv(array('data'=>$data), 'mq_log');
            //Send action
            if(is_array($data)){
                foreach($data as $key=>$value){
                    $msg[$value['id']] = $CI->mqclass->send($routing, $exchange, json_encode($value));
                }
            }else{
                $msg = $CI->mqclass->send($routing, $exchange, json_encode($data));
            }
            $CI->mqclass->closeConnect();
            return $msg;
        } catch (Exception $e) {
            @$content_log = "{$e}";
            //MEAPI_Log::writeCsv(array('data'=>$content_log), 'mq_log_error');			
            return false;
        }
    }
    public function receive_rabbitmq($config,&$ret) {
        $CI = &get_instance();
        try {
            $CI->load->library('mqclass');
            //Get config params
            $routing = $config['routing'];
            $msg = $CI->mqclass->receive($routing,$ret);
            return $msg;
        } catch (Exception $e) {
            @$content_log = "{$e}";
            //MEAPI_Log::writeCsv(array('data'=>$content_log), 'mq_log_error');
            return false;
        }
    }
}

?>
