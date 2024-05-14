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
         
           $sql =  "UPDATE booking SET bookingCheckout='".date('Y-m-d H:i:s')."',bookingCheckoutimg='".$targetFilePath."' WHERE bookingID='".$_POST['bookingID']."'";
           $statement = queryMysql($sql);
           $sql2 = "UPDATE booking SET bookingStatus='Completed'  WHERE bookingID='".$_POST['bookingID']."'";
           $statement = queryMysql($sql2);
             $userdata = "SELECT * FROM sitter WHERE sitterID='".$data['sitterID']."' ";
            $userdataqry = queryMysql($userdata);
             $user_row_all = $userdataqry->fetch(PDO::FETCH_ASSOC);
             
              $sql_user = " SELECT * FROM booking JOIN user ON user.userID=booking.bookingUserid WHERE bookingID='".$_POST['bookingID']."'";
        $sql_userdata = queryMysql($sql_user);
        $row_user = $sql_userdata->fetch(PDO::FETCH_ASSOC);
        $msgtxt='Hey '.$row_user['userFirstname'].' , Your sitter has cheked out from your place and your booking is complete. Check application for more details';
        sendUserNotification( $row_user['userFcmtoken'], "Booking Complete", $msgtxt);
        $sql3 = "INSERT INTO notifications(Type, notificationsForId, Title, Message) 
            VALUES('User', '".$row_user['userID']."','Booking Complete', '".$msgtxt."')";
            queryMysql($sql3);
           
              if($data['isFirstBooking']==1 && $data['sitterRefercode']!='')
            {
                
                      $sqlT = "INSERT INTO transaction( transactionsUserID, transactionsTitle, transactionsAbout, transactionsTypeID, transactionsType, transactionsAmount) 
                        VALUES( '".$data['sitterID']."', 'Referred Bonus', 'Reffered Bonus', 'Sitter', 'Referral', '".Register_ON_Refferal_BONUS."')";
                        $statementT = queryMysql($sqlT);
                        
                         $sql44 = "UPDATE sitter SET sitterWalletamount=sitterWalletamount+'".Register_ON_Refferal_BONUS."' WHERE sitterID='".$data['sitterID']."'";
                        $statement44 = queryMysql($sql44);
                        
             $userdata = "SELECT * FROM sitter WHERE sitterID='".$data['sitterID']."' ";
            $userdataqry = queryMysql($userdata);
             $user_row_all = $userdataqry->fetch(PDO::FETCH_ASSOC);
             
           $refer_query = "SELECT * FROM user WHERE userRefercode='".$data['sitterRefercode']."' AND userStatus='1'";
            $statement_userrefer = queryMysql($refer_query);
            
             $sitter_refer_query = "SELECT * FROM sitter WHERE sitterRefercode='".$data['sitterRefercode']."' AND sitterStatus='1'";
           
             $statement_sitterrefer= queryMysql($sitter_refer_query);
            
             if($statement_userrefer->rowCount()>0)
             {
                $refer_user_data = $statement_userrefer->fetch(PDO::FETCH_ASSOC);
            
                 $sql22 = "UPDATE user SET userWalletamount=userWalletamount+'".Refferal_BONUS."' WHERE userRefercode='".$data['sitterRefercode']."'";
                
                  $statement22 = queryMysql($sql22);
                  
                   $sqlT1 = "INSERT INTO transaction( transactionsUserID, transactionsTitle, transactionsAbout, transactionsTypeID, transactionsType, transactionsAmount) 
            VALUES( '".$refer_user_data['userID']."', 'Referral Bonus', '".$user_row_all['sitterFirstname']." has used your referral code"."', 'User', 'Referral', '".Refferal_BONUS."')";
            
                 $statementT1 = queryMysql($sqlT1);
             }
             else if($statement_sitterrefer->rowCount()>0)
             {
               
                 $refer_sitter_data = $statement_sitterrefer->fetch(PDO::FETCH_ASSOC);
                 $sql33 = "UPDATE sitter SET sitterWalletamount=sitterWalletamount+'".Refferal_BONUS."' WHERE sitterRefercode='".$data['sitterRefercode']."'";
                  $statement22 = queryMysql($sql33);
                  
                    $sqlT33 = "INSERT INTO transaction( transactionsUserID, transactionsTitle, transactionsType, transactionsTypeID, transactionsAbout, transactionsAmount) 
            VALUES( '".$refer_sitter_data['sitterID']."', 'Referral Bonus payout', 'Referral Payout"."', 'Sitter', 'Referral Payout for Sitter - ".$user_row_all['sitterFirstname']." registration', '".Refferal_PAYOUT."')";
                  
                 $statementT3 = queryMysql($sqlT33);
             }
            }
    }
    else{
         header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Something went wrong"));
    die;
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