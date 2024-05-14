<?php 
 
 $page = "Booking Details";
session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }

  include("include/global.php");





   $selectUser = mysqli_query($connect, "SELECT * FROM `booking` co
        JOIN `user` cc ON co.bookingUserID = cc.userID JOIN
        `sitter` vc ON co.bookingsSitterid = vc.sitterID 
    WHERE bookingID='".$_REQUEST['bookingID']."'");

      $n=1;



while ($rowBD = mysqli_fetch_array($selectUser))
{
 /*   echo "<pre>";
       print_r($rowBD);die;*/
      $List .='<tr>
                  <td>'.$n.'</td>
                   <td>'.$rowBD['userLookingFor'].'</td>
                   <td>R '.$rowBD['bookingdetailSeriviceprice'].'</td>
                   <td>R '.$rowBD['bookingdetailSeriviceprice'].'</td>
                  </tr>';
   include("include/header.php");
?>
 <div class="page-body">
             <div class="container-fluid">
              <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}" data-bs-original-title="" title="">Home</a></li> -->
                    <!-- <li class="breadcrumb-item">@yield('page_title')</li> -->
                    
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
                          <h5 class="pull-left"><?php echo $page; ?></h5>
                          <div class="pull-right">
                       
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                     <div class="row card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 text-nowrap">
                                                <tbody><tr style="font-size: 20px;">
                                                    <th>Booking ID :- <?php echo $rowBD['bookingUid']; ?></th>
                                                    <th>User Name :- <?php echo ucfirst($rowBD['userFirstName']) .' '.ucfirst($rowBD['userLastName']); ?></th>


                                                </tr>
                                                <tr>
                                                   <td><strong>Sitter :-</strong> <?php echo ucwords($rowBD['sitterFirstname']); ?></td>
                                                   <td><strong>User Phone :-</strong> <?php echo $rowBD['sitterMobileno']; ?></td>
                                                </tr>
                                                <tr> 
                                                    <td><strong>Address :-</strong> 
                                                    <?php
                                                  
                                                        echo $rowBD['userAddress'];
                                                    
                                                     ?></td>
                                                </tr>
                                                <tr> 
                                                    <td><strong>Booking Date :-</strong> <?php echo $rowBD['bookingDate']; ?></td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table border table-bordered text-nowrap">
                      <thead>
                        <tr>
                          <td>#ID</td>
                          <th class="wd-20p">Service </th>
                          
                          <th class="wd-20p">Price</th>
                         <th class="wd-20p">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php echo $List; ?>
                     </tbody>
                       <tfoot>
                     
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="1">Sub Total Amount:</td>
                            <td>R <?php echo  round($rowBD['bookingSubtotalamt']); ?></td>
                        </tr>
                           

                 <?php if($rowBD['bookingCoupon'] !=''){ ?>
                                      <tr>
                                        <td colspan="2"></td>
                                        <td colspan="1">Coupon Discount:</td>
                                        <td>R <?php echo round($rowBD['bookingDiscountamt']); ?></td>
                                    </tr>
                                <?php } ?>


                          <tr>
                           <td colspan="2"></td>
                            <td colspan="1">Total Amount:</td>
                            <td>R <?php echo  round($rowBD['bookingTotalamt']); ?></td>
                        </tr>

                      
                       
                    </tfoot>
                    </table>
                  </div>
                 
                  </div>
                  </div>
                </div>
              </div>
          </div>
          
          
          
          
          
               
             </div>

           </div>

<?php 
}
 include("include/footer.php");

?>