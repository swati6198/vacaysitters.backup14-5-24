<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
$cnt=0;
if($data)
{
    foreach($data['ansdata'] as $val)
     {

    $sql1 = "INSERT INTO rating(ratingUserid, ratingSitterid, ratingBookingid,ratingPromptid, ratingCount, ratingComment,ratingGivenby,ratingGivenFor) 
            VALUES('".$data['userID']."', '".$data['sitterID']."', '".$data['bookingID']."', '".$val['id']."', '".$val['ratingCount']."', '".$val['ratingComment']."', 'User', '".$val['ratingGivenFor']."')";
    $statement1 = queryMysql($sql1);
    $sum=$sum+$val['ratingCount'];
    $cnt++;
    }
    $avg=round($sum/$cnt,2);
   
    $query="SELECT * from booking where bookingsSitterid='".$data['sitterID']."' AND bookingStatus='Completed'  ORDER BY bookingEnddate DESC  ";
    $stmtchk=queryMysql($query);
    $flag=1;
    $row_allr = $stmtchk->fetchall(PDO::FETCH_ASSOC);
    $cntr=0;
    foreach ($row_allr as $row_all_OBJ)
    {
        if($row_all_OBJ['bookingRating']==5)
        {
            if($cntr==4)
            {
                break;
            }
            else{
                  $cntr++;
            }
        }
        else
        {
            $cntr=0;
        }
    }
   
   
    if($cntr==4 && $avg>=5)
    {
        $upsql1="UPDATE sitter SET sitterGold='1' where sitterID='".$data['sitterID']."'";
        $upstmt1 = queryMysql($upsql1);
    }
    $upsql="UPDATE booking SET bookingRating='".$avg."' where bookingID='".$data['bookingID']."'";
    $upstmt = queryMysql($upsql);
    header('Content-type:application/json;charset=utf-8');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"Rating Added")); 
}
else
{
    header('Content-type:application/json;charset=utf-8');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Not Added")); 
}
?>