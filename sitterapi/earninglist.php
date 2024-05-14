<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
$sql = "SELECT * FROM transaction WHERE transactionsUserID='".$data['sitterID']."' AND transactionsTypeID='Sitter' AND ( transactionsType='Referral' OR transactionsType='Referral Payout')";

$statement = queryMysql($sql);

if($statement->rowCount())
{
    $row_all = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("status"=>"true","data"=>$row_all,"message"=>""));
    
}else{
   
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Data not found"));
    
    
}
  
    

?>