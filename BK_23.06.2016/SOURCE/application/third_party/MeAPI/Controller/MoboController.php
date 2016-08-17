<?php
class MeAPI_Controller_MoboController extends MeAPI_Core_Bootstraps {
    /* @var $cache_user CI_Cache  */
    /* @var $cache CI_Cache  */

    protected $_response;
    protected $CI;
    protected $arraylist = array('115.78.161.88', '118.69.76.212', '14.161.5.226', '115.78.161.124');
	public $ret=array();
    public function __construct() {
        $this->CI = & get_instance();
    }

    public function game_guild_old(MeAPI_RequestInterface $request) {
        $authorize = new MeAPI_Controller_AuthorizeController();
        $params = $request->input_request();
        $info_params = array(
        );
        //if ($authorize->validateAuthorizeRequest($request, 'function') == TRUE) {
            if (is_required($params, $info_params) == TRUE) {
                $this->CI->load->MeAPI_Model('MoboModel');
                $this->get_message($this->ret);
                $listmember = $this->ret;
                if($listmember){
					echo '<table border="0">';
					echo '<tr>';
					echo '<th>STT</th>';
					echo '<th>GuildID</th>';
					echo '<th>GuildName</th>';
					echo '<th>Status</th>';
					echo '</tr>';
					$tei = 1;
					foreach($listmember as $key=>$value){
						$datasendmobo = json_decode($value,true);
						
						$result = $this->callback_mobo_events_gameguild($datasendmobo);
						if($result["code"] == 1){
							//update bang
							//$data_update_guild =array('date_sendmobo'=>date('Y-m-d H:i:s',time()));
							//$where_guild = array('id'=>$value['id']);
							//$this->CI->MoboModel->update_db('guild',$data_update_guild,$where_guild);
							//update listgamer
							$wherein = explode(",",$datasendmobo['group_member_ids']);
							$data_update = array('statussend'=>2);
							$this->CI->MoboModel->update_listmember($datasendmobo['game_guild_id'],$wherein,$data_update);
							echo '<tr>';
							echo '<td>'.$tei.'</td>';
							echo '<td>'.$datasendmobo['guild_id'].'</td>';
							echo '<td style="color:blue">'.$datasendmobo['guild_leader_name'].'</td>';
							echo '<td>OK</td>';
							echo '</tr>';
						}else{
							//update log bang
							$data_update_guild =array('logresult'=>json_encode($result));
							$where_guild = array('id'=>$datasendmobo['id']);
							$this->CI->MoboModel->update_db('guild',$data_update_guild,$where_guild);
							echo '<tr>';
							echo '<td>'.$tei.'</td>';
							echo '<td>'.$datasendmobo['guild_id'].'</td>';
							echo '<td>'.$datasendmobo['guild_leader_name'].'</td>';
							echo '<td style="color:red">Faild</td>';
							echo '</tr>';
						}
						$tei++;
					}
					echo '</table>';
				}
				die;
               // $this->_response = new MeAPI_Response_APIResponse($request, 'REQUEST_SUCCESS', $result);
                return TRUE;
            } else {
               // $this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_PARAMS', $result);
                return FALSE;
            }
        //}
		die;
        $this->_response = $authorize->getResponse();
        return FALSE;
    }

