<?php
error_reporting(0);
ini_set('display_errors', 0);
define("DATABASE","vacaysitters");
define("DATABASEUSERNAME","vacaysitters");
define("DATABASEHOSTNAME","localhost");
define("DATABASEPASSWORD","vacaysitters");
date_default_timezone_set('Asia/Kolkata');
//Version 1.0.1

 
$connect=new mysqli(DATABASEHOSTNAME,DATABASEUSERNAME,DATABASEPASSWORD,DATABASE) ;
		
		if ($connect->connect_error) {
   			 die("Connection failed: " . $connect->connect_error);
		}


?>	