<?php 
require_once('../config.inc.php');
require_once('../function.php');
$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE);

 $sql = "INSERT INTO sitterbankdetails(sitterID, bankName, bankAccountno, bankIFSC, bankPhoneno, bankAddress) 
                VALUES('" .$data["sitterID"] ."', 
                        '" .addslashes($data["bankName"]) ."',
                        '" .addslashes($data["bankAccountno"]) ."',
                        '" .$data["bankIFSC"] ."',
                        '" .$data["bankPhoneno"] ."',
                        '" .$data["bankAddress"] ."'
                        )";
    $statement = queryMysql($sql);
    if ($statement->rowCount())
    {
        header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => "","message"=>"Bank details added"]);
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