<?php
class MoboModel extends CI_Model {

    private $_db_master;
    private $_db_slave;

    public function __construct() {
        $this->_db_master = $this->load->database(array('db' => 'dbmobo', 'type' => 'master'), TRUE);
        $this->_db_slave = $this->load->database(array('db' => 'dbmobo', 'type' => 'slave'), TRUE);
    }

    public function insert_db($table, $data) {
        $this->_db_master->insert($table, $data);
        return $this->_db_master->insert_id();
    }
	
	public function getlistguild(){
		$sql = $this->_db_slave->select("*")
                ->from("guild")
                ->where("date(`date_sendmobo`) IS NULL")
				->or_where("date(`date_sendmobo`) !=",date('Y-m-d',time()))
                ->order_by('id', "ASC")
				->limit(1000)
                ->get();
        return $sql->result_array();
	}
    public function getlistguildmember($idguild) {
        $sql = $this->_db_slave->select("mobo_id")
                ->from("guild_member")
				->where('game_guild_id',$idguild)
                ->where("statussend", 0)
                ->order_by('id', "ASC")
                ->get();
        return $sql->result_array();
    }
	
	
	public function getlistall(){
		$sql = $this->_db_slave->select("*")
                ->from("guildall")
                ->where("date(`date_sendmobo`) IS NULL")
				/*->or_where("date(`date_sendmobo`) !=",date('Y-m-d',time()))*/
                ->order_by('game_id',"ASC")
				->order_by('server_id',"ASC")
				->order_by('game_guild_id',"ASC")
				->limit(3000)
                ->get();
        return $sql->result_array();
	}
	public function update_listmember($game_guild_id,$where,$data) {
        $this->_db_master->where('game_guild_id',$game_guild_id)
						 ->where_in("mobo_id",$where)
						 ->update('guild_member',$data);
		//echo $this->_db_master->last_query();
        return $this->_db_master->affected_rows();
    }
	public function update_listmember_done($where,$data) {
        $this->_db_master->where_in("id",$where)
						 ->update('guildall',$data);
		//echo $this->_db_master->last_query();
        return $this->_db_master->affected_rows();
    }
	public function update_db_done($table, $data, $where) {
		$this->_db_master->where_in("id",$where)
						 ->update($table,$data);
        return $this->_db_master->affected_rows();
    }
    public function update_db($table, $data, $where) {
        $this->_db_master->update($table, $data, $where); //echo $this->_db_master->last_query();
        return $this->_db_master->affected_rows();
    }

    function get_table_where($table, $where) {
        $sql = $this->_db_slave->get_where($table, $where); //exit($this->_db_slave->last_query());
        return $sql->row_array();
    }

}

?>
