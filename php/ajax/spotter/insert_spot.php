<?php

/*****************************
Insert new spot
*****************************/

#start session
session_start();

#require required files
require '../../constants.php';
require '../../dbinfo.inc.php';
require '../../tools.php';
require '../../user.php';

#set data from post
$spot_track_id = $_POST['track_id'];
$spot_lat = $_POST['lat'];
$spot_lon = $_POST['lon'];
$spot_description = $_POST['description'];

#create class and fire newSpot
$SpotObject = new SpotClass();
$json_out['new_spot'] = $SpotObject->newSpot($UserMasterObject->getId(),$spot_track_id,$spot_lat,$spot_lon,$spot_description);

#if all json_out == NULL -> succes!
if(!array_filter($json_out)){
	$json_out = array('succes'=>'Spot added.');
}

#output json
print json_encode($json_out);
?>