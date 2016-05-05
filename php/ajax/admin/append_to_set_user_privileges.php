<?php

/*****************************
Ajax call to append new user to set user privilege
*****************************/

#start session
session_start();

#require required files
require '../../constants.php';
require '../../dbinfo.inc.php';
require '../../tools.php';
require '../../user.php';

$user_id = $_POST['user_id'];

$UserObjects = array(new UserClass($user_id));

$json_out = array();

ob_start();
require '../../views/admin/templates/control_panel_set_user_privileges.php';
$str_set_user_privileges = ob_get_contents();
ob_clean();

#if no json yet (thus no error) -> succes!
if(!array_filter($json_out)){
	$json_out = array('succes'=>'true','content'=>$str_set_user_privileges);
}

#output json
print json_encode($json_out);
?>