<?php 
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents("php://input");
$data = json_decode($dataJSON, true);


if($data)
{ 
 foreach($data['promptdata'] as $val)
 {
     $sql='';
     $sql ="INSERT INTO bookingpromptans(userID, sitterID, bookingID, bookingPromptID,answer) 
                VALUES('" .$data["userID"] ."', '" .$data["sitterID"] ."', '" .$data["bookingID"] ."', '" .$val["id"] ."', '" .$val["ans"] ."')";
    $statement = queryMysql($sql);
   
 }
  header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"Response submitted"));
    
} else{
   
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Please try again!"));
    
    
}


?>