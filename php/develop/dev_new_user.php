<?php

#quick user create
$UserObject = new UserClass(0);

$username = 'sping';
$password = 'sping';
$nickname = 'Sping';
$group = 1;
$level = 0;

$password_crypt = crypt($password,$salt);

$UserObject->newUser($username,$password_crypt,$nickname,$group,$level);

?>