<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
$email = $data['email'];

$six_digit_random_number = random_int(100000, 999999);

$sql_query = "SELECT * FROM user WHERE userEmail='".$data['email']."' ";
$statement_query = queryMysql($sql_query);

$user_data=$statement_query->fetch(PDO::FETCH_ASSOC);

if($user_data['userStatus']==2 )
{
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Your Account has been deleted."));
    die;
}

if($statement_query->rowCount() && $data['usetype']=='register' )
{
    header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"Account already exists. Please login to your account"));
    die;
}
if(!$statement_query->rowCount() && $data['usetype']=='login' )
{
    header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"Account doesn't exists. Please register yourself first"));
    die;
}

if($data['referCode']!='')
{
    $refer_query = "SELECT * FROM user WHERE userRefercode='".$data['referCode']."' AND userStatus='1'";
    $statement_userrefer = queryMysql($refer_query);
    
    $sitter_refer_query = "SELECT * FROM sitter WHERE sitterRefercode='".$data['referCode']."' AND sitterStatus='1'";
    $statement_sitterrefer = queryMysql($sitter_refer_query);
    
    if($statement_userrefer->rowCount()<=0 && $statement_sitterrefer->rowCount()<=0 )
    {
        header('Content-type: application/json');
        echo json_encode(array("status"=>"true","data"=>"","message"=>"Invalid refferal code"));
        die;
    }
}


$httpcode=sendemail($email,$six_digit_random_number);

if ($httpcode == 200) 
{
    $sql1 = "SELECT * FROM tmpotp WHERE email='".$data['email']."' AND appType='User'";

$statement1 = queryMysql($sql1);

if($statement1->rowCount())
{
    $sql="UPDATE tmpotp SET otp='".$six_digit_random_number."' WHERE email='".$data['email']."' AND appType='User'";
    queryMysql($sql);
}
else{
     $sql2="INSERT INTO tmpotp SET email='".$data['email']."',otp='".$six_digit_random_number."',appType='User'";
    queryMysql($sql2);
}

   header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"OTP sent successfully"));
    
} 
else {
   header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"Failed to send"));
}


?>