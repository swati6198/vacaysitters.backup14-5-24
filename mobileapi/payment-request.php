<?php
require_once('../config.inc.php');
require_once('../function.php');


$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
if($data['payable_amount']!='')
{
    $payload=array("amount"=>$data['payable_amount']*100,
                   "currency"=>"ZAR",
                   "successUrl"=>"https://vacaysitters.radarsofttech.in/payment_success",
                   "failureUrl"=>"https://vacaysitters.radarsofttech.in/payment_failure",
                   "metadata"=>array("userID"=>$data['userID'],
                                    "sitterID"=>$data['sitterID'],
                                    "bookingtType"=>$data['bookingtType'],
                                    "bookingStartdate"=>$data['bookingStartdate'],
                                    "bookingEnddate"=>$data['bookingEnddate'],
                                    "bookingduration"=>$data['bookingduration'],
                                    "CoupanID"=>$data['CoupanID'],
                                    "walletamt"=>$data['walletamt'],
                                    "subtotalamt"=>$data['subtotalamt'],
                                    "totalamt"=>$data['totalamt'],
                                    "paidamt"=>$data['payable_amount'],
                                    "bookingPetid"=>$data['bookingPetid'],
                                    "isFirstBooking"=>$data['isFirstBooking'],
                                    "userRefercode"=>$data['userRefercode']
                    ));
    $data_string = json_encode($payload);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://payments.yoco.com/api/checkouts');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer sk_test_3f3e840fGVM6EVO98db46109b89c',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    header("Content-type:application/json;charset=utf-8");
    echo json_encode(["status" => "true", "data" => json_decode($response),"message"=>"Payment request created"]);
}
else
{
    header("Content-type:application/json;charset=utf-8");
    echo json_encode(["status" => "false", "data" => "","message"=>"Payable amount field is missing"]);
}