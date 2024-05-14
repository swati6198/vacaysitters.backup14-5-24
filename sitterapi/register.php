<?php
require_once('../config.inc.php');
require_once('../function.php');

$data=$_POST;

if($data["sitterFirstname"]!='' && $data["sitterLastname"]!='' && $data["sitterEmail"]!='' && $data["sitterAddress"]!='' && $data["sitterFcmtoken"]!='')
{
 
$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$my_refcode = 'VCSITTER-'.substr(str_shuffle($str_result),0, 6);

    $sql = "INSERT INTO sitter( sitterFirstname, sitterLastname, sitterEmail, sitterLat, sitterLong, sitterAddress,sitterDOB ,sitterPlatform_os, sitterFcmtoken, sitterStatus,sitterRefercode,sitterReferbycode,sitterProviance,sitterIsapproved) 
                VALUES(
                        '" .addslashes($data["sitterFirstname"]) ."',
                        '" .addslashes($data["sitterLastname"]) ."',
                        '" .$data["sitterEmail"] ."',
                        '" .$data["sitterLat"] ."',
                        '" .$data["sitterLong"] ."',
                        '" .addslashes($data["sitterAddress"]) ."',
                        '" .$data["sitterDOB"] ."',
                        '" .$data["sitterPlatform_os"] ."',
                        '" .$data["sitterFcmtoken"] ."',
                        '1',
                        '".$my_refcode."',
                        '".$data['referCode']."',
                        '".$data['sitterProviance']."',
                        '0'
                        )";
                      
    $statement = queryMysql($sql);

    if ($statement->rowCount()) {
        
         
        $sql2 ="SELECT * FROM sitter WHERE sitterEmail='" . $data["sitterEmail"] . "'";
        $statement2 = queryMysql($sql2);
        if ($statement2->rowCount()) {
            $row_all = $statement2->fetch(PDO::FETCH_ASSOC);

            $subject1 = "Welcome ";
            $name = $data["sitterFirstname"] . " " . $data["sitterLastname"];
            $message1 =
                "Dear " . $name .",<br><br> Congratulations! You have successfully created an account with us. Now, you can access our services <br><br>";
            // infomailtemplate($subject1, $message1, $data['userEmail'],$name);

            header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => $row_all,"message"=>"registration successfull"]);
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

else{
    echo json_encode([
            "status" => "false",
            "data" => "",
            "message"=>"Oopss..Some fields are missing"
        ]);
}

?>
