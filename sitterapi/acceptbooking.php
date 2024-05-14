<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 


$sql = "UPDATE booking SET bookingStatus='Accepted', bookingAcceptedat='".date("Y-m-d H:i:s")."' WHERE bookingID='".$data['bookingID']."'";
$statement = queryMysql($sql);


$sql = "SELECT * FROM booking WHERE bookingID='".$data['bookingID']."'";
$statement1 = queryMysql($sql);
$row_all = $statement1->fetchall(PDO::FETCH_ASSOC);

//sendNotification

 $sql_user = " SELECT * FROM user WHERE userID='".$row_all[0]['bookingUserid']."'";
        $sql_userdata = queryMysql($sql_user);
        $row_user = $sql_userdata->fetch(PDO::FETCH_ASSOC);
        $msgtxt='Hey '.$row_user['userFirstname'].' , Your booking has been accepted by sitter. Check application for more details';
sendUserNotification( $row_user['userFcmtoken'], "Booking Accepted", $msgtxt);
         $sql3 = "INSERT INTO notifications(Type, notificationsForId, Title, Message) 
            VALUES('User', '".$row_all[0]['bookingUserid']."','Booking Accepted', '".$msgtxt."')";
            queryMysql($sql3);

    
header('Content-type:application/json;charset=utf-8');
echo json_encode(array("status"=>"true","data"=>"","message"=>"Booking Accepted"));
      
  
    

?>