 <?php 

 $page = "Change Password";
session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }

  include("include/global.php");


 



  if(isset($_POST['savedata']))
  {
 

      if($_SESSION['LOGIN']['VaccaySitters']['adminID'] !=''){

              
             

              $chg_pwd=mysqli_query($connect, "select * from admin where adminID='".$_SESSION['LOGIN']['VaccaySitters']['adminID']."'");
              $chg_pwd1=mysqli_fetch_array($chg_pwd);

              if($chg_pwd1['adminPassword'] == md5($_REQUEST['oldPassword'])){

              if($_REQUEST['salonPassword'] == $_REQUEST['ConfirmPassword']){

              $insert1 ="update  admin set                 
               adminPassword   = '".md5($_REQUEST['salonPassword'])."'
               where adminID  ='".$_SESSION['LOGIN']['VaccaySitters']['adminID']."' ";  

              $result=mysqli_query($connect,$insert1) or die(mysqli_error());
                           header("location:change-password.php?msg=u");


              }
              else{
  
              header("location:change-password.php?msg=e");


             
              }
              }
              else
              {
                          header("location:change-password.php?msg=wr");

               
              }




            }

  }





 include("include/header.php");


 if($_REQUEST['msg'] == "u")
 {

               $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Update Sucessfully !!!</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
}elseif($_REQUEST['msg'] == "e"){
  $msgs = '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Your new and Retype Password is not match !!!</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
}elseif($_REQUEST['msg'] == "wr"){
    $msgs = '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Your old password is wrong !!!</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
}

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
                    <li class="breadcrumb-item"><a href="dashboard.php" data-bs-original-title="" title="">Home </a></li>
                    <li class="breadcrumb-item"><?php echo $page; ?>  </li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
             
             <div class="container-fluid">

              <div class="row">
          
              <div class="col-sm-12">
                <?php  echo $msgs;?>
                <div class="card">
                 <div class="card-header">

                      <div class="header-top">
                          <h5 class="pull-left"> <?php echo $page; ?></h5>
                          
                      </div>
                  </div>
                  <div class="card-body">
                     <div class="col-sm-12">
                    <div class="card">
                     
                      <div class="card-body">
                        <form class="theme-form" action="" method="post" enctype="multipart/form-data">
                             <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Old Password </label>
                              <div class="col-sm-9">
                              <input class="form-control" type="password" required="" placeholder="Password" name="oldPassword" id="oldPassword">
                             
                            </div>
                              
                            </div>


                              <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">New Password </label>
                              <div class="col-sm-9">
                              <input class="form-control" type="password" required="" placeholder="Password" name="salonPassword" id="NewPassword">
                                <div class="show-hide"><span class="show"></span></div>

                             
                            </div>
                              
                            </div>

                              <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Confirm Password </label>
                              <div class="col-sm-9">
                              <input class="form-control" type="password" required="" placeholder="Confirm Password" name="ConfirmPassword" id="ConfirmPassword">
                             
                            </div>
                              
                            </div>
                        
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




    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDApnVn22RD_1hOnAHhqHkrJn9NTFmeKHo&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('locations');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('lats').value = place.geometry.location.lat();
                document.getElementById('lngs').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
       

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>





<script type="text/javascript">
      
$(document).ready(function (e) {
 
   
   $('#salonLog1').change(function(){
          
    let reader = new FileReader();
 
    reader.onload = (e) => { 
 
      $('#preview-image-before-upload1').attr('src', e.target.result); 
    }
 
   var a=(this.files[0].size);
        
        if(a > 2000000) {
             $('.show').hide();
             $('#exampleModalc').modal('show');

          $('#salonLog').val('');
          return false;
        }else{
        reader.readAsDataURL(this.files[0]); 
        }
   
   });





     $('#salonLog2').change(function(){
           
    let reader = new FileReader();
 
    reader.onload = (e) => { 
 
      $('#preview-image-before-upload2').attr('src', e.target.result); 
    }
 
   var a=(this.files[0].size);
        
        if(a > 2000000) {
             $('.show').hide();
             $('#exampleModalc').modal('show');

          $('#salonLog').val('');
          return false;
        }else{
        reader.readAsDataURL(this.files[0]); 
        }
   
   });


      $('#salonLog3').change(function(){

    let reader = new FileReader();
 
    reader.onload = (e) => { 
          
          $('#preview-image-before-upload3').show();
      $('#preview-image-before-upload3').attr('src', e.target.result); 
    }
 
   var a=(this.files[0].size);
        
        if(a > 2000000) {
             $('.show').hide();
             $('#exampleModalc').modal('show');

          $('#salonLog').val('');
          return false;
        }else{
        reader.readAsDataURL(this.files[0]); 
        }
   
   });



   
});

</script>


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

    input[type='file']{

  font-size:30px;
}
   .borderdiv {
    border: 1px solid #ced4da;
    background-color: #ced4da;
   } 
</style>        
 <?php include("include/footer.php"); ?>
