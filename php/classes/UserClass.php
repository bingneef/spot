<?php

/*****************************
UserClass.php
*****************************/

class UserClass {
    protected $user_id;
    protected $user_username;
    protected $user_password;
    protected $user_nickname;
    protected $user_spots;
    protected $user_group;
    protected $user_level;

    private $prefix = 'spot_hashtag_';

    /*****************************
    * construct class
    *****************************/
    public function __construct($user_id = 0) {
        $this->user_id = $user_id;

        if($this->user_id > 0){
        	return $this->loadUser();
        } else {
            return false;
        }
    }

    /*****************************
    * print values of class
    *****************************/
    public function printClass() {
        print $this->user_id . '::' . $this->user_username . '::' . $this->user_password . '::' . $this->user_nickname . '::' . $this->user_nickname . '::' . $this->user_group . '::' . $this->user_level;
    }

    /*****************************
    * load spot from $this->user_id
    *****************************/
    private function loadUser(){
    	$query = 'SELECT * FROM ' . $this->prefix . 'user WHERE user_id = ' . $this->user_id . ' LIMIT 1';
    	$result = db_query($query);

        $user_found = false;
    	while($row = mysql_fetch_array($result)){
            $user_found = true;
    		$this->user_username = $row['user_username'];
    		$this->user_password = $row['user_password'];
    		$this->user_nickname = $row['user_nickname'];
            $this->user_group = $row['user_group'];
            $this->user_level = $row['user_level'];
    	}

        return $user_found;
    }

    /*****************************
    * handle values for new user and call insert
    *****************************/
    public function newUser($user_username, $user_password, $user_nickname,$user_group, $user_level){
        $query = "SELECT * FROM " . $this->prefix . "user WHERE `user_username` = '" . $user_username . "' LIMIT 1";
        $result = db_query($query);

        if(mysql_num_rows($result) > 0){
            return array('taken','Username already taken.');
        }

        $this->user_username = $user_username;
        $this->user_password = $user_password;
        $this->user_nickname = $user_nickname;
        $this->user_group = $user_group;
        $this->user_level = $user_level;
        $this->user_date_insert = date('Y-m-d H:i:s');

        return $this->insertUser();
    }

    /*****************************
    * insert this user into database
    *****************************/
    private function insertUser(){
        $query = "INSERT INTO " . $this->prefix . "user (`user_username`, `user_password`, `user_nickname`, `user_group`, `user_date_insert`, `user_level`) values ('" . $this->user_username . "','" . $this->user_password . "','" . $this->user_nickname . "','" . $this->user_group . "','" . $this->user_date_insert . "','" . $this->user_level . "')";
        $this->user_id = db_query_return_id($query);

        return;
    }

    /*****************************
    * update user
    *****************************/
    public function updateUser(){
        $query = "UPDATE " . $this->prefix . "user SET `user_username` = '" . $this->user_username . "', `user_password` = '" . $this->user_password . "', `user_nickname` = '" . $this->user_nickname . "', `user_group` = '" . $this->user_group . "', `user_level` = '" . $this->user_level . "' WHERE `user_id` = '" . $this->user_id . "'";
        $result = db_query($query);
        return;
    }

    /*****************************
    * delete user
    *****************************/
    public function deleteUser(){
        $query = "DELETE " . $this->prefix . "user WHERE `user_id` = '" . $this->user_id . "'";
        $result = db_query($query);
        return;
    }

    /*****************************
    * validate login and check if username and password combination exists
    *****************************/
    public function validateLogin($user_username,$user_password) {
        $query = "SELECT * FROM " . $this->prefix . "user WHERE `user_username` = '" . $user_username . "' AND `user_password` = '" . $user_password . "' LIMIT 1";
        var_dump($query);
        $result = db_query($query);

        $user_found = false;
        while($row = mysqli_fetch_array($result)){
            $user_found = true;
            $this->user_id = $row['user_id'];
            $this->user_username = $row['user_username'];
            $this->user_password = $row['user_password'];
            $this->user_nickname = $row['user_nickname'];
            $this->user_group = $row['user_group'];
            $this->user_level = $row['user_level'];
        }

        return $user_found;
    }

    /*****************************
    * ajax login check
    *****************************/
    public function validateLoginJson($user_username,$user_password) {
        if($this->validateLogin($user_username,$user_password))
            return;
        else
            return array('Wrong log-in details.');
    }


    /*****************************
    * check whether logged in
    *****************************/
    public function loggedIn(){
        return $this->validateLogin($this->user_username,$this->user_password);
    }

    /*****************************
    * get all track for this user
    *****************************/
    public function getUserTracks(){
        $tracks = array();
        $query = "SELECT track_id FROM " . $this->prefix . "group_track WHERE group_id=" . $this->user_group;
        $result = db_query($query);

        while($row = mysql_fetch_array($result)){
            $tracks[] = $row['track_id'];
        }

        return $tracks;
    }

    /*****************************
    * general getters
    *****************************/
    public function getId(){
        return $this->user_id;
    }

    public function getLevel(){
        return $this->user_level;
    }

    public function getUserGroup(){
        return $this->user_group;
    }

    public function getUsername(){
        return $this->user_username;
    }

    public function getNickname(){
        return $this->user_nickname;
    }

    /*****************************
    * general setters
    *****************************/
    public function setLevel($user_level){
        $this->user_level = $user_level;
    }
}

?>
