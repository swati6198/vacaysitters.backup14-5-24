<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
$sql = "UPDATE booking SET bookingStatus='Cancelled',bookingCancelledby='User',bookingCanceltimes='".date('Y-m-d H:i:s')."' ,bookingsStatusremark='".$data['remark']."'  WHERE bookingID='".$data['bookingID']."'";
$statement = queryMysql($sql);
$sql = "SELECT * FROM booking WHERE bookingID='".$data['bookingID']."'";
$statement1 = queryMysql($sql);
$row_all = $statement1->fetchall(PDO::FETCH_ASSOC);
//sendNotification
$sql_sitter = " SELECT * FROM sitter WHERE sitterID='".$row_all[0]['bookingsSitterid']."'";
$statement_sitter = queryMysql($sql_sitter);
$row_sitter = $statement_sitter->fetchall(PDO::FETCH_ASSOC);

 
$msg_text='Hey '.$row_sitter[0]['sitterFirstname'].', your booking has been cancelled by the user. Check application for more information';

sendSitterNotification( $row_sitter[0]['sitterFcmtoken'], "Booking Cancelled", $msg_text);
$sql3 = "INSERT INTO notifications(Type, notificationsForId, Title, Message) 
                VALUES('Sitter', '".$row_all[0]['bookingsSitterid']."' ,'Booking cancelled', '".$msg_text."')";
        $statement44 = queryMysql($sql3);

$sql2 = "SELECT * FROM user WHERE userID='".$row_all[0]['bookingUserid']."'";
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