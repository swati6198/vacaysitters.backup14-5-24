<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
$sql = "SELECT * FROM paymentresponse WHERE userID='".$data['userID']."'";
$statement = queryMysql($sql);

if($statement->rowCount())
{
    $row_all = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($row_all as $val)
    {
        $data_arr[]=array("ID"=>$val['paymentresponseID'],
                        "payment"=>json_decode($val['payment']),
                        "paymentdate"=>$val['paymentDate']);
        
    }
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array("status"=>"true","data"=>$data_arr,"message"=>"Payment list"));
    
}else{
   
    header('Content-type: application/json');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Data not found"));
    
    
}
  
    

?>