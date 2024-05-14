<?php 
       $page = "Coupon";
   
  
  include("include/global.php");

if($_REQUEST['lid'] !=''){

     $selectRole = "SELECT * FROM coupon WHERE couponID ='".$_REQUEST['lid']."'";
     $fireRole = mysqli_query($connect, $selectRole);
     $rowRole = mysqli_fetch_array($fireRole);
  }

 if(isset($_POST['savedata']))
  {


      if($_REQUEST['lid'] !=''){

            $insert1 ="update  coupon set                 
                    couponTitle   = '".addslashes($_REQUEST['couponTitle'])."',
                    couponMinamt   = '".$_REQUEST['couponMinamt']."',
                    couponMaxamt   = '".$_REQUEST['couponMaxamt']."',
                    couponPercent   = '".$_REQUEST['couponPercent']."',
                    couponLimit   = '".$_REQUEST['couponLimit']."'
                 where couponID  ='".$_REQUEST['lid']."'";  

              $result=mysqli_query($connect,$insert1) or die(mysqli_error());
              header("location:coupon-list.php?msg=u");
            }else{ 


             $insert1 ="insert into coupon set   
                    couponTitle   = '".addslashes($_REQUEST['couponTitle'])."',
                    couponMinamt   = '".$_REQUEST['couponMinamt']."',
                    couponMaxamt   = '".$_REQUEST['couponMaxamt']."',
                    couponPercent   = '".$_REQUEST['couponPercent']."',
                    couponLimit   = '".$_REQUEST['couponLimit']."'";
                 
              $result=mysqli_query($connect,$insert1) or die(mysqli_error());
              header("location:coupon-list.php?msg=c");
              //} 
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
                          <h5 class="pull-left">Add <?php echo  $page; ?> </h5>
                          
                      </div>
                  </div>
                  <div class="card-body">
                     <div class="col-sm-12">
                    <div class="card">
                     
                      <div class="card-body">

                      
                        <form class="theme-form needs-validation" action="" method="post" enctype="multipart/form-data" novalidate>
                           
                            <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Coupon Code Name <span class="text-danger">*</span></label>
                              <div class="col-sm-9">
                              <input class="form-control"  required type="text" placeholder="Coupon Code Name" name="couponTitle" id="couponTitle" value="<?php echo $rowRole['couponTitle'];?>">
                              <div class="invalid-feedback">Please provide a valid code name.</div>
 
                            </div>
                              
                            </div>

                               <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Min Cart Amount <span class="text-danger">*</span></label>
                              <div class="col-sm-9">
                              <input class="form-control"  required type="number" placeholder="Min Cart Amount" name="couponMinamt" id="couponMinamt" value="<?php echo $rowRole['couponMinamt'];   ?>">
                              <div class="invalid-feedback">Please provide a valid min Cart Amount.</div>
 
                            </div>
                              
                            </div>


                             <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Coupon Percent <span class="text-danger">*</span></label>
                              <div class="col-sm-9">
                              <input class="form-control"  required type="number" min="1" placeholder="Coupon Percent" name="couponPercent" id="couponPercent" value="<?php echo $rowRole['couponPercent'];   ?>">
                              <div class="invalid-feedback">Please provide a Coupon Percent.</div>
 
                            </div>
                          </div>
                         <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Max Discount Amount <span class="text-danger">*</span></label>
                              <div class="col-sm-9">
                              <input class="form-control"  required type="number" placeholder="Max Discount Amount" name="couponMaxamt" id="couponMaxamt" value="<?php echo $rowRole['couponMaxamt'];   ?>">
                              <div class="invalid-feedback">Please provide a Max Discount Amount.</div>
 
                            </div>
                              
                            </div>

                              <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Usage limit per user <span class="text-danger">*</span></label>
                              <div class="col-sm-9">
                              <input class="form-control"  required type="number" placeholder="Usage limit per user" name="couponLimit" id="couponLimit" value="<?php echo $rowRole['couponLimit'];?>">
                              <div class="invalid-feedback">Please provide a Usage limit per user.</div>
 
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
