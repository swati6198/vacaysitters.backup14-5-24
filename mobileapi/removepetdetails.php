<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents("php://input");
$data = json_decode($dataJSON, true);


if($data["petID"]!='')
{

    $sql = "UPDATE pet SET petStatus=0 WHERE petID='".$data['petID']."'";
                
    $statement = queryMysql($sql);

    if ($statement->rowCount()) 
    {
            header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => "","message"=>"pet details updated successfully"]);
        } else {
            header("Content-type: application/json");
            echo json_encode([
                "status" => "false",
                "data" => "",
                "message"=>"Not able to update"
            ]);
        }
}
else{
     echo json_encode([
            "status" => "false",
            "data" => "",
            "message"=>"Oopss..Some fields are missing"
        ]);
}
?>
