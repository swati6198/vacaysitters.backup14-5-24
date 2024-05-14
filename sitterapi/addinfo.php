<?php
require_once('../config.inc.php');
require_once('../function.php');

$data=$_POST;
 $targetDir = "../img/"; 
$fileName = basename($_FILES['file']['name']); 
$targetFilePath = $targetDir.$fileName;    
move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);


$fileName1 = basename($_FILES['sitterVideointerview']['name']); 
$targetFilePath1 = "../img/Sitter-VideoIntro/".$fileName1;    
move_uploaded_file($_FILES['sitterVideointerview']['tmp_name'], $targetFilePath1);

    $sql = "UPDATE sitter SET
                       sitterMobileno= '" .$data["sitterMobileno"] ."', 
                       sitterGender= '" .$data["sitterGender"] ."', 
                        sitterDocumenturl='".$targetFilePath."',
                        sitterDocumentno='".$data['sitterDocumentno']."',
                       sitterDocumentname= '".$data['sitterDocumentname']."',
                        sitterExperiancewith='" .$data["sitterExperiancewith"] ."',
                        sitterWorkstatus='" .addslashes($data["sitterWorkstatus"]) ."',
                        sitterHavevisa='" .$data["sitterHavevisa"] ."',
                        sitterSkills='" .addslashes($data["sitterSkills"]) ."',
                        sitterHavetransport='" .$data["sitterHavetransport"] ."',
                         sitterBio='".$data['sitterBio']."',
                         sitterWantto='".$data['sitterWantto']."',
                         sitterIssmoker='".$data['sitterIssmoker']."',
                         sitterCriminalrecord='".$data['sitterCriminalrecord']."',
                         sitterVideointerview='".$targetFilePath1."'
                        WHERE sitterID='".$data['sitterID']."'";
                     
    $statement = queryMysql($sql);

   
        $sql2 ="SELECT * FROM sitter WHERE sitterID='" . $data["sitterID"] . "'";
        $statement2 = queryMysql($sql2);
            $row_all = $statement2->fetch(PDO::FETCH_ASSOC);
            header("Content-type:application/json;charset=utf-8");
            echo json_encode(["status" => "true", "data" => $row_all,"message"=>"Information added"]);
   


?>











