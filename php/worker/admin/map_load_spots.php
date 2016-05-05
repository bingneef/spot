<?php

/*****************************
Get spots in track for control panel.php
*****************************/

#get spots
$spot_ids = $TrackClass->getSpotsIds();

#iterate and create SpotObjects from ids
$SpotObjects = array();
foreach($spot_ids as $spot_id){
    $SpotObject = new SpotClass($spot_id);
    $SpotObjects[] = $SpotObject;
}

?>