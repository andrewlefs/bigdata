<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$db['system_info'] = array(
    'cfg' => array('master' => 1, 'master_random' => false, 'slave_random' => false),
    'db' => array(
        gen_cfg_db('10.10.20.13', 'mapreduce', '0XfAWJwiwb', 'datawarehouse'),
    	gen_cfg_db('10.10.20.13', 'mapreduce', '0XfAWJwiwb', 'datawarehouse')
    )
);

$db['dbmobo'] = array(
    'cfg' => array('master' => 1, 'master_random' => false, 'slave_random' => false),
    'db' => array(
        gen_cfg_db('10.10.20.13', 'mapreduce', '0XfAWJwiwb', 'datawarehouse'),
		gen_cfg_db('10.10.20.13', 'mapreduce', '0XfAWJwiwb', 'datawarehouse')
    )
);


/* End of file database.php */
/* Location: ./application/config/database.php */