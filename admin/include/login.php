<?php

include("include/global.php");

$loginusername = $_POST["userEmail"];
$password = $_POST["userPassword"];
$currentttime = date('H:i');
if (!empty($loginusername) && !empty($password)){
  $sql = mysqli_query($connect, "SELECT * FROM admin WHERE adminEmail ='".$loginusername."' AND adminPassword ='".md5($password)."'");
  $membercount = mysqli_num_rows($sql);
  $rows = mysqli_fetch_array( $sql);
   
    if ($membercount > 0){
        $statusss = $membercount['employeeStatus'];
        if ($statusss == "1"){
        $intime = date('H:i',strtotime($membercount['employeeIntime']));
        $outtime = date('H:i',strtotime($membercount['employeeOuttime']));
        if ($currentttime < $intime){

            $status = http_response_code(200);
            echo json_encode(array("status"=>$status,"message"=>"Sorry you are not authorised to login at this time"));
        }else{
            if ($currentttime < $outtime){
                $loginID = $rows['adminID'];
                $_SESSION['adminlogin'] = $loginID;
                $_SESSION['timestamp']=time();
                $status = http_response_code(200);
                echo json_encode(array("status"=>$status,"message"=>"Login"));
            }else{
                $status = http_response_code(200);
                echo json_encode(array("status"=>$status,"message"=>"Sorry you are not authorised to login at this time"));
            }
        }
        }else{
            $status = http_response_code(200);
            echo json_encode(array("status"=>$status,"message"=>"Account Deleted."));
        }
    }else{
        $status = http_response_code(200);
        echo json_encode(array("status"=>$status,"message"=>"Password Incorrect with this email"));
    }
}else{
    $status = http_response_code(400);
    echo json_encode(array("status"=>$status,"message"=>"Unable to login. Data is incomplete"));
}



?>