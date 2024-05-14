<?php
require_once('../config.inc.php');
require_once('../function.php');
$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE);

if($data['couponcode'])
{
    $sql="SELECT * FROM coupon WHERE couponTitle='".$data['couponcode']."' AND couponStatus = 1";
     $statement = queryMysql($sql);
     if($statement->rowCount() > 0)
     {
         $rowoff=fetchData($statement);
        $sql1="SELECT * FROM booking WHERE bookingUserid = '".$data['userId']."' AND bookingCoupon='".$data['couponcode']."' AND bookingStatus !='Cancelled' ";
        $statement1 = queryMysql($sql1);
        $booking_cnt=$statement1->rowCount();
        
        $Minamt = $rowoff['couponMinamt'];
        $Maxamt = $rowoff['couponMaxamt'];
        $Percent = $rowoff['couponPercent'];
        $limit = $rowoff['couponLimit'];
         $ccodes = $rowoff['couponTitle'];
        $newp = $data['subTotalamt']*$Percent/100;
        
        
        if($limit > $booking_cnt)
        {
            if ($data['subTotalamt'] < $Minamt) 
            {
              echo json_encode(array("status"=>"true","data"=>"","msg"=>'Minimum Booking Amount To Use This Coupon Is '.$Minamt.' Rs.'));
            } else if ($Maxamt >= $newp) 
            {
                 $coupon_amt =  $newp;
                 $newtotal = $data['subTotalamt']-$newp;
                $new_Arr= array("coupon_amt"=>$coupon_amt,"couponPercent"=>$Percent,"newSubTotal"=>$newtotal);
                 echo json_encode(array("status"=>"true","data"=>$new_Arr,"msg"=>'Valid Coupon Code'));
                 
            } 
            else if ($Maxamt <= $newp) 
            {
                 $coupon_amt =  $Maxamt;
                 $newtotal = $data['subTotalamt']-$coupon_amt;
                 
                 $new_Arr=array("coupon_amt"=>$coupon_amt,"couponPercent"=>$Percent,"newSubTotal"=>$newtotal);
                 echo json_encode(array("status"=>"true","data"=>$new_Arr,"msg"=>'Valid Coupon Code'));
            } 
        }
        else
        {
            echo json_encode(array("status"=>"true","data"=>"","msg"=>'You Have Already Crossed The Usage Limit For This Coupon'));
        }
     }
     else{
         echo json_encode(array("status"=>"true","data"=>"","msg"=>'Coupon Does Not Exist!!'));
     }
}
else{
         echo json_encode(array("status"=>"false","data"=>"","msg"=>'Oopss..Something went wrong'));
     }


?>