<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$db['dbmobo'] = array(
    'cfg' => array('master' => 1, 'master_random' => false, 'slave_random' => false),
    'db' => array(
        gen_cfg_db('localhost', 'root', '', 'datawhitehouse'),
		gen_cfg_db('localhost', 'root', '', 'datawhitehouse')
		
    )
);




/* End of file database.php */
/* Location: ./application/config/database.php */