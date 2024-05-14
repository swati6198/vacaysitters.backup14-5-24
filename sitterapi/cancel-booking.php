<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
$sql = "UPDATE booking SET bookingStatus='Cancelled',bookingCancelledby='Sitter',bookingCanceltimes='".date('Y-m-d H:i:s')."' ,bookingsStatusremark='".$data['remark']."'  WHERE bookingID='".$data['bookingID']."'";
$statement = queryMysql($sql);
$sql = "SELECT * FROM booking WHERE bookingID='".$data['bookingID']."'";
$statement1 = queryMysql($sql);
$row_all = $statement1->fetchall(PDO::FETCH_ASSOC);
//sendNotification

 $sql_user = " SELECT * FROM booking JOIN user ON user.userID=booking.bookingUserid WHERE bookingID='".$data['bookingID']."'";
        $sql_userdata = queryMysql($sql_user);
        $row_user = $sql_userdata->fetch(PDO::FETCH_ASSOC);
        $msgtxt='Hey '.$row_user['userFirstname'].' , Your sitter has Cancelled your booking. Check application for more details';
        sendUserNotification( $row_user['userFcmtoken'], "Booking Cancelled", $msgtxt);
        $sql3 = "INSERT INTO notifications(Type, notificationsForId, Title, Message) 
            VALUES('User', '".$row_all[0]['bookingUserid']."','Booking Cancelled', '".$msgtxt."')";
            queryMysql($sql3);



$sql2 = "SELECT * FROM user WHERE userID='".$row_all[0]['bookingSitterid']."'";
$statement2 = queryMysql($sql2);
if($statement2->rowCount())
{
    $row_all_user = $statement2->fetchall(PDO::FETCH_ASSOC);
}
$subject1 = "We can’t believe you cancelled the booking.";
$name = $row_all_user[0]['userFirstname'] .' '. $row_all_user[0]['userLastname'];
$message1 = "Dear ".$name.",<br><br> If the cancellation is due to your time commitments, be informed you actually have an option to reschedule your  booking to a later day or time of your choice depending on the  availability.<br><br><br>In case of any complaints, write to us at Support@vacaysitter.in <><brbr><br>We are always happy to help!";
//infomailtemplate($subject1, $message1, $row_all_user[0]['userEmail'], $name,"user");
header('Content-type:application/json;charset=utf-8');
echo json_encode(array("status"=>"true","data"=>"","message"=>"Booking Cancelled Successfully!"));
?>