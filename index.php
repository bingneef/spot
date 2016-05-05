<?php

error_reporting(E_ALL);

#start session
session_start();

#require required files
require 'php/constants.php';
require 'php/dbinfo.inc.php';
require 'php/tools.php';
require 'php/user.php';

#get posted username & password
$post_username = strtolower(trim($_POST['username']));
$post_password = trim($_POST['password']);

#crypt password
$post_password_salt = crypt($post_password,$salt);

#create user and validateLogin
$UserMasterObject = new UserClass();
var_dump($UserMasterObject);

?>
