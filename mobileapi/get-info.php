<?php
require_once('../config.inc.php');
require_once('../function.php');
$dataJSON = file_get_contents('php://input');
$data = json_decode($dataJSON, TRUE); 

$array=array("houseSittingCharges"=>"250",
             "petSittingCharges"=>"300",
             "moreThanSevenNights"=>"10",
             "moreThanTenNights"=>"15",
);

header('Content-type: application/json');
echo json_encode(array("status"=>"true","data"=>$array,"message"=>"Information data"));


?>