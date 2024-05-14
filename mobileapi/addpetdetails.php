<?php
require_once('../config.inc.php');
require_once('../function.php');
$data =$_POST;


if($data["userID"]!='' && $data["petType"]!='' && $data["petName"]!='')
{
    
    $targetDir = "../img/pets/"; 
$fileName = basename($_FILES['file']['name']); 
$targetFilePath = $targetDir.$fileName; 
move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);
$sql ="INSERT INTO pet(userID, petType, petName,petGender,petImg, petBreed,petSize) 
                VALUES('" .$data["userID"] ."', '" .$data["petType"] ."', '" .$data["petName"] ."','" .$data["petGender"] ."','".$targetFilePath."', '" .$data["petBreed"] ."', '" .$data["petSize"] ."')";
                
    $statement = queryMysql($sql);

    if ($statement->rowCount()) {
        
            header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => "","message"=>"pet details added successfully"]);
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
