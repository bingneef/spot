<?php

/*****************************
Ajax call to insert user
*****************************/

#start session
session_start();

#require required files
require '../../constants.php';
require '../../dbinfo.inc.php';
require '../../tools.php';
require '../../user.php';

#get post
$user_username = $_POST['user_username'];
$user_password = $_POST['user_password'];
$user_nickname = $_POST['user_nickname'];
$user_level = $_POST['user_level'];

#get crypted password
$user_password_crypt = crypt($user_password,$salt);

#get current group id
$group_id = $UserMasterObject->getUserGroup();

#create new user
$NewUserObject = new UserClass();
$json_out['new_user'] = $NewUserObject->newUser($user_username, $user_password_crypt, $user_nickname, $group_id, $user_level);

#if all json_out == NULL -> succes!
if(!array_filter($json_out)){
	$json_out = array('succes'=>'User added.','user_id'=>$NewUserObject->getId());
}

#output json
print json_encode($json_out);
?>