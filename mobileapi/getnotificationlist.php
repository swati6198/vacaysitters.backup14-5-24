<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 


 $sql = "SELECT * FROM  notifications WHERE Type='User' AND notificationsForId =".$data['userID']." ORDER BY Id DESC";
         $statement = queryMysql($sql);
        if($statement->rowCount() > 0)
        {
            $data=$statement->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(array("status"=>"true","data"=>$data,"message"=>"Notifictation List"));
        }
        else
        {   
            echo json_encode(array("status"=>"true","data"=>"Data Not Found"));
        }
