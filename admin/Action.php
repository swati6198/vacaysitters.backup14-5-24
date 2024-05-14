 <?php


  include("include/global.php");



  if($_POST['action'] == "Update"){

  	$status = substr($_POST['table'].'Status='.$_POST['status'],0,100);
  
  	$id = substr($_POST['table'].'ID='.$_POST['id'],0,100);

  	     $query="update ".$_POST['table']." set ".$status."  where ".$id."";
  	     
  	     
        mysqli_query($connect,$query);
  
  
  }else if($_POST['action'] == "Delete"){

  	$id = substr($_POST['table'].'ID='.$_POST['id'],0,100);

  	  $query3="delete from ".$_POST['table']." where ".$id."";
     $row3 = mysqli_query($connect,$query3);
     
  }

else if($_POST['action'] == "ApproveSitter"){

  	$status = "sitterIsapproved='1'";
  
  	$id = substr($_POST['table'].'ID='.$_POST['id'],0,100);

  	     $query="update ".$_POST['table']." set ".$status."  where ".$id."";
  	     
  	     
        mysqli_query($connect,$query);
     
  }





?>