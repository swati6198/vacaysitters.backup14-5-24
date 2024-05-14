<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 



 $sql = "INSERT INTO endorsement(sitterID, name, email, mobile, endorsementtext) 
                VALUES('" .$data["sitterID"] ."', 
                        '" .addslashes($data["firstName"]).' '.addslashes($data["lastName"])."',
                        '" .$data["email"] ."',
                        '" .$data["mobile"] ."',
                        '" .addslashes($data["endorsementtext"])."'
                        )";
    $statement = queryMysql($sql);
    if ($statement->rowCount())
    {
        header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => "","message"=>"endorsement added"]);
    }
    else
    {
          header("Content-type: application/json");
        echo json_encode([
            "status" => "false",
            "data" => "",
             "message"=>"Not able to add, try again!"
        ]);
    }

?>