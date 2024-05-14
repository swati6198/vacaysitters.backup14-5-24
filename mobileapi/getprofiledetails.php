<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

$sql = "SELECT * FROM user WHERE userID='".$data['userID']."'";

$statement = queryMysql($sql);

if($statement->rowCount())
{
    $row_all = $statement->fetch(PDO::FETCH_ASSOC);
    if($row_all['userStatus']==1)
    {    
        $query = "SELECT SUM(transactionsAmount) as total_earning  FROM transaction WHERE transactionsUserID='".$data['userID']."' AND transactionsTypeID='User' AND transactionsType='Referral'";
        
        $query_data=queryMysql($query);
        $data=$query_data->fetch(PDO::FETCH_ASSOC);
        
      $row_all['total_earning']=$data['total_earning'];
     //  $row_all['total_earning']=10;
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>""));
    }
    else{
    
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Account is inactive or deleted, Please contact support to activate account!"));
    
    }
  
}else{
   
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Account does not exists"));
    
    
}
  
    

?>