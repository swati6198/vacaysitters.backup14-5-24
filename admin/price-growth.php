 <?php 

  $page = "Price Growth";
session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }

  include("include/global.php");


  if(isset($_POST['savedata']))
  {

/*
      if($_REQUEST['percentage'] !=''){
         $selectRole = "SELECT * FROM services order by  serviceID DESC";
     $fireRole = mysqli_query($connect, $selectRole);
     while ($rowRole = mysqli_fetch_array($fireRole)){
           $newamt = ($_REQUEST['percentage'] / 100) * $rowRole['servicePrice'];
           $newpricem = $rowRole['servicePrice'] + $newamt;
            $newamtd = ($_REQUEST['percentage'] / 100) * $rowRole['serviceDiscountprice'];
           $newpriced = $rowRole['serviceDiscountprice'] + $newamtd;

              $insert1 ="update services set                 
              servicePrice   = '".round($newpricem)."',
              serviceDiscountprice   = '".round($newpriced)."'
               where serviceID ='".$rowRole['serviceID']."' ";  

              $result=mysqli_query($connect,$insert1) or die(mysqli_error());
            }


                $selectRole1 = "SELECT * FROM comboservices order by  comboserviceID DESC";
     $fireRole1 = mysqli_query($connect, $selectRole1);
     while ($rowRole1 = mysqli_fetch_array($fireRole1)){
          $newamts = ($_REQUEST['percentage'] / 100) * $rowRole1['comboservicePrice'];
           $newpricems = $rowRole1['comboservicePrice'] + $newamts;
            $newamtds = ($_REQUEST['percentage'] / 100) * $rowRole1['comboserviceDiscountprice'];
           $newpriceds = $rowRole1['comboserviceDiscountprice'] + $newamtds;


              $insert11 ="update comboservices set                 
              comboservicePrice   = '".round($newpricems)."',
              comboserviceDiscountprice   = '".round($newpriceds)."'
               where comboserviceID ='".$rowRole1['comboserviceID']."' ";  

              $result2=mysqli_query($connect,$insert11) or die(mysqli_error());
            }
*/


                  header("location:price-growth.php?msg=u");

        //  }

  }



 if($_REQUEST['msg'] == "u"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Price Change Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
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
                    <li class="breadcrumb-item"><?php echo $page; ?></li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
             <?php echo $msgs; ?>
             <div class="container-fluid">

              <div class="row">
          
              <div class="col-sm-12">
                
                <div class="card">
                 <div class="card-header">

                      <div class="header-top">
                          <h5 class="pull-left">Add <?php echo $page; ?></h5>
                          
                      </div>
                  </div>
                  <div class="card-body">
                     <div class="col-sm-12">
                    <div class="card">
                     
                      <div class="card-body">
                        <form class="theme-form" action="" method="post" enctype="multipart/form-data">
                         
                            <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Percentage <span class="text-danger">*</span> </label>
                              <div class="col-sm-9">
                              <input class="form-control" type="number" required placeholder="Percentage" name="percentage" id="Percentage" value="">
                             
                            </div>
                              
                            </div>

                           

                        
                            <div class="card-footer  text-center">
                            <button class="btn btn-primary"  type="submit" name="savedata"><span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit</button>
                           
                            </div>
                           
                        </form>
                      </div>
                     
                    </div>
                  </div>
                  </div>
                </div>
              </div>
          </div>
          
                <div class="modal fade" id="exampleModalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Message</h5>
                                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>  
                                      <div class="modal-body text-danger" style="text-align:center;">
                                     Please select image  less than 2 MB
                                      </div>
                                    </div>
                                  </div>
                                </div>
             </div>

           </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>



<script>
   $(() => {
  $('button').on('click', e => {
    let spinner = $(e.currentTarget).find('span')
    spinner.removeClass('d-none')
    setTimeout(_ => spinner.addClass('d-none'), 10000)
  })
})
</script> 


<?php if($_REQUEST['lid']) { ?>
 <style type="text/css">

    .show{
        display: none;
    }
    </style>
 <?php }else{  ?>
  <style type="text/css">

 .show{
        display: block;
    }
    </style>
  <?php }  ?>
</style>   



<style>
    .myDiv{
        display: none;
    }
    
</style>        
 <?php include("include/footer.php"); ?>
