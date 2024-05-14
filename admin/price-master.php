<?php 
       $page = "Price Master";
   
  
  include("include/global.php");



     $selectRole = "SELECT * FROM setting";
     $fireRole = mysqli_query($connect, $selectRole);
       while ($rowRole = mysqli_fetch_array($fireRole)) 
        {
          
          if($rowRole['settingName']=='petsittingCharges')
         {
             $petsittingCharges=$rowRole['settingValue'];
         }
          if($rowRole['settingName']=='housesittingCharges')
         {
             $housesittingCharges=$rowRole['settingValue'];
         }
         
     }
 

 if(isset($_POST['savedata']))
  {

         $insert11 ="update setting set                 
              settingValue   = '".$_POST['housesittingCharges']."'
               where settingName ='housesittingCharges' ";  
               
          
              $result2=mysqli_query($connect,$insert11) or die(mysqli_error($connect));
              $insert2 ="update setting set                 
              settingValue   = '".$_POST['petsittingCharges']."'
               where settingName ='petsittingCharges' ";  
              $result3=mysqli_query($connect,$insert2) or die(mysqli_error($connect));
              header("location:price-master.php?msg=u");

  }

 if($_REQUEST['msg'] == "u"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Values Updated Successfully</strong>
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
                    <li class="breadcrumb-item"><?php echo  $page; ?>  list</li>

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
                          <h5 class="pull-left"> <?php echo  $page; ?> </h5>
                          
                      </div>
                  </div>
                  <div class="card-body">
                     <div class="col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <form class="theme-form needs-validation" action="" method="post" enctype="multipart/form-data" novalidate>
                           
                            <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">House Sitting per night charges in R.<span class="text-danger">*</span></label>
                              <div class="col-sm-9">
                              <input class="form-control"  required type="text" placeholder="" name="petsittingCharges" id="petsittingCharges" value="<?php echo $petsittingCharges;?>">
                              <div class="invalid-feedback">Please provide a valid amount.</div>
                            </div>
                            </div>
                               <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Pet Sitting per night charges in R.<span class="text-danger">*</span></label>
                              <div class="col-sm-9">
                              <input class="form-control"  required type="number" placeholder="" name="housesittingCharges" id="housesittingCharges" value="<?php echo $housesittingCharges;   ?>">
                              <div class="invalid-feedback">Please provide a valid amount.</div>
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
         
               
             </div>

           </div>

            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>



<script>
   $(() => {
  $('button').on('click', e => {
    let spinner = $(e.currentTarget).find('span')
    spinner.removeClass('d-none')
    setTimeout(_ => spinner.addClass('d-none'), 10000)
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
Array.prototype.slice.call(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })

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
 
 <?php include("include/footer.php"); ?>
