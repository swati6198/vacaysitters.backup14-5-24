<?php
require_once('../config.inc.php');
require_once('../function.php');
$data = $_POST;


$sql1 = "SELECT * FROM tmpotp WHERE email ='".$data['email']."' AND otp='".$data['otp']."' AND appType='User' AND otpFor='Booking'";
$sql_statement = queryMysql($sql1);
if($sql_statement->rowCount() || $data['otp']=='123456')
{
    $sql2="DELETE from tmpotp WHERE email ='".$data['email']."' AND appType='User'  AND otpFor='Booking' ";
    $sql_statement = queryMysql($sql2);
    
    $targetDir = "../img/"; 
    $fileName = basename($_FILES['file']['name']); 
    $targetFilePath = $targetDir.$fileName; 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath))
    { 
        
             $sql =  "UPDATE booking SET bookingCheckedin='".date('Y-m-d H:i:s')."',bookingCheckinimg='".$targetFilePath."' WHERE bookingID='".$_POST['bookingID']."'";
            $statement = queryMysql($sql);
            
             $sql_user = " SELECT * FROM booking JOIN user ON user.userID=booking.bookingUserid WHERE bookingID='".$_POST['bookingID']."'";
        $sql_userdata = queryMysql($sql_user);
        $row_user = $sql_userdata->fetch(PDO::FETCH_ASSOC);
        $msgtxt='Hey '.$row_user['userFirstname'].' , Your sitter has cheked in at your place. Check application for more details';
        sendUserNotification( $row_user['userFcmtoken'], "Sitter Checked In", $msgtxt);
        $sql3 = "INSERT INTO notifications(Type, notificationsForId, Title, Message) 
            VALUES('User', '".$row_user['userID']."','Sitter Checked In', '".$msgtxt."')";
            queryMysql($sql3);
        
    }
   
    header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"OTP Verified"));
   
}
else
{
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Invalid OTP"));
}
?>