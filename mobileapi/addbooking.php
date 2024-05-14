<?php
require_once('../config.inc.php');
require_once('../function.php');
require_once('booking-commonfunc.php');


$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

$id=addbooking($data);
     
    header('Content-type:application/json;charset=utf-8');
    echo json_encode(array("status"=>"true","data"=>$id,"message"=>"Order placed successfully"));
    
    
   

?>