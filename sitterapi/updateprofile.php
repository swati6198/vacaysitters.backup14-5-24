<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

$sql = "UPDATE sitter SET sitterFirstname='".$data['sitterFirstname']."', sitterLastname='".$data['sitterLastname']."',
 sitterEmail='".$data['sitterEmail']."', sitterMobileno='".$data['sitterMobileno']."', sitterDOB='".$data['sitterDOB']."',
  sitterLat='".$data['sitterLat']."', sitterLong='".$data['sitterLong']."',
   sitterAddress='".$data['sitterAddress']."', sitterProviance='".$data['sitterProviance']."',sitterSkills='".$data['sitterSkills']."',sitterIssmoker='".$data['sitterIssmoker']."', sitterBio='".$data['sitterBio']."' WHERE sitterID='".$data['sitterID']."'";
$statement = queryMysql($sql);


    $sql = "SELECT * FROM sitter WHERE sitterID='".$data['sitterID']."'";
    $statement1 = queryMysql($sql);
    $row_all = $statement1->fetchall(PDO::FETCH_ASSOC);
    header('Content-type:application/json;charset=utf-8');
    echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>"Profile Updated"));
?>