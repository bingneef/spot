<?php

/*****************************
Pull spots since a certain time (either initial or new)
*****************************/

#start session
session_start();

#require required files
require '../../constants.php';
require '../../dbinfo.inc.php';
require '../../tools.php';
require '../../user.php';

#load tracks 
require '../../worker/user_load_tracks.php';

#set data from post
$last_update = $_SESSION['viewer_map_last_update'];
$_SESSION['viewer_map_last_update'] = date("Y-m-d H:i:s");

if(is_null($last_update))
	$last_update = 0;

#for each track, find updated spots since $last_update and update JSON
$updated_markers = array();
foreach($TrackObjects as $TrackObject){
	$track_updated_ids = $TrackObject->getUpdatedSpots($last_update);

	foreach($track_updated_ids as $updated_id){
		$UpdatedSpotObject = new SpotClass($updated_id);
		$UserObject = new UserClass($UpdatedSpotObject->getUserId());
		$updated_markers[] = $UpdatedSpotObject->getGoogleMapsFormatJson($UserObject->getNickname());
	}
}

#return value
print json_encode($updated_markers);

?>