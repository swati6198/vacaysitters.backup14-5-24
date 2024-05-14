<?php
require_once('../config.inc.php');
require_once('../function.php');
require_once('booking-commonfunc.php');

$data = file_get_contents("php://input");
$events = json_decode($data, true);
$sql ="INSERT INTO paymentresponse(payment,userID) values('".$data."','".$events['payload']['metadata']['userID']."')";
$statement = queryMysql($sql);


if($events['type']=='payment.succeeded')
{
    
    $paymentid=$events['id'];
    $paymentstatus='success';
    $data=$events['payload']['metadata'];
      $data['paymentid']=$paymentid;
    $data['paymentstatus']=$paymentstatus;
    
    addbooking($data);

}
?>
