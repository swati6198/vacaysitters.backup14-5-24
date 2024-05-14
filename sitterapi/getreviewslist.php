<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

if($data['sitterID'])
{

            $sqlR2 = "SELECT ratingBookingid,userFirstname,userLastname,userID FROM rating INNER JOIN user ON user.userID=rating.ratingUserid WHERE rating.ratingGivenby='USER' AND  rating.ratingSitterid='".$data['sitterID']."'   group by ratingBookingid";
            $statementR2 = queryMysql($sqlR2);
            $row_allR2 = $statementR2->fetchall(PDO::FETCH_ASSOC);
            if($row_allR2!=NULL)
            {
                foreach ($row_allR2 as $row_all_OBJ)
                {
                      $sqlR22 = "SELECT *  FROM rating  WHERE rating.ratingGivenby='USER' AND  rating.ratingSitterid='".$data['sitterID']."' AND rating.ratingUserid='".$row_all_OBJ['userID']."'";
                    $statementR22 = queryMysql($sqlR22);
                    $row_allR22 = $statementR22->fetchall(PDO::FETCH_ASSOC);
                    $arr[]=array("ratingBookingid"=>$row_all_OBJ['ratingBookingid'],
                                "userFirstname"=>$row_all_OBJ['userFirstname'],
                                "userLastname"=>$row_all_OBJ['userLastname'],
                                "rating"=>$row_allR22,
                    );
                  
                }
                header('Content-type:application/json;charset=utf-8');
                echo json_encode(array("status"=>"true","data"=>$arr,"message"=>"Reviews list"));
            }
            else
            {
                header('Content-type:application/json;charset=utf-8');
                echo json_encode(array("status"=>"false","data"=>"","message"=>"No reviews yet"));
            }
}
else{
    header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("status"=>"false","data"=>"","message"=>"Oops somthing is missing"));
}