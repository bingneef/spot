<?php

/*****************************
TrackClass.php
*****************************/

class TrackClass {
    protected $track_id;
    protected $track_name;
    protected $track_icon;
    protected $track_primary_color;
    protected $track_secondary_color;
    protected $track_date_insert;
    protected $track_last_update;
    protected $limit_spots = 1;

    private $prefix = 'spot_hashtag_';

    /*****************************
    * construct class
    *****************************/
    public function __construct($track_id = 0) {
    	$this->track_id = $track_id;

        if($this->track_id != 0){
            $this->loadTrack();
        }

    }

    /*****************************
    * print values of class
    *****************************/
    public function printClass() {
        print $this->track_id . '::' . $this->track_name . '::' . $this->track_icon . '::' . $this->track_primary_color . '::' . $this->track_secondary_color . '::' . $this->track_date_insert . '::' . $this->track_last_update;
    }

    /*****************************
    * load spot from $this->track_id
    *****************************/
    private function loadTrack(){
    	$query = 'SELECT * FROM ' . $this->prefix . 'track WHERE track_id = ' . $this->track_id;
    	$result = db_query($query);

    	while($row = mysqli_fetch_array($result)){
            $this->track_name = $row['track_name'];
    		$this->track_primary_color = $row['track_primary_color'];
            $this->track_secondary_color = $row['track_secondary_color'];
    		$this->track_date_insert = $row['track_date_insert'];
    		$this->track_last_update = $row['track_last_update'];
    	}
    }

    /*****************************
    * handle values for new track and call insert
     *****************************/
    public function newTrack($track_name,$track_primary_color,$track_secondary_color){
        $this->track_name = $track_name;
        $this->track_primary_color = $track_primary_color;
        $this->track_secondary_color = $track_secondary_color;
        $this->track_date_insert = date('Y-m-d H:i:s');
        return $this->insertTrack();
    }

    /*****************************
    * insert this track into database
     *****************************/
    private function insertTrack(){

        $query = "INSERT INTO " . $this->prefix . "track (`track_name`, `track_primary_color`, `track_secondary_color`, `track_date_insert`) values ('" . $this->track_name . "','" . $this->track_primary_color . "','" . $this->track_secondary_color . "','" . $this->track_date_insert . "')";
        $this->track_id = db_query_return_id($query);

        #return error
        return;
    }

    /*****************************
    * update track
    *****************************/
    public function updateTrack(){
        $query = "UPDATE " . $this->prefix . "track SET `track_name` = '" . $this->track_name . "', `track_primary_color` = '" . $this->track_primary_color . "', `track_secondary_color` = '" . $this->track_secondary_color . "' WHERE `track_id` = '" . $this->track_id . "'";
        $result = db_query($query);
        return;
    }

    /*****************************
    * delete track
    *****************************/
    public function deleteTrack(){
        $query = "DELETE " . $this->prefix . "track WHERE `track_id` = '" . $this->track_id . "'";
        $result = db_query($query);
        return;
    }

    /*****************************
    * insert this spot into database
     *****************************/
    public function insertGroupTrack($group_id){

        $query = "INSERT INTO " . $this->prefix . "group_track (`group_id`, `track_id`) values ('" . $group_id . "','" . $this->track_id . "')";
        $this->track_id = db_query_return_id($query);

        #return error
        return;
    }

    /*****************************
    * get updated spots since external $last_update
    *****************************/
    public function getUpdatedSpots($last_update){
        $query = "SELECT spot_id FROM " . $this->prefix . "spot WHERE spot_track_id=" . $this->track_id . " AND spot_last_update > '" . $last_update . "' ORDER BY spot_last_update DESC LIMIT 1";
        $result = db_query($query);

        $spot_ids = array();
        while($row = mysqli_fetch_array($result)){
            $spot_ids[] = $row['spot_id'];
        }

        return $spot_ids;
    }

    /*****************************
    * get all spot_ids from this track
    *****************************/
    public function getSpotsIds() {
        $query = "SELECT " . $this->prefix . "id FROM ' . $this->prefix . 'spot WHERE spot_track_id=" . $this->track_id . " ORDER BY spot_last_update DESC LIMIT " . $this->limit_spots;

        $result = db_query($query);

        $spot_ids = array();
        while($row = mysqli_fetch_array($result)){
            $spot_ids[] = $row['spot_id'];
        }

        return $spot_ids;
    }

    /*****************************
    * general getters
    *****************************/

    public function getName(){
        return $this->track_name;
    }

    public function getIcon(){
        $this->setIcon();
        return $this->track_icon;
    }

    public function getId(){
        return $this->track_id;
    }

    public function getPrimaryColor(){
        return $this->track_primary_color;
    }

    public function getSecondaryColor(){
        return $this->track_secondary_color;
    }

    /*****************************
    * general setters
    *****************************/

    public function setIcon(){
        $this->track_icon = $this->track_primary_color . '_' . $this->track_secondary_color . '.svg';
    }
}

?>
