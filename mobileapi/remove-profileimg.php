<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
unlink($data['userProfileurl']);
$sql =  "UPDATE user SET userProfileurl=NULL WHERE userID='".$data['userID']."'";
$statement = queryMysql($sql);

header('Content-type:application/json;charset=utf-8');
echo json_encode(array("status"=>"true","data"=>"","message"=>"Profile image removed"));
?>