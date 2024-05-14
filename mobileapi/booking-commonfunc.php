<?php

require_once('../config.inc.php');
require_once('../function.php');

function addbooking($data)
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        $book_UID = substr(str_shuffle($str_result),
        0, 6);
        
        $book_UID = "ID_".$book_UID;
        $subject = "You have new booking";
        $message = "View bookings";
        // infomailtemplate($subject, $message, $row_sitter[0]['sitteremail'],$row_sitter[0]['sitterFirstname']);

        $sql_user = " SELECT * FROM user WHERE userID='".$data['userID']."'";
        $statement_user = queryMysql($sql_user);
        $row_user = $statement_user->fetchall(PDO::FETCH_ASSOC);
        $subject1 = "Your booking is successful";
        $name = $row_user[0]['userFirstname'] .' '. $row_user[0]['userLastname'];
        $message1 = "Dear ".$name.",<br><br> This is a confirmation that your booking is processed and we have received your payment. 
         <br><br><br>A copy of the detailed invoice is sent to your email. For more information check your bookings page.  <br><br><br>If you need help,write to us at Support@vacaysitters.in<br><br><br>";
        // infomailtemplate($subject1, $message1, $row_user[0]['userEmail'],$name,"user");
       
        
        $sql = "INSERT INTO booking(bookingUserid, bookingUid, bookingsSitterid,bookingtType, bookingStartdate, bookingEnddate,bookingDuration, bookingCoupanid, bookingDiscountamt,bookingDiscounttype, bookingWalletamt, bookingSubtotalamt, bookingTotalamt, bookingPaidamt, bookingGst, bookingPaymentid, bookingPaymentstatus) 
            VALUES(".$data['userID'].",  '".$book_UID."', ".$data['sitterID'].",'".$data['bookingtType']."', '".$data['bookingStartdate']."', '".$data['bookingEnddate']."', '".$data['bookingduration']."','".$data['CoupanID']."', '".$data['discountamt']."','".$data['discounttype']."', '".$data['walletamt']."', '".$data['subtotalamt']."', '".$data['totalamt']."','".$data['paidamt']."', '".$data['gst']."', '".$data['paymentid']."',  '".$data['paymentstatus']."')";
      
         
        $statement = queryMysql($sql);
        if($statement->rowCount())
        {   
                  
             $sql_sitter = " SELECT * FROM sitter WHERE sitterID='".$data['sitterID']."'";
        $statement_sitter = queryMysql($sql_sitter);
        $row_sitter = $statement_sitter->fetch(PDO::FETCH_ASSOC);
        $msg_text='Hey '.$row_sitter['sitterFirstname'].' , You have new booking. Check application for details';
         sendSitterNotification( $row_sitter[0]['sitterFcmtoken'], "New Booking", $msg_text);
         $sql3 = "INSERT INTO notifications(Type, notificationsForId, Title, Message) 
            VALUES('Sitter', '".$data['sitterID']."','New Booking', '".$msg_text."')";
        $statement55 = queryMysql($sql3);      
                  
                    
            $sql1 = " SELECT * FROM booking WHERE bookingUserid='".$data['userID']."' AND bookingPaymentid='".$data['paymentid']."' ORDER BY bookingID DESC";
             $statement1 = queryMysql($sql1);
            $row_all1 = $statement1->fetchall(PDO::FETCH_ASSOC);
           
           if($data['bookingPetid']!=0)
           {
                $pet_arr=explode(",",$data['bookingPetid']);
            
            for($j=0;$j<count($pet_arr);$j++)
            {
                 $sql111 = "SELECT  * FROM pet WHERE petID='".$pet_arr[$j]."'";
                         $statement111 = queryMysql($sql111);
                       $petdata= $statement111->fetchall(PDO::FETCH_ASSOC);
                       
                $insert_pet="INSERT into bookingdetails(bookingid,bookingdetailSitterid,bookingdetailUserid,bookingdetailPetid,bookingdetailPetname,bookingdetailPettype) values('".$row_all1[0]['bookingID']."'
                ,'".$data['sitterID']."','".$data['userID']."','".$pet_arr[$j]."','".$petdata[0]['petName']."','".$petdata[0]['petType']."')";
                
                 queryMysql($insert_pet);
            }
           }
           
            
    
            
           
            
            if($data['isFirstBooking']==1 && $data['userRefercode']!='')
            {
                
                      $sqlT = "INSERT INTO transaction( transactionsUserID, transactionsTitle, transactionsAbout, transactionsTypeID, transactionsType, transactionsAmount) 
                        VALUES( '".$data['userID']."', 'Referred Bonus', 'Reffered Bonus', 'User', 'Referral', '".Register_ON_Refferal_BONUS."')";
                        $statementT = queryMysql($sqlT);
                        
                         $sql44 = "UPDATE user SET userWalletamount=userWalletamount+'".Register_ON_Refferal_BONUS."' WHERE userID='".$data['userID']."'";
                        $statement44 = queryMysql($sql44);
              
          
            
             $userdata = "SELECT * FROM user WHERE userID='".$data['userID']."' ";
            $userdataqry = queryMysql($userdata);
             $user_row_all = $userdataqry->fetch(PDO::FETCH_ASSOC);
             
           $refer_query = "SELECT * FROM user WHERE userRefercode='".$data['userRefercode']."' AND userStatus='1'";
            $statement_userrefer = queryMysql($refer_query);
            
             $sitter_refer_query = "SELECT * FROM sitter WHERE sitterRefercode='".$data['userRefercode']."' AND sitterStatus='1'";
             $statement_sitterrefer= queryMysql($sitter_refer_query);
            
             if($statement_userrefer->rowCount()>0)
             {
                $refer_user_data = $statement_userrefer->fetch(PDO::FETCH_ASSOC);
            
                 $sql22 = "UPDATE user SET userWalletamount=userWalletamount+'".Refferal_BONUS."' WHERE userReferCode='".$data['userRefercode']."'";
                
                  $statement22 = queryMysql($sql22);
                  
                   $sqlT1 = "INSERT INTO transaction( transactionsUserID, transactionsTitle, transactionsAbout, transactionsTypeID, transactionsType, transactionsAmount) 
            VALUES( '".$refer_user_data['userID']."', 'Referral Bonus', '".$user_row_all['userFirstname']." has used your referral code"."', 'User', 'Referral', '".Refferal_BONUS."')";
            
                 $statementT1 = queryMysql($sqlT1);
             }
             else if($statement_sitterrefer->rowCount()>0)
             {
                 $refer_sitter_data = $statement_sitterrefer->fetch(PDO::FETCH_ASSOC);
                 $sql33 = "UPDATE sitter SET sitterWalletamount=sitterWalletamount+'".Refferal_BONUS."' WHERE sitterRefercode='".$data['userRefercode']."'";
                  $statement22 = queryMysql($sql33);
                  
                    $sqlT33 = "INSERT INTO transaction( transactionsUserID, transactionsTitle, transactionsType, transactionsTypeID, transactionsAbout, transactionsAmount) 
            VALUES( '".$refer_sitter_data['sitterID']."', 'Referral Bonus payout', 'Referral Payout"."', 'Sitter', 'Referral Payout for user - ".$user_row_all['userFirstname']."' registration, '".Refferal_PAYOUT."')";
            
                 $statementT3 = queryMysql($sqlT33);
             }
            }
           
            if($data['walletamt']>0){
                $sqlT = "INSERT INTO transaction( transactionsUserID, transactionsTitle, transactionsAbout, transactionsTypeID, transactionsType, transactionsAmount) 
                VALUES( '".$data['userID']."', '"."Booking #".$row_all1[0]['bookingID']."', 'Amount used while booking"."', 'User', 'Booking', '".$data['walletamt']."')";
                $statementT = queryMysql($sqlT);
                $sql22 = "UPDATE user SET userWalletamount=userWalletamount-'".$data['walletamt']."' WHERE userID='".$data['userID']."'";
                $statement22 = queryMysql($sql22);
            }
        }
   
   return $row_all1[0]['bookingID'];
}

?>