<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

$sql = "UPDATE user SET userFirstname='".$data['userFirstname']."', userLastname='".$data['userLastname']."',
 userEmail='".$data['userEmail']."', userMobileno='".$data['userMobileno']."', userLookingfor='".$data['userLookingfor']."',
  userLat='".$data['userLat']."', userLong='".$data['userLong']."',
   userAddress='".$data['userAddress']."', userProviance='".$data['userProviance']."', userBio='".$data['userBio']."'
WHERE userID='".$data['userID']."'";
$statement = queryMysql($sql);
    $sql = "SELECT * FROM user WHERE userID='".$data['userID']."'";
    $statement1 = queryMysql($sql);
    $row_all = $statement1->fetch(PDO::FETCH_ASSOC);
    header('Content-type:application/json;charset=utf-8');
    echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>"Profile Updated"));
?>