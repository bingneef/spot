<?php
/*****************************
load all track for user
*****************************/

#get user track_id
$track_ids = $UserMasterObject->getUserTracks();

#initiate array and get all track objects
$TrackObjects = array();
foreach($track_ids as $track_id){
    $TrackObject = new TrackClass($track_id);
    $TrackObjects[] = $TrackObject;
}

?>