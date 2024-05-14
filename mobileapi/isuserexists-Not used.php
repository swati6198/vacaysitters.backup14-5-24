<?php
require_once('../config.inc.php');
require_once('../function.php');
$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 



$sql = "SELECT userID,userFirstname,userLastname,userEmail,userMobileno,userAddress,userProfileurl,userStatus FROM user WHERE userMobileno='".$data['userMobileno']."' AND userCountrycode='".$data['userCountrycode']."'";

$statement = queryMysql($sql);

if($statement->rowCount())
{
    $row_all = $statement->fetch(PDO::FETCH_ASSOC);
    if($row_all['userStatus']==1)
    {    
       
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>""));
    }
    else{
    
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Account has been deactivated, Please contact support"));
    
    }
  
}else{
   
    header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"New User"));
    
    
}
  
    

?>