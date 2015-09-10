<?php
#starting user's Session
session_start();
require ('connect/database.php');
require ('classes/users.php');


$users=new Users($db);


$errors=array();



?>
