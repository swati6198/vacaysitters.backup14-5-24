<?php
require_once('../config.inc.php');
require_once('../function.php');

$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 
if($data)
{
     $query="SELECT * from sitternotavail where sitterID='".$data['sitterID']."' ";
    $stmtchk=queryMysql($query);
   
    if($stmtchk->rowCount()>0)
    {
          $sql44 = "UPDATE sitternotavail SET fromdate='".$data['fromdate']."', todate='".$data['todate']."' WHERE sitterID='".$data['sitterID']."'";
        $statement44 = queryMysql($sql44);
    }
    else{
        
          $sql44 = "INSERT INTO  sitternotavail SET fromdate='".$data['fromdate']."', todate='".$data['todate']."' , sitterID='".$data['sitterID']."'";
        $statement44 = queryMysql($sql44);
    }

    header('Content-type:application/json;charset=utf-8');
    echo json_encode(array("status"=>"true","data"=>"","message"=>"Availability updated successfully"));
}
else
{
    header('Content-type:application/json;charset=utf-8');
    echo json_encode(array("status"=>"false","data"=>"","message"=>"Oops something went wrong"));
}


?>