<?php

/*****************************
Update user privileges
*****************************/

#start session
session_start();

#require required files
require '../../constants.php';
require '../../dbinfo.inc.php';
require '../../tools.php';
require '../../user.php';

$user_id = $_POST['user_id'];
$user_level = $_POST['user_level'];

$json_out = array();
$UserObject = new UserClass($user_id);
$UserObject->setLevel($user_level);
$json_out['update'] = $UserObject->updateUser();

#if no json yet (thus no error) -> succes!
if(is_null($json_out['update'])){
	$json_out = array('succes'=>'User privilege updated for ' . $UserObject->getUsername() . '.');
}

#output json
print json_encode($json_out);
?>