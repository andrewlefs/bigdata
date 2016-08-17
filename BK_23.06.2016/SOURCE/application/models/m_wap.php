<?php

/**
 * Description of admin
 *
 * @author duocnt
 */
class M_wap extends MeAPI_Model {

    var $_dbgroup = 'db';
    var $_table = 'user';
    protected $_total;

    public function __construct() {
        parent::__construct();
    }

    public function insert_db($table, $param) {
        $this->db_slave->insert($table, $param);
        $id = $this->db_slave->insert_id();
        return $id;
    }
    
    function get_id($table, $field, $id){
        $sql = $this->db_slave->select()
			      ->from($table)
                              ->where($field,$id)
			      ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }   
    
    public function get_info_event_device($device, $app){
        $sql = $this->db_slave->select("g.*")
                       ->from("device d")
                       ->join("gifts_code g", "d.id_device = g.id_device")
                       ->where("device_id", $device)
					   ->where("g.app", $app)
                       ->where("d.app", $app)
                       ->get()
                ;
        return $sql->result_array();
    }
    public function get_gift_code($event, $app){
        $sql = $this->db_slave->select("s.code, s.id")
                ->from("app a")
                ->join('storage_gift_code s', 'a.id_app = s.id_app')
                ->where("s.event", $event)
                ->where("s.status", 'on')
                ->where("alias_app", $app)
                ->limit(1)
                ->get()
        ;
        return $sql->row_array();
    }
	public function listapibygame($alias_app){
        $data =$this->db_slave->where("alias_app",$alias_app)->order_by('order','asc')->get('tbl_m_app');
        if (is_object($data)){
            return $data->result_array();
        }else{
            return false;
        }
    }
}