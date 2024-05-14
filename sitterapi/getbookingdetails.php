<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

if($data['bookingID']!='')
{
        
        $sql = "SELECT  booking.*,user.userFirstname,user.userLastname,user.userMobileno,user.userEmail,user.userAddress,user.userProfileUrl,user.userLat,user.userLong,sitter.sitterFirstname,sitter.sitterLastname,sitter.sitterMobileno,sitter.sitterAddress,sitter.sitterProfileurl FROM booking JOIN sitter ON sitter.sitterID=booking.bookingsSitterid JOIN user ON user.userID=booking.bookingUserid WHERE bookingID ='".$data['bookingID']."'  ";
         $statement = queryMysql($sql);
        if($statement->rowCount() > 0)
        {
            $sql111="SELECT * from rating where ratingBookingid='".$data['bookingID']."' AND ratingGivenby='User'";
             $statement111 = queryMysql($sql111);
        if($statement111->rowCount() > 0)
        {
            $bookingrated='1';
        }
        else{
            $bookingrated='0';
        }
           $booking_data= $statement->fetch(PDO::FETCH_ASSOC);
             $sql1 = "SELECT  * FROM pet LEFT JOIN bookingdetails ON bookingdetails.bookingdetailPetid=pet.petID WHERE bookingid='".$booking_data['bookingID']."'";
                         $statement1 = queryMysql($sql1);
                        if($statement1->rowCount() > 0)
                        {
                           $petdata= $statement1->fetchall(PDO::FETCH_ASSOC);
                        }
                        
                        $booking_data['bookingPetdata']=$petdata;
                        $booking_data['bookingRated']=$bookingrated;
            echo stripslashes(json_encode(array("status"=>"true","data"=>$booking_data,"message"=>"Bookings List")));
        }
        else
        {   
            echo json_encode(array("status"=>"true","data"=>"","message"=>"Data Not Found"));
        }
}
else
{
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Invalid Data"));
}



?>