<?php
 $page = "Boking Details";
session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }
  include("include/global.php");
   $selectUser = mysqli_query($connect, "SELECT * FROM `booking` co
    WHERE bookingID='".$_REQUEST['bookingID']."'");
      $n=1;
while ($rowBD = mysqli_fetch_array($selectUser))
{
    $List ='
                   <tr><td>1</td><td>Booking Added At </td><td>'.$rowBD['bookingDate'].'</td></tr>
                    <tr><td>2</td><td>Booking Accepted At </td><td> '.$rowBD['bookingAccepteddate'].'</td></tr>
                    <tr><td>3</td><td>Booking Start Date </td><td> '.$rowBD['bookingStartdate'].'</td></tr>
                     <tr><td>5</td><td>Booking End Date </td><td> '.$rowBD['bookingEnddate'].'</td>
                    <tr><td>4</td><td>Sitter Checked In </td><td> '.$rowBD['bookingCheckedin'].'</td></tr>
                   <tr><td>6</td><td>Sitter Checkout At </td><td>'.$rowBD['bookingCheckout'].'</td>';
    if($rowBD['bookingCancelledby'])
    {
        $List.= '<tr><td>7</td><td> Booking Cancelled By </td><td>'.$rowBD['bookingCancelledby'].'</td>
                <tr><td>8</td><td> Booking Cancelled At </td><td>'.$rowBD['bookingCanceltimes'].'</td>';
    }
}
                     
 include("include/header.php");
?>

 <div class="page-body">
             <div class="container-fluid">
              <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                  </ol>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="dashboard.php" data-bs-original-title="" title="">Home</a></li>
                    <li class="breadcrumb-item"> <?php echo $page; ?> List</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
             <div class="container-fluid">
              <div class="row">
              <div class="col-sm-12">
               <?php echo $msgs; ?>
                <div class="card">
                 <div class="card-header">
                      <div class="header-top">
                          <h5 class="pull-left"><?php echo $page; ?> List</h5>
                          <div class="pull-right">
                          </div>
                      </div>
                  </div>  
                 
                  <div class="card-body">
                    <div class="table-responsive">
            <table class="display" id="basic-1">
                        <thead> 
                          <tr>
                          <th>#ID</th>
                          <th>Booking Step</th>
                          <th>Details</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                         <?php echo $List; ?>
     
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
             </div>
             </div>
           </div>
 <?php include("include/footer.php"); ?>