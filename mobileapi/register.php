<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents("php://input");
$data = json_decode($dataJSON, true);


if($data["userFirstname"]!='' && $data["userLastname"]!='' && $data["userEmail"]!='' && $data["userAddress"]!='' && $data["userFcmtoken"]!='')
{
   
$sql1 = "SELECT * FROM user WHERE userEmail='" . $data["userEmail"] . "'";
$statement1 = queryMysql($sql1);

if ($statement1->rowCount()) {  
    header("Content-type: application/json");
    echo json_encode(["status" => "false", "data"=>"","message" => "Account already exists"]);
} else {
    
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $my_refcode = 'VCUSER-'.substr(str_shuffle($str_result),
        0, 6);
    $sql = "INSERT INTO user(userMobileno, userFirstname, userLastname, userEmail, userLat, userLong, userAddress, userPlatform_os, userFcmtoken, userStatus,userRefercode,userReferbycode,userProviance) 
                VALUES('" .$data["userMobileno"] ."', '" .$data["userFirstname"] ."', '" .$data["userLastname"] ."', '" .$data["userEmail"] ."', '" .$data["userLat"] ."', '" .$data["userLong"] ."', '" .$data["userAddress"] ."',  '" .$data["userPlatform_os"] ."',  '" .$data["userFcmtoken"] ."','1','".$my_refcode."','".$data['referCode']."','".$data['userProviance']."')";
                
            
    $statement = queryMysql($sql);

    if ($statement->rowCount()) {
        
         
        $sql2 ="SELECT * FROM user WHERE userEmail='" . $data["userEmail"] . "'";
        $statement2 = queryMysql($sql2);
        if ($statement2->rowCount()) {
            $row_all = $statement2->fetch(PDO::FETCH_ASSOC);

            $subject1 = "Welcome ";
            $name = $data["userFirstname"] . " " . $data["userLastname"];
            $message1 =
                "Dear " .
                $name .
                ",<br><br> Congratulations! You have successfully created an account with us. Now, you can access our services <br><br>";
            // infomailtemplate($subject1, $message1, $data['userEmail'],$name);

            header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => $row_all,"message"=>"registeration successfull"]);
        } else {
            header("Content-type: application/json");
            echo json_encode([
                "status" => "false",
                "data" => "",
                "message"=>"Not able to register, try again!"
            ]);
        }
    } else 
    {
        header("Content-type: application/json");
        echo json_encode([
            "status" => "false",
            "data" => "",
             "message"=>"Not able to register, try again!"
        ]);
    }
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
