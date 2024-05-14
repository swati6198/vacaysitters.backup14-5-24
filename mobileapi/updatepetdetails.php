<?php
require_once('../config.inc.php');
require_once('../function.php');

$data = $_POST;


if($data["petID"]!='' && $data["petType"]!='' && $data["petName"]!='')
{
         if($_FILES['file']['tmp_name'])
            {
                    $temp_name=$_FILES['file']['tmp_name'];
                    $file_name=$_FILES['file']['name'];   
                    $fbl = time();
                    $nefilename =   $fbl.$file_name;
                    $file_path="../img/pets/".$nefilename;
                   
                    move_uploaded_file($temp_name,$file_path);
                      $file_url="../img/pets/".$nefilename;
                   
                    $cond=", petImg='".$file_url."'";
            }
            else{
                $cond='';
            }
           

    $sql = "UPDATE pet SET petType='" .$data["petType"] ."', petName='" .$data["petName"] ."', petGender='" .$data["petGender"] ."', petBreed='" .$data["petBreed"] ."', petSize= '" .$data["petSize"] ."'".$cond." WHERE petID='".$data['petID']."'";
    
   
    $statement = queryMysql($sql);
    header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => "","message"=>"pet details updated successfully"]);
        
}
else{
     echo json_encode([
            "status" => "false",
            "data" => "",
            "message"=>"Oopss..Some fields are missing"
        ]);
}
?>
