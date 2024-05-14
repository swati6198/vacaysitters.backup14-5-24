<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

$email = $data['email'];
$six_digit_random_number = random_int(100000, 999999);

$httpcode=sendemail($email,$six_digit_random_number);
if ($httpcode == 200) 
{
    $sql1 = "SELECT * FROM tmpotp WHERE email='".$data['email']."' AND appType='User' AND otpFor='Booking'";
    $statement1 = queryMysql($sql1);
    if($statement1->rowCount())
    {
        $sql="UPDATE tmpotp SET otp='".$six_digit_random_number."' WHERE email='".$data['email']."' AND appType='User' AND otpFor='Booking'";
        queryMysql($sql);
    }
    else{
         $sql2="INSERT INTO tmpotp SET email='".$data['email']."',otp='".$six_digit_random_number."',appType='User', otpFor='Booking'";
        queryMysql($sql2);
    }

   header('Content-type: application/json');
   echo json_encode(array("status"=>"true","data"=>"","message"=>"OTP sent successfully"));
}
else
{
      header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Failed to send"));
}
?>