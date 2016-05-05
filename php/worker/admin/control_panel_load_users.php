<?php

/*****************************


*****************************/

#ids of users in group
$group_id = $UserMasterObject->getUserGroup();
$GroupObject = new GroupClass($group_id);
$user_ids = $GroupObject->getAllGroupUsers();

#get all user objects
$UserObjects = array();
foreach($user_ids as $user_id){
	$UserObjects[] = new UserClass($user_id);

}

?>