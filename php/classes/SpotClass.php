<?php

/*****************************
SpotClass.php
*****************************/

class SpotClass {
    protected $spot_id;
    protected $spot_user_id;
    protected $spot_track_id;
    protected $spot_lat;
    protected $spot_lon;
    protected $spot_description;
    protected $spot_date_insert;
    protected $spot_last_update;

    private $prefix = 'spot_hashtag_';

    /*****************************
    * construct class
    *****************************/
    public function __construct($spot_id = 0) {
        $this->spot_id = $spot_id;
        if($this->spot_id > 0){
        	return $this->loadSpot();
        } else {
            return false;
        }
    }

    /*****************************
    * print values of class
     *****************************/
    public function printClass() {
        print $this->spot_id . '::' . $this->spot_user_id . '::' . $this->spot_track_id . '::' . $this->spot_lat . '::' . $this->spot_lon . '::' . $this->spot_description . '::' . $this->spot_date_insert . '::' . $this->spot_last_update;
    }

    /******************************
    * load spot from $this->spot_id
    *******************************/
    private function loadSpot(){
    	$query = 'SELECT * FROM ' . $this->prefix . 'spot WHERE spot_id = ' . $this->spot_id . ' LIMIT 1';
    	$result = db_query($query);

        $spot_found = false;
    	while($row = mysqli_fetch_array($result)){
            $spot_found = true;
    		$this->spot_user_id = $row['spot_user_id'];
    		$this->spot_track_id = $row['spot_track_id'];
    		$this->spot_lat = $row['spot_lat'];
    		$this->spot_lon = $row['spot_lon'];
            $this->spot_description = $row['spot_description'];
            $this->spot_date_insert = $row['spot_date_insert'];
            $this->spot_last_update = $row['spot_last_update'];
    	}

        return $spot_found;
    }

    /*****************************
    * handle values for new spot and call insert
     *****************************/
    public function newSpot($spot_user_id,$spot_track_id,$spot_lat,$spot_lon,$spot_description){
        $this->spot_user_id = $spot_user_id;
        $this->spot_track_id = $spot_track_id;
        $this->spot_lat = $spot_lat;
        $this->spot_lon = $spot_lon;
        $this->spot_description = $spot_description;
        $this->spot_date_insert = date('Y-m-d H:i:s');

        return $this->insertSpot();
    }

    /*****************************
    * insert this spot into database
     *****************************/
    private function insertSpot(){
        $query = "INSERT INTO " . $this->prefix . "spot (`spot_user_id`, `spot_track_id`, `spot_lat`, `spot_lon`, `spot_description`, `spot_date_insert`) values ('" . $this->spot_user_id . "','" . $this->spot_track_id . "','" . $this->spot_lat . "','" . $this->spot_lon . "','" . $this->spot_description . "','" . $this->spot_date_insert . "')";
        $this->spot_id = db_query_return_id($query);

        return;
    }

    /*****************************
    * update user
    *****************************/
    public function updateUser(){
        $query = "UPDATE " . $this->prefix . "spot SET `spot_user_id` = '" . $this->spot_user_id . "', `spot_track_id` = '" . $this->spot_track_id . "', `spot_lat` = '" . $this->spot_lat . "', `spot_lon` = '" . $this->spot_lon . "', `spot_description` = '" . $this->spot_description . "' WHERE `spot_id` = '" . $this->spot_id . "'";
        $result = db_query($query);
        return;
    }

    /*****************************
    * delete user
    *****************************/
    public function deleteUser(){
        $query = "DELETE " . $this->prefix . "spot WHERE `spot_id` = '" . $this->spot_id . "'";
        $result = db_query($query);
        return;
    }

    /*****************************
    * create json containing data for Google Maps marker
    *****************************/
    public function getGoogleMapsFormatJson($user_nickname){
        $query = 'SELECT track_name, track_primary_color, track_secondary_color FROM ' . $this->prefix . 'track WHERE track_id = ' . $this->spot_track_id . ' LIMIT 1';
        $result = db_query($query);

        $icon = '';
        $track_name = '';
        while($row = mysqli_fetch_array($result)){
            $track_name = $row['track_name'];
            $icon = $row['track_primary_color'] . '_' . $row['track_secondary_color'] . '.svg';
        }

        //infowindow content TODO GET USERNAME
        $content = '<h4>' . $user_nickname . '</h4><p><b>' . date("D j M \@ g:iA", strtotime($this->spot_date_insert)) . '</b><p>' . $track_name . ': ' . $this->spot_description . '</p>';

        $json = array('id'=>$this->spot_id, 'content'=>$content,'lat'=>$this->spot_lat,'lon'=>$this->spot_lon,'icon'=>$icon,'track_id'=>$this->spot_track_id,'title'=> $track_name . ' (' . $user_nickname . ') -> ' . $this->spot_description);
        return $json;
    }

    /*****************************
    * general getters
    *****************************/
    public function getUserId(){
        return $this->spot_user_id;
    }

    /*****************************
    * general setters
    *****************************/
}

?>
