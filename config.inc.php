<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
date_default_timezone_set("Asia/Kolkata");

error_reporting(0);
ini_set('display_errors', 0);

$servername = "localhost";
$username = "vacaysitters";
$password = "vacaysitters";
$dbname = "vacaysitters";


try {
    	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$connection -> exec("set names utf8");
    }
catch(PDOException $e)
    {
    	die("OOPs something went wrong");
    }
define("FIRST_BOOKING_BONUS",100);
define ("Register_ON_Refferal_BONUS",100);
define("Refferal_BONUS",100);
define("Refferal_PAYOUT",100);
?>

