<?php

/*****************************
Ajax call to insert track
*****************************/

#start session
session_start();

#require required files
require '../../constants.php';
require '../../dbinfo.inc.php';
require '../../tools.php';
require '../../user.php';

$track_name = $_POST['track_name'];
//$track_description = $_POST['track_description'];
$track_primary_color = $_POST['track_primary_color'];
$track_secondary_color = $_POST['track_secondary_color'];
$track_group_id = $UserMasterObject->getUserGroup();

$json_out = array();
$TrackObject = new TrackClass();
$json_out['track'] = $TrackObject->newTrack($track_name,$track_primary_color,$track_secondary_color);
$json_out['group_track'] = $TrackObject->insertGroupTrack($track_group_id);

#if no json yet (thus no error) -> succes!
if(!array_filter($json_out)){
	$json_out = array('succes'=>'Track added.');
}

#output json
print json_encode($json_out);
?>