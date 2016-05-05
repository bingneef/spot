<?php
/*****************************


*****************************/
$track_ids = $UserClass->getUserTracks();

$TrackObjects = array();

foreach($track_ids as $track_id){
    $TrackClass = new TrackClass($track_id);
    $TrackObjects[] = $TrackClass;
}

?>