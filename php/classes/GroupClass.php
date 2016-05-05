<?php 

/*****************************

GroupClass.php

*****************************/

class GroupClass { 
    protected $group_id;

    private $prefix = 'spot_hashtag_';
    
    /*****************************
    * construct class
    *****************************/
    public function __construct($group_id = 0) { 
        $this->group_id = $group_id;
        return;
    } 

    /*****************************
    * get all group users
     *****************************/
    public function getAllGroupUsers(){
    	$query = 'SELECT * FROM ' . $this->prefix . 'user WHERE user_group = ' . $this->group_id;
    	$result = db_query($query);

    	$user_ids = array();
        while($row = mysql_fetch_array($result)){
            $user_ids[] = $row['user_id'];
        }

        return $user_ids;
    }

    /*****************************
    * general getters
    *****************************/

    /*****************************
    * general setters
    *****************************/
} 

?>