<?php

/*****************************
Check login values
*****************************/

#start session
session_start();

#require required files
require '../constants.php';
require '../dbinfo.inc.php';
require '../tools.php';
require '../user.php';

#get posted username & password
$post_username = strtolower(trim($_POST['username']));
$post_password = trim($_POST['password']);

#crypt password
$post_password_salt = crypt($post_password,$salt);

#create user and validateLogin
$UserMasterObject = new UserClass();
$json_out['login'] = $UserMasterObject->validateLoginJson($post_username,$post_password_salt);

#if all json_out == NULL -> succes!
if(!array_filter($json_out)){
	$_SESSION['UserMasterObject'] = serialize($UserMasterObject);
	$json_out = array('succes'=>'Logged in.');
}

#output json
print json_encode($json_out);

?>