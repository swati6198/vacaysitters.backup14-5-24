<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents("php://input");
$data = json_decode($dataJSON, true);


if($data["userID"]!='' && $data["userHousename"]!='')
{

    $sql = "UPDATE user SET userHousename='" .$data["userHousename"] ."', userAdditionalinfo='" .$data["userAdditionalinfo"] ."' WHERE userID='".$data["userID"]."'";
                
    $statement = queryMysql($sql);

    if ($statement->rowCount()) 
    {
            header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => "","message"=>"House details added successfully"]);
        } else {
            header("Content-type: application/json");
            echo json_encode([
                "status" => "false",
                "data" => "",
                "message"=>"Not able to add"
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
