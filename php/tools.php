<?php

/***********************
tools.php
define function used in every page
***********************/


/***********************
autoload function classes if not already included
***********************/
function __autoload($className) {
     include 'classes/' . $className . '.php';
}

/***********************
run database query
***********************/
function db_query($query){
	#get variables
	include('dbinfo.inc.php');

	#Connect to Database
	$mysqli = new mysqli($db_localhost,$db_username,$db_password, $db_database) or die('test');

	if ($result = mysqli_query($mysqli, $query)) {
    mysqli_close($mysqli);
    return $result;
	} else {
		echo("error");
		return null;
	}
}

/***********************
run database query and return added id
***********************/
function db_query_return_id($query){
	#get variables
	include('dbinfo.inc.php');

	#Connect to Database
	mysqli_connect($db_localhost,$db_username,$db_password);
	mysqli_select_db($db_database) or die( "Unable to select database");

	#get result
	mysqli_query($query);

	$inserted_id = mysqli_insert_id();

	#close db
	mysqli_close();

	#return mysqli_insert_id
	return $inserted_id;
}

/***********************
get random color
***********************/
function randomColor(){
	#return random color
	$color = sprintf("#%06x",rand(0,16777215));
	return $color;
}

/***********************
write to console (use with caution)
***********************/
function consoleLog($text){
	#print to console
	echo '<script>console.log("' . $text . '");</script>';
}

/***********************
eval php code for string insertation
***********************/
function _readphp_eval($code) {
  ob_start();
  var_dump($code);
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

?>
