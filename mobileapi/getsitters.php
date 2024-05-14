<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 


$DISTANCE_KILOMETERS = 10;
$rowcnt=0;
 $sql1 = "UPDATE user SET userPlatform_os='".$data['userPlatform']."', userFcmtoken='".$data['userFcmtoken']."' WHERE userID='".$data['userID']."'";
        $statement1 = queryMysql($sql1);
if($data['longitude']!='' && $data['latitude']!='')
{
    $sql4 = "SELECT *, ST_Distance_Sphere( point( sitterLong,sitterLat), point(".$data['longitude'].", ".$data['latitude'].") ) *.001 AS distance FROM sitter
        WHERE sitterIsapproved='1' AND  sitterStatus='1' AND  ( ST_Distance_Sphere( point( sitterLong,sitterLat), point(".$data['longitude'].", ".$data['latitude'].") ) *.001 ) <=$DISTANCE_KILOMETERS ORDER BY distance ASC";
        
    
        $statement4 = queryMysql($sql4);
        $rowcnt=$statement4->rowCount();
}
if($rowcnt<=0 && $data['userID']!='')
{
        $sql = "SELECT * FROM user WHERE userID='".$data['userID']."'";
        $statement = queryMysql($sql);
        $row_all = $statement->fetch(PDO::FETCH_ASSOC);
         
         if($row_all['userLat']!='' && $row_all['userLong']!='')
         {
              $sql5 = "SELECT *, ST_Distance_Sphere( point( sitterLong,sitterLat), point(".$row_all['userLong'].", ".$row_all['userLat'].") ) *.001 AS distance FROM sitter
        WHERE sitterIsapproved='1' AND  sitterStatus='1' AND  ( ST_Distance_Sphere( point( sitterLong,sitterLat), point(".$row_all['userLong'].", ".$row_all['userLat'].") ) *.001 ) <=$DISTANCE_KILOMETERS ORDER BY distance ASC";
        
        $statement4 = queryMysql($sql5);
         }
        
        
}
if($statement4->rowCount()<=0)
{
    $sql4 = "SELECT *,'0' AS distance FROM sitter
        WHERE sitterIsapproved='1' AND  sitterStatus='1'  ORDER BY sitterID DESC";
     $statement4 = queryMysql($sql4);        
}
$row_all = $statement4->fetchall(PDO::FETCH_ASSOC);
if($row_all)
{
    $i=0;
        foreach ($row_all as $row_all_OBJ)
        {
        
           $sqlR = "SELECT COUNT(ratingSitterid) As total_number, SUM(ratingCount) AS total_ratings FROM rating WHERE ratingGivenby='USER' AND  ratingSitterid='".$row_all_OBJ['sitterID']."' GROUP BY ratingBookingid";
            $statementR = queryMysql($sqlR);
            $row_allR = $statementR->fetchall(PDO::FETCH_ASSOC);
            if($row_allR[0]['total_number']!=0){
                $row_all[$i]['ratingsAVG'] = $row_allR[0]['total_ratings']  /  $row_allR[0]['total_number'];
                $row_all[$i]['reviewCount'] =  $row_allR[0]['total_number'];
               
            }else{
                $row_all[$i]['ratingsAVG']  = NULL;
                $row_all[$i]['reviewCount'] = NULL;
            }
            
            $sqlR2 = "SELECT * FROM rating INNER JOIN user WHERE rating.ratingGivenby='USER' AND  rating.ratingSitterid='".$row_all_OBJ['sitterID']."' AND user.userID=rating.ratingUserid";
            $statementR2 = queryMysql($sqlR2);
            $row_allR2 = $statementR2->fetchall(PDO::FETCH_ASSOC);
            if($row_allR2!=NULL){
               
                 $row_all[$i]['ratings'] =  $row_allR2;
            }
            $sqlS = "SELECT COUNT(bookingsSitterid) As jobsDone FROM booking WHERE bookingStatus='Completed' AND  bookingsSitterid='".$row_all_OBJ['sitterID']."'";
            $statementS= queryMysql($sqlS);
            $row_allS = $statementS->fetchall(PDO::FETCH_ASSOC);
            if($row_allS[0]['jobsDone']!=0)
            {
                $row_all[$i]['jobsDone'] =  $row_allS[0]['jobsDone'];
            }else{
                $row_all[$i]['jobsDone'] = NULL;
            }
            
            
              $qry="SELECT * FROM endorsement WHERE sitterID='".$row_all_OBJ['sitterID']."' ";
            $statementSt1= queryMysql($qry);
            $row_allSt1 = $statementSt1->fetchall(PDO::FETCH_ASSOC);
            $row_all[$i]['endorsement'] =  $row_allSt1;
            
            $sqlSt = "SELECT bookingStartdate,bookingEnddate FROM booking WHERE bookingsSitterid='".$row_all_OBJ['sitterID']."' AND bookingStartdate>='".date('Y-m-d')."' AND bookingEnddate>='".date('Y-m-d')."' AND bookingStatus!='Cancelled'  UNION  SELECT fromdate as bookingStartdate,todate as bookingEnddate FROM sitternotavail WHERE sitterID='".$row_all_OBJ['sitterID']."' ";
            $statementSt= queryMysql($sqlSt);
            $row_allSt = $statementSt->fetchall(PDO::FETCH_ASSOC);
                $row_all[$i]['dates'] =  $row_allSt;
                $row_all[$i]['distance']=round($row_all_OBJ['distance'],2);
            $i++;
        }
        
        $key_values = array_column($row_all, 'ratingsAVG'); 
        $distance_values = array_column($row_all, 'distance'); 
        array_multisort($key_values, SORT_DESC,$distance_values,SORT_ASC, $row_all);
        
        
        
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>"Available sitters"));
}
else{
     header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("status"=>"false","data"=>"","message"=>"No sitters available"));
}
?>