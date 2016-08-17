<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('datetime_to_seconds')) {
    function datetime_to_seconds($date) {
        $start = strtotime($date);
        $end = strtotime(date('Y-m-d H:i:s'));
        $diff = $end - $start;
        $i = ceil($diff / 60 * 60);
        return $i;
    }
}
?>
