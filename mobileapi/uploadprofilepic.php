<?php 


require_once('../config.inc.php');
require_once('../function.php');

$targetDir = "../img/"; 


$fileName = basename($_FILES['file']['name']); 
$targetFilePath = $targetDir.$fileName; 


if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
   
    $sql =  "UPDATE user SET userProfileurl='".$targetFilePath."' WHERE userID='".$_POST['userID']."'";
    $statement = queryMysql($sql);
    
    if($statement->rowCount())
    {
    header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"Profile pic updated"));
       
    
    }else{
    
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Please try again!"));
    
    
    }

} else{
   
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Please try again!"));
    
    
}


?>