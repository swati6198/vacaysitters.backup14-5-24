<?php
require_once('../config.inc.php');
require_once('../function.php');
$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

if($data['sitterID']!='')
{
        
        $sql = "SELECT  * FROM booking JOIN user ON user.userID=booking.bookingUserid JOIN sitter ON sitter.sitterID=booking.bookingsSitterid  WHERE bookingsSitterid ='".$data['sitterID']."'  ORDER BY bookingID DESC";
         $statement = queryMysql($sql);
        if($statement->rowCount() > 0)
        {
           $booking_data= $statement->fetchall(PDO::FETCH_ASSOC);
           foreach($booking_data as $key=>$val)
                    {
                        if($val['bookingtType']=='Pet Sitter')
                        {
                           
                            $sql1 = "SELECT  petName FROM pet LEFT JOIN bookingdetails ON bookingdetails.bookingdetailPetid=pet.petID WHERE bookingid='".$val['bookingID']."'";
                          
                             $statement1 = queryMysql($sql1);
                            if($statement1->rowCount() > 0)
                            {
                               $petdata= $statement1->fetchall(PDO::FETCH_ASSOC);
                            }
                            
                            $petname='';
                            foreach ($petdata as $petdata) 
                            {
                                if($petname=='')
                                {
                                    $petname.= $petdata['petName'];
                                }
                                else
                                {
                                    $petname.= ','.$petdata['petName'];
                                }
                                
                            }
                            $petdata=explode(",",$petdata);
                        }
                        else{
                            $petname='';
                        }
                        $arr[]=array("bookingID"=>$val['bookingID'],
                                    "bookingUid"=>$val['bookingUid'],
                                    "bookingTotalamt"=>$val['bookingTotalamt'],
                                    "bookingDuration"=>$val['bookingDuration'],
                                    "bookingStartdate"=>$val['bookingStartdate'],
                                    "bookingEnddate"=>$val['bookingEnddate'],
                                    "userFirstname"=>$val['userFirstname'],
                                    "userLastname"=>$val['userLastname'],
                                    "userProfileurl"=>$val['userProfileurl'],
                                    "petName"=>$petname,
                                    "bookingStatus"=>$val['bookingStatus']
                        );
                    }
           
            echo stripslashes(json_encode(array("status"=>"true","data"=>$arr,"message"=>"Bookings List")));
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