    public function game_guild_send_old(MeAPI_RequestInterface $request) {
        $authorize = new MeAPI_Controller_AuthorizeController();
        $params = $request->input_request();
        $info_params = array();
        //if ($authorize->validateAuthorizeRequest($request, 'function') == TRUE) {
        if (is_required($params, $info_params) == TRUE) {
            $this->CI->load->MeAPI_Model('MoboModel');
            $listguild = $this->CI->MoboModel->getlistguild();
			$listmember = array();
			if($listguild){
                foreach($listguild as $key=>$value){
                    $listmemberguild = $this->CI->MoboModel->getlistguildmember($value['game_guild_id']);
					if($listmemberguild){
                        $importlist = implode(",",array_map(function ($entry) {return $entry['mobo_id'];}, $listmemberguild));
                        $guildid = explode('_',$value['game_guild_id']);
                        $guildname = explode('_',$value['game_guild_name']);
						$alias = $guildname[0];
						unset($guildname[0],$guildname[1]);
						
                        $listmember[] =  array('id'=>$value['id'],'service_id'=>$value['game_id'],'game_guild_id'=>$value['game_guild_id'],'guild_id'=>$guildid[2],'guild_name'=>implode("_",$guildname),'guild_leader_name'=>$value['game_guild_leader_name'],'group_admin_id'=>$value['mobo_id'],'group_member_ids'=>$importlist,'alias'=>$alias,'server_id'=>$value['server_id']);
                    }
                    //update bang
                    $data_update_guild =array('date_sendmobo'=>date('Y-m-d H:i:s',time()));
                    $where_guild = array('id'=>$value['id']);
                    $this->CI->MoboModel->update_db('guild',$data_update_guild,$where_guild);
                }
                if($listmember){
                    $pushmess = $this->write_log($listmember);
					echo '<table border="0">';
					echo '<tr>';
					echo '<th>STT</th>';
					echo '<th>GuildID</th>';
					echo '<th>GuildName</th>';
					echo '<th>Status</th>';
					echo '</tr>';
					$tei = 1;
                    foreach($listmember as $key=>$value){
                        if(isset($pushmess[$value['id']]) && !empty($pushmess[$value['id']]) ){
                            //update listgamer
                            $wherein = explode(",",$value['group_member_ids']);
                            $data_update = array('statussend'=>1);
                            $this->CI->MoboModel->update_listmember($value['game_guild_id'],$wherein,$data_update);
                            echo '<tr>';
							echo '<td>'.$tei.'</td>';
							echo '<td>'.$value['guild_id'].'</td>';
							echo '<td style="color:blue">'.$value['guild_name'].'</td>';
							echo '<td>OK</td>';
							echo '</tr>';
                        }else{
							echo '<tr>';
							echo '<td>'.$tei.'</td>';
							echo '<td>'.$value['guild_id'].'</td>';
							echo '<td>'.$value['guild_name'].'</td>';
							echo '<td style="color:red">Faild</td>';
							echo '</tr>';
                        }
						$tei++;
                    }
					echo '</table>';
                }
                die;
            }else{
                //$this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_PARAMS', $result);
                return FALSE;
            }
            //$this->_response = new MeAPI_Response_APIResponse($request, 'REQUEST_SUCCESS', $result);
            return TRUE;
        } else {
            //$this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_PARAMS', $result);
            return FALSE;
        }

        //}
        $this->_response = $authorize->getResponse();
        return FALSE;
    }

	
	
