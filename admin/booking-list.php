 <?php 
  
 $page = "Bokings";
session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }

  include("include/global.php");
  //include("sendmail.php");

 if(isset($_POST['Schange']))
  {    
    if($_REQUEST['bstatus']=='Cancelled')
    {
         $query="update `booking` set `bookingStatus`  = '".$_REQUEST['bstatus']."' , bookingCancelledby='Admin' , bookingsStatusRemark='".$_REQUEST['reason']."'  where bookingID  ='".$_REQUEST['bookingID']."'"; 
    }
    else{
         $query="update `booking` set `bookingStatus`  = '".$_REQUEST['bstatus']."'  where bookingID  ='".$_REQUEST['bookingID']."'"; 
    }
    
   
    mysqli_query($connect,$query);
    
    $bsql="SELECT * FROM bookings 
      JOIN users ON bookings.userId=user.bookingUserid 
       JOIN sitters ON sitters.sitterID=tm_bookings.bookingSitterid 
      JOIN tm_service ON tm_service.serviceID=tm_bookings.bookingsServiceid
      JOIN tm_bookingdetails ON tm_bookings.bookingID=tm_bookingdetails.bookingdetailBookingid 
      WHERE tm_bookings.bookingID=".$_REQUEST['bookingID'];
     $bstatement =  mysqli_query($connect,$bsql);
     
      while($bval = mysqli_fetch_assoc($bstatement))
    {
     
         $username=$bval['userFirstName'];
         $orderdate=$bval['bookingDate'].' '.$bval['bookingTime'];
          $productlist .='<p>Service :&nbsp;&nbsp;&nbsp;&nbsp;'.$bval['serviceName'].' </p>';
        
    }
      header("location:booking-list.php?msg=c");
  }
 
   if(isset($_POST['seacrhdata']))
   {
       $cond='WHERE  ';
     $sdate =  $_REQUEST['startDate'].' 00:00:00';
     $edate = $_REQUEST['endDate'].' 00:00:00';
     if($_REQUEST['taskstatus'])
     {
         $cond.=" bookingStatus ='".$_REQUEST['taskstatus']."'  ";
     }
     
     if($_REQUEST['taskstatus'] && $_REQUEST['startDate'] && $_REQUEST['endDate'])
     {
         $cond.='AND ';
     }
     
     if($_REQUEST['startDate'] && $_REQUEST['endDate'])
     {
        $cond.= " DATE_FORMAT(bookingDate, '%Y-%m-%d') >= '".$_REQUEST['startDate']."' AND DATE_FORMAT(bookingDate, '%Y-%m-%d') <= '".$_REQUEST['endDate']."'";
     }
     $selectUser = mysqli_query($connect, "SELECT * FROM `booking` co 
        JOIN `user` cc ON co.bookingUserID = cc.userId JOIN
        `sitter` vc ON co.bookingsSitterid = vc.sitterID  ".$cond."
        ORDER BY co.bookingID DESC");
   }
   else{
        $selectUser = mysqli_query($connect, "SELECT * FROM `booking` co
        JOIN `user` cc ON co.bookingUserID = cc.userId JOIN
        `sitter` vc ON co.bookingsSitterid = vc.sitterID 
    ORDER BY co.bookingID DESC");
   }
   
    $n=0;
    while($rowRole = mysqli_fetch_assoc($selectUser))
    {
       
    $imgtxt='';
    $imgtxt1='';
    if($rowRole['bookingStatus'] == 'Pending')
    {
        
            $st='<span class="btn btn-sm bg-danger">Pending</span>';
          }else if($rowRole['bookingStatus'] == 'Completed'){
            $st='<span class="btn btn-sm bg-success">Completed</span>';
          }else{
            $st='<span class="btn btn-sm bg-warning">Cancelled</span>';
          }
          $coupon_amt=0;
          
          $coupon_amt=$rowRole['bookingSubtotalamt']-$rowRole['bookingTotalamt'];
          
          if($rowRole['bookinguserHID']!='')
          {
              $hsql = "SELECT * FROM tm_userhealthprofile WHERE userHID ='".$rowRole['bookinguserHID']."'";
           
              $selectHUser = mysqli_query($connect,$hsql);
              $rowHRole = mysqli_fetch_assoc($selectHUser);
              
               $img_arr=json_decode($rowHRole['userHReports']);
      
                for($j=0;$j<count($img_arr);$j++)
                {
                    $cn=$j+1;
                    $imgtxt.=' <a href="'.$img_arr[$j].'"><img src="'.$img_arr[$j].'" height="200px" width:"200px;padding-right:30px""></a>';
                }
                 $img_arr1=json_decode($rowRole['bookingRemarkImages']);
                for($j=0;$j<count($img_arr1);$j++)
                {
                    $cn=$j+1;
                    $imgtxt1.=' <a href="'.$img_arr1[$j].'"><img src="'.$img_arr1[$j].'" height="200px" width:"200px;padding-right:30px""></a>';
                }
          }
      $n++; 
       $List .='<tr>
                  <td>'.$n.'</td>
                  <td><a href="booking-details.php?bookingID='.$rowRole['bookingID'].'">'.$rowRole['bookingUid'].'</a></td>
                   <td>'.$rowRole['userFirstname'].' '.$rowRole['userLastname'].'</td>
                  <td>'.$rowRole['sitterFirstname'].' '.$rowRole['sitterLastname'].'</td>
                   <td>'.$rowRole['bookingtType'].'</td>
                    <td>'.$rowRole['bookingDate'].' '.$rowRole['bookingTime'].'</td> 
                     <td>R '.$rowRole['bookingTotalamt'].'</td>       
                 <td>'.$rowRole['bookingPaymentType'].'</td>
                   <td>'.$rowRole['bookingPaymentstatus'].'</td>
                   <td>';
                   if($rowRole['bookingBankRefNo']==0){$List.= '-';} else{ $List.=$rowRole['bookingBankRefNo']; }
                   
                   $List.='</td>
                    <td>'.date('d-m-Y ', strtotime($rowRole['bookingDate'])).'</td><td>';
                    
                    if($rowRole['bookinguserHID']!='')
                    {
                        $List.='
              <button class="btn btn-category" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalq-'.$n.'" style="width: 97px !important; " data-bs-original-title="" title=""><span class="title" style="font-size:13px !important;">Health Profile</span></button>
                       <div class="modal fade"  id="exampleModalq-'.$n.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                  <div class="modal-dialog"  style="max-width: 80%;" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Health Profile</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>  
                                      <div class="modal-body">
      <section style="background-color: #eee;">
  <div class="container py-5">                                
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Patient Name : </h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$rowHRole['userHName'].'</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Gender : </h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$rowHRole['userHGender'].'</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Weight (KG): </h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$rowHRole['userHWeight'].'</p>
              </div>
            </div> <hr>
            <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Height (Feet): </h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$rowHRole['userHHeight'].'</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Doctor Name : </h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$rowHRole['userHDoctorName'].'</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Diseses : </h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$rowHRole['userHDisease'].'</p>
              </div> <hr>
            </div>
         
             <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Medicines : </h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$rowHRole['userHMedicine'].'</p>
              </div>
            </div> <hr>
          
             <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Reports</h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$imgtxt.'</p>
              </div>
            </div> <hr> 
          </div>
        </div>
       
      </div>
    </div>
  </div>
</section>
</div></div></div></div></section>';
                    }
                    $List.=' <button class="btn btn-category bg-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalq1-'.$n.'" style="width: 97px !important; " data-bs-original-title="" title=""><span class="title" style="font-size:13px !important;">Remark</span></button>
               
               <div class="modal fade"  id="exampleModalq1-'.$n.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                  <div class="modal-dialog"  style="max-width: 50%;" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Remarks / Reciepts :</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>  
                                      <div class="modal-body">
      <section style="background-color: #eee;">
  <div class="container py-5">                                
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Remark  : </h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$rowRole['bookingsStatusRemark'].'</p>
              </div>
            </div>
            <hr>
          
              <div class="row">
              <div class="col-sm-2">
                <h6 class="mb-0">Remark Images :</h6>
              </div>
              <div class="col-sm-10">
                <p class="text-muted mb-0">'.$imgtxt1.'</p>
              </div>
            </div> <hr> 
          </div>
        </div>
       
      </div>
    </div>
  </div>
</section>
</div></div></div></div></section>
               </td>';
                       
               $List.='<td>'.$st.'</td>
              
               
               <td> <div class="card-body dropdown-basic">
                    <div class="dropdown">
                      <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Dropdown<span><i class="icofont icofont-arrow-down"></i></span></button>
                      <div class="dropdown-content">
        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal3-'.$n.'" class="dropdown-item">Status</a>
        '.$actsd.'
   </div>
                      </div></div>

<div class="modal fade" id="exampleModal3-'.$n.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Status</h5>
                                        <a class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></a>
                                       </div>  
                                      <div class="modal-body">
                     <div class="col-sm-12">
                    <div class="card">
                     
                      <div class="card-body">
                        <form class="theme-form" onsubmit="return active_status(this);" action="" method="post" enctype="multipart/form-data">

                       <div class="mb-3 row">
                             <label class="col-sm-3 col-form-label">Status</label>
                              <div class="col-sm-12">
                        
                              <input type="hidden" name="bookingID" value="'.$rowRole['bookingID'].'">
                                <select class="js-example-basic-single col-sm-12 bstatus"  required="" name="bstatus" id="bstatus">
                                <option value="">Please select </option>
                               <option value="Pending">Pending</option>
                              <option value="Completed">Completed</option>
                              <option value="Cancelled">Cancelled</option>
                              </select>
                              
                         </div>
                         </div>
                          <div class="mb-3 row reason "  id="reason">
                           <label class="col-sm-3 col-form-label">Reason</label>
                                <div class="col-sm-12">
                             <textarea class="form-control"  type="text" name="reason" id=""> </textarea>
                              
                         </div>
                          </div>
                            <div class="card-footer  text-center">
                            <button class="btn btn-primary"  type="submit" name="Schange"><span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  </div></div>
                                    </div>
                                  </div>
                                </div> 


                      </td>  
                      
                  </tr>';

           $List2="";        
           
           
    }  
 include("include/header.php");
 if($_REQUEST['msg'] == "c"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center"><?php echo $page; ?> Created Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }

 if($_REQUEST['msg'] == "u"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center"><?php echo $page; ?> Update Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }

    if($_REQUEST['msg'] == "c"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Order Status Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
  }

   
  ?>

 <div class="page-body">
             <div class="container-fluid">
              <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                    
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
                  <div class="card-header">
                        <form method="post" action="booking-list.php">
                      <div class="row">
<div class="col-md-3 form-group">
                    <label for="fName">Booking Status</label>
               <select  class="form-control" name="taskstatus" id="taskstatus">
                <option value="">Please Select </option>
                  <option value="Completed" <?php if ($_REQUEST['taskstatus'] == "Completed" ){ echo "selected";}else{echo "";} ?>>Completed</option>
                    <option value="Pending" <?php if ($_REQUEST['taskstatus'] == "Pending" ){ echo "selected";}else{echo "";} ?>>Pending</option>
                     <option value="Cancelled" <?php if ($_REQUEST['taskstatus'] == "Cancelled" ){ echo "selected";}else{echo "";} ?>>Cancelled</option>
               </select>

                  </div>

                 
    <div class="col-md-3 form-group">
                    <label for="fName">Start Date</label>
                  <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" value="<?php echo isset($_REQUEST['startDate'])?$_REQUEST['startDate']:''; ?>">
                  </div>           
 <div class="col-md-3 form-group">
                    <label for="fName">End Date</label>
                  <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date"  value="<?php echo isset($_REQUEST['endDate'])?$_REQUEST['endDate']:''; ?>">
                  </div>
                  <div class="col-md-3 form-group" style="margin-top: 25px !important;">
                     <button type="submit" class="btn btn-primary" style="width: 155px !important;" id="searchData" name="seacrhdata">Submit</button>
                  </div>  
                  </div>
                  </form>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                                                
            <table class="display" id="basic-1">

                        <thead> 
                          <tr>
                          <th>#ID</th>
                          <th>Booking ID</th>
                          <th>User</th>
                          <th>Sitter</th>
                             <th>TYPE</th>
                          <th>Booked For</th>
                          <th>Total Amt</th>
                          
                          <th>Payment Mode</th>
                          <th>Payment Status</th>
                           <th>Payment ID</th>
                          <th>Added Date</th>
                          <th>More Details</th>
                          <th>Booking Status</th>
                          
                          <th>Action</th>
                          
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

   <script language="javascript" type="text/javascript">
    $(document).ready(function() 
{
    $('.reason').hide();

$('.bstatus').on('change', function()
{
        var status = $(this).val();
       if(status=='Cancelled')
       {
           $('.reason').show();
       }
        else{
              $('.reason').hide();
        }
});
        
        
});
function active_status()
{
  var t=confirm("Are you sure you want to change the order status ?");
  if (t)
    {
      return true;
    }
  else
    {
      return false;
    }
}
 


</script>        
 <?php include("include/footer.php"); ?>
