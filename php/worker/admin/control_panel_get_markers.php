<?php

/*****************************


*****************************/

#ids of users in group
$dir = getcwd() . '/images/markers/';

$markers = array();
$i = 0;
// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
    	if(strpos($file,'.svg') !== false && strpos($file,'default') == false){
      		$markers[] = $file;
      		$i++;
    	}
    }
    closedir($dh);
  }
}

var_dump($i);
var_dump($markers);

?>