	public function game_guild(MeAPI_RequestInterface $request){
		$authorize = new MeAPI_Controller_AuthorizeController();
        $params = $request->input_request();
        $info_params = array(
        );
        //if ($authorize->validateAuthorizeRequest($request, 'function') == TRUE) {
            if (is_required($params, $info_params) == TRUE) {
                $this->CI->load->MeAPI_Model('MoboModel');
                $this->get_message($this->ret);
                $listmember = $this->ret;
                if($listmember){
					echo '<table border="0">';
					echo '<tr>';
					echo '<th>STT</th>';
					echo '<th>GuildID</th>';
					echo '<th>GuildName</th>';
					echo '<th>Status</th>';
					echo '</tr>';
					$tei = 1;
					foreach($listmember as $key=>$value){
						$datasendmobo = json_decode($value,true);
						$result = $this->callback_mobo_events_gameguild($datasendmobo);
						if($result["code"] == 1){
							//update bang
							//$data_update_guild =array('date_sendmobo'=>date('Y-m-d H:i:s',time()));
							//$where_guild = array('id'=>$value['id']);
							//$this->CI->MoboModel->update_db('guild',$data_update_guild,$where_guild);
							//update listgamer
							$wherein = explode(",",$datasendmobo['listid']);
							$data_update = array('statussend'=>2);
							$this->CI->MoboModel->update_listmember_done($wherein,$data_update);
							echo '<tr>';
							echo '<td>'.$tei.'</td>';
							echo '<td>'.$datasendmobo['guild_id'].'</td>';
							echo '<td style="color:blue">'.$datasendmobo['guild_leader_name'].'</td>';
							echo '<td>OK</td>';
							echo '</tr>';
						}else{
							//update log bang
							$data_update_guild =array('logresult'=>json_encode($result));
							$where_guild = explode(",",$datasendmobo['listid']);
							$this->CI->MoboModel->update_db_done('guildall',$data_update_guild,$where_guild);
							echo '<tr>';
							echo '<td>'.$tei.'</td>';
							echo '<td>'.$datasendmobo['guild_id'].'</td>';
							echo '<td>'.$datasendmobo['guild_leader_name'].'</td>';
							echo '<td style="color:red">Faild</td>';
							echo '</tr>';
						}
						$tei++;
					}
					echo '</table>';
				}
				die;
               // $this->_response = new MeAPI_Response_APIResponse($request, 'REQUEST_SUCCESS', $result);
                return TRUE;
            } else {
               // $this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_PARAMS', $result);
                return FALSE;
            }
        //}
		die;
        $this->_response = $authorize->getResponse();
        return FALSE;
	}
	public function game_guild_send(MeAPI_RequestInterface $request){
		$authorize = new MeAPI_Controller_AuthorizeController();
        $params = $request->input_request();
        $info_params = array();
        //if ($authorize->validateAuthorizeRequest($request, 'function') == TRUE) {
        if (is_required($params, $info_params) == TRUE) {
            $this->CI->load->MeAPI_Model('MoboModel');
            $listguild = $this->CI->MoboModel->getlistall();
			$listmember = array();
			$listgroupguild = array();
			if($listguild){
				foreach($listguild as $key=>$value){
					$listgroupguild[$value['game_guild_id']][] = $value;
				}
				foreach($listgroupguild as $key=>$value){
					$group_admin_id = 0;
					$game_guild_id = 0;
					foreach($value as $ksub=>$vsub)
					{
						if(!empty($vsub['leader_name'])){
							$group_admin_id = $vsub['mobo_id'];
							$game_guild_id = $vsub['game_guild_id'];
							$game_guild_name = $vsub['game_guild_name'];
							$game_id = $vsub['game_id'];
							$guild_leader_name = $vsub['leader_name'];
							$server_id = $vsub['server_id'];
						}	
					}
					$importlist = implode(",",array_map(function ($entry) {return $entry['mobo_id'];}, $value));
                    $importlistid = implode(",",array_map(function ($entry) {return $entry['id'];}, $value));   
                    $guildid = explode('_',$game_guild_id);
                    $guildname = explode('_',$game_guild_name);
					$alias = strtoupper($guildname[0]);
					unset($guildname[0],$guildname[1]);
					$listmember[] =  array(
						'service_id'=>$game_id,
						'game_guild_id'=>$game_guild_id,
						'guild_id'=>$guildid[2],
						'guild_name'=>implode("_",$guildname),
						'guild_leader_name'=>$guild_leader_name,
						'group_admin_id'=>$group_admin_id,
						'group_member_ids'=>$importlist,
						'alias'=>$alias,
						'server_id'=>$server_id,
						'listid'=>$importlistid
					);
                    
                    //update bang
                    $data_update_guild =array('date_sendmobo'=>date('Y-m-d H:i:s',time()),'statussend'=>1);
                    $where_guild = explode(",",$importlistid);
                    $this->CI->MoboModel->update_listmember_done($where_guild,$data_update_guild);
                }
                if($listmember){
                    $pushmess = $this->write_log($listmember);
					echo '<table border="0">';
					echo '<tr>';
					echo '<th>STT</th>';
					echo '<th>GuildID</th>';
					echo '<th>GuildName</th>';
					echo '<th>Status</th>';
					echo '</tr>';
					$tei = 1;
                    foreach($listmember as $key=>$value){
                        if(isset($pushmess[$value['id']]) && !empty($pushmess[$value['id']]) ){
                            //update listgamer
                            echo '<tr>';
							echo '<td>'.$tei.'</td>';
							echo '<td>'.$value['guild_id'].'</td>';
							echo '<td style="color:blue">'.$value['guild_name'].'</td>';
							echo '<td>OK</td>';
							echo '</tr>';
                        }else{
							echo '<tr>';
							echo '<td>'.$tei.'</td>';
							echo '<td>'.$value['guild_id'].'</td>';
							echo '<td>'.$value['guild_name'].'</td>';
							echo '<td style="color:red">Faild</td>';
							echo '</tr>';
                        }
						$tei++;
                    }
					echo '</table>';
                }
                die;
            }else{
                //$this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_PARAMS', $result);
                return FALSE;
            }
            //$this->_response = new MeAPI_Response_APIResponse($request, 'REQUEST_SUCCESS', $result);
            return TRUE;
        } else {
            //$this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_PARAMS', $result);
            return FALSE;
        }

        //}
        $this->_response = $authorize->getResponse();
        return FALSE;
	}
    public function get_list_service_id(MeAPI_RequestInterface $request) {
        $authorize = new MeAPI_Controller_AuthorizeController();
        $params = $request->input_request();

        $info_params = array(
            'channel',
            'device_id',
            'platform',
            'user_agent',
            'telco',
            'otp',
        );

        if ($authorize->validateAuthorizeRequest($request, 'function') == TRUE) {
            if (is_required($params, $info_params) == TRUE) {
                $this->CI->load->MeAPI_Model('MiniAppModel');
                $this->CI->load->MeAPI_Library('SendDevicePush');
                $id = $this->CI->MiniAppModel->insert_device($params);
                if ($params['device_token'] != "") {
                    $params_push = array(
                        "deviceToken" => $params['device_token'],
                        "deviceModel" => $params['user_agent'],
                        "os" => $params['platform'],
                    );
                    $id = $this->CI->MiniAppModel->insert_device_token($params);
                    $this->CI->SendDevicePush->send_device($params_push);
                }
                $getchannel = explode("|", $params['channel']);
                $channel = ( isset($getchannel) && !empty($getchannel[0]) ) ? $getchannel[0] : "";
                if (false && $channel == 2) {
                    $result = $this->CI->MiniAppModel->getlistgameappbyid(11);
                } elseif (false && $channel == 1 && $params['platform'] == 'android') {
                    $result = $this->CI->MiniAppModel->getlistgameappbyid(11);
                } elseif (false && $params['platform'] == 'wp') {
                    $result = $this->CI->MiniAppModel->getlistgameappbyid(11);
                } else {
                    $result = $this->CI->MiniAppModel->getlistgameapp();
                    if (!in_array($_SERVER['REMOTE_ADDR'], $this->arraylist)) {
                        //unset  naruto :10
                        //unset giftcode 11
                        //unset mong giang ho 12
                        //unset 3T 3D 13
                        //unset 14 manh thu
						//unset 15 aow
                        $arrayforbiden = array("11", "15", "16", "17", "18", "19", "20");
                        $rsort = array();
                        foreach ($result as $key => $value) {
                            if (in_array($value['id_app'], $arrayforbiden)) {
                                unset($result[$key]);
                            } else {
                                $rsort[$key] = $value;
                            }
                        }
                        sort($result);
                        //$result = $rsort;
                    }
                }
                /*
                  //data with game has active
                  $result = $this->CI->MiniAppModel->getinfoactive();
                 */
                foreach ($result as $key => $value) {
                    $result[$key]['icon'] = base_url() . $value['icon'];
                }
                $this->_response = new MeAPI_Response_APIResponse($request, 'REQUEST_SUCCESS', $result);
                return TRUE;
            } else {
                $this->_response = new MeAPI_Response_APIResponse($request, 'INVALID_PARAMS', $result);
                return FALSE;
            }
        }
        $this->_response = $authorize->getResponse();
        return FALSE;
    }

}
