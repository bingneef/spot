<?php
/*****************************


*****************************/

if(isset($_POST['login_submit'])){

	#get posted username & password
	$post_username = strtolower(trim($_POST['username']));
	$post_password = trim($_POST['password']);

	#crypt password
	$post_password_salt = crypt($post_password,$salt);

	#create user and validateLogin
	$UserMasterObject = new UserClass();
	$succes = $UserMasterObject->validateLogin($post_username,$post_password_salt);

	if($succes){
		$_SESSION['UserMasterObject'] = serialize($UserMasterObject);
		header('Location: ' . ROOT);
		exit;
	}

}
?>