<?php
/***********************
user.php
check if user is found in session
***********************/

#check logged-in status
if(isset($_SESSION['UserMasterObject'])){
	$UserMasterObject = unserialize($_SESSION['UserMasterObject']);
}

?>