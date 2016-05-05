<?php
/**************************************************

 _____     _            _          _____ _
|   __|___|_|___ ___   | |_ _ _   | __  |_|___ ___
|__   | . | |   | . |  | . | | |  | __ -| |   | . |
|_____|  _|_|_|_|_  |  |___|_  |  |_____|_|_|_|_  |
      |_|       |___|      |___|              |___|

****************************************************/

#start output buffer and session
ob_start();
session_start();

#show all errors
error_reporting(E_ALL);

#require tools
require 'php/constants.php';

#load super variables
require 'php/dbinfo.inc.php';

#require tools
require 'php/tools.php';

#destroy session
if(isset($_GET['destroy'])){
  session_destroy();
  header('Location: ' . ROOT);
  exit;
}

#handle user
require 'php/user.php';

#quick add user for dev
//require 'php/develop/dev_new_user.php';


?>

<!DOCTYPE html>
<html lang="en" class="brown lighten-4">

<!-- Start Document
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

<?php
/***********************************
* insert header
***********************************/
require 'php/parts/header.php';

?>

<body>

<?php
/***********************************
* insert navigation
***********************************/
require 'php/parts/navigation.php';

?>


<?php
/***********************************
* insert loader
***********************************/
require 'php/parts/loader.php';

?>


<?php
/***********************************
* controller for showing pages
***********************************/

#does UserObject exists and is it logged in
#level 0 is spotter, level 1 is viewer, level 2 is admin

if(!isset($UserMasterObject) || !$UserMasterObject->loggedIn()){
  require 'php/views/login.php';
} else {
  if($UserMasterObject->getLevel() == 0 || isset($_GET['agent'])){
    require 'php/views/spotter/spot.php';
  } else {

    #map-page is default
    $page = 'map';
    if(isset($_GET['page'])){
      $page = $_GET['page'];
    }

    if($UserMasterObject->getLevel() == 1){
      #load views
      switch($page){
        case 'spot':
          require 'php/views/spotter/spot.php';
          break;

        case 'map'; default:
          require 'php/views/viewer/map.php';
      }
    } else {
      #load views
      switch($page){
        case 'spot':
          require 'php/views/spotter/spot.php';
          break;
        case 'control_panel':
          require 'php/views/admin/control_panel.php';
          break;

        case 'map'; default:
          require 'php/views/viewer/map.php';
      }
    }


  }

}

?>

<!-- Panel for Updating User Info
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="status-bar-outer"><div id="status-bar" class="z-depth-3 hoverable"></div></div>

<!-- End Document
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>

<?php

#print output buffer
ob_flush();

?>
