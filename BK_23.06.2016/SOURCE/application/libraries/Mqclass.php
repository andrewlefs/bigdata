<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once __DIR__ . '/amqplib/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class MqClass{
    public $connection;
    public $channel;
    function __construct(){
        $CI =& get_instance();
        $CI->load->config('mq_setting');
        $mq_cfg = $CI->config->item('mq');
		//echo '<pre>';
		//print_r($mq_cfg);die;
        //To init a connnection;
        if(!$this->connection){
            $this->connection = new AMQPConnection($mq_cfg['server'], $mq_cfg['port'], $mq_cfg['user'], $mq_cfg['password']);
            $this->channel = $this->connection->channel();
			//var_dump($this->channel);die;
        }
    }

    //To send a message
    //Return 1: successful, 0: error
    public function send($routing_key, $exchange, $message){
        if($routing_key != null or $message != null){
            $this->channel->queue_declare($routing_key, false, true, false, false); #disable
            //$this->channel->exchange_declare($exchange, false, false, false, false);
            //$this->channel->queue_bind($queue, $exchange, $routing_key); #disable

            //$mq_msg = new AMQPMessage($message);
            $mq_msg = new AMQPMessage($message,array('delivery_mode' => 2));
            $this->channel->basic_publish($mq_msg, $exchange, $routing_key);
            return 1;
        } else{
            return 0;
        }
    }
    public function closeConnect(){
        $this->channel->close();
        $this->connection->close();
    }

    //To receive a message or null;
    public function receive($routing_key,&$ret){
        if($routing_key != null){
			$mq_msg = new AMQPMessage();
			$this->channel->queue_declare($routing_key, false, true, false, false);
            $timeout = 3;
            $callback = function($msg) use (&$ret) {
                $ret[] = $msg->body;
                sleep(substr_count($msg->body, '.'));
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
                if ($msg->body == 'stop'|| $msg->body == 'quit'){
                    $this->channel->basic_cancel($this->routing_key);
                }
            };
            $this->channel->basic_qos(null, 1,null);
            $this->channel->basic_consume($routing_key, '', false, false, false, false, $callback);
            //$result = ($this->channel->basic_get($routing_key, true, null)->body);
            while(count($this->channel->callbacks)) {
               $this->channel->wait(null, false, $timeout);
            }
            $this->channel->close();
            $this->connection->close();
            return $ret;
        } else{
            return null;
        }
    }
}