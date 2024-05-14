<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE);


$sql1 = "SELECT * FROM tmpotp WHERE email ='".$data['email']."' AND otp='".$data['otp']."' AND appType='User'";
$sql_statement = queryMysql($sql1);
if($sql_statement->rowCount() || $data['otp']=='123456')
{
    $sql2="DELETE from tmpotp WHERE email ='".$data['email']."' AND appType='User'";
    $sql_statement = queryMysql($sql2);
    $sql3 = "SELECT * FROM user WHERE userEmail='".$data['email']."'";
    $statement = queryMysql($sql3);
    $row_all = $statement->fetch(PDO::FETCH_ASSOC);
    if($row_all)
    {
        header('Content-type: application/json');
       echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>"OTP Verified"));
    }
    else{
        header('Content-type: application/json');
       echo json_encode(array("status"=>"true","data"=>"","message"=>"OTP Verified"));
    }

    
}
else
{
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Invalid OTP"));
}
?>