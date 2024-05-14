<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

 $sql1 = "UPDATE sitter SET sitterPlatform_os='".$data['sitterPlatform']."', sitterFcmtoken='".$data['sitterFcmtoken']."' WHERE sitterID='".$data['sitterID']."'";
        $statement1 = queryMysql($sql1);


$sql = "SELECT * FROM sitter WHERE sitterID='".$data['sitterID']."'";

$statement = queryMysql($sql);

if($statement->rowCount())
{
    $row_all = $statement->fetch(PDO::FETCH_ASSOC);
    if($row_all['sitterStatus']==1)
    {    
         $sqlR = "SELECT COUNT(bookingID) As total_number FROM booking  WHERE bookingsSitterid='".$data['sitterID']."' AND bookingStatus='Completed'";
            $statementR = queryMysql($sqlR);
            $row_allR = $statementR->fetch(PDO::FETCH_ASSOC);
            
            
               $sqlRR = "SELECT SUM(transactionsAmount) AS total_earning FROM transaction  WHERE transactionsUserID='".$data['sitterID']."' AND transactionsTypeID='Sitter' AND ( transactionsType='Referral' OR transactionsType='Referral Payout')";
            $statementRR = queryMysql($sqlRR);
            $row_allRR = $statementRR->fetch(PDO::FETCH_ASSOC);
            
            $qry="SELECT fromdate as bookingStartdate,todate as bookingEnddate FROM sitternotavail WHERE sitterID='".$data['sitterID']."' ";
            $statementSt= queryMysql($qry);
            $row_allSt = $statementSt->fetchall(PDO::FETCH_ASSOC);
            $row_all['dates'] =  $row_allSt;
            
            $qry="SELECT * FROM endorsement WHERE sitterID='".$data['sitterID']."' ";
            $statementSt= queryMysql($qry);
            $row_allSt = $statementSt->fetchall(PDO::FETCH_ASSOC);
            $row_all['endorsement'] =  $row_allSt;
            
            
            $row_all['totalEarning']=$row_allRR['total_earning']==NULL?'0':$row_allRR['total_earning'];
            $row_all['totalJobsdone']=$row_allR['total_number'];
            
              $query="SELECT * from booking where bookingsSitterid='".$data['sitterID']."' AND bookingStatus='Completed'  ORDER BY bookingEnddate DESC  ";
    $stmtchk=queryMysql($query);
    $flag=1;
    $row_allr = $stmtchk->fetchall(PDO::FETCH_ASSOC);
    $cnt=0;
    foreach ($row_allr as $row_all_OBJ)
    {
        if($row_all_OBJ['bookingRating']==5)
        {
            if($cnt==5)
            {
                break;
            }
            else{
               
                  $cnt++;
            }
        }
        else
        {
            $cnt=0;
        }
    }
   
     $row_all['ratingprogress']=$cnt;
            
            
            
       
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>""));
    }
    else if($row_all['sitterStatus']==0){
    
    header('Content-type: application/json');
    echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>"Account is inactive, Please contact support to activate account!"));
    
    }
    else{
         header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>$row_all,"message"=>"Account has been deleted"));
    }
  
}else{
   
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Account does not exists"));
    
    
}
  
    

?>