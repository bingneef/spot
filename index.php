<?php

error_reporting(E_ALL);

#start session
session_start();

#require required files
require 'php/constants.php';
require 'php/dbinfo.inc.php';
require 'php/tools.php';
require 'php/user.php';

$query = 'Select * from spot_hashtag_user';
$result = db_query($query);
var_dump($result);
?>
