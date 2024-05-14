<style>
 .was-validated .form-select:invalid + .select2 .select2-selection{
    border-color: #dc3545!important;
}
.was-validated .form-select:valid + .select2 .select2-selection{
    border-color: #28a745!important;
}
*:focus{
  outline:0px;
}
 </style>


<?php 

      $page = "Banner";

session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }

  include("include/global.php");
$rowRole=array();

      if($_REQUEST['lid'] !=''){

     $selectRole = "SELECT * FROM banner WHERE bannerID ='".$_REQUEST['lid']."'";
  
     $fireRole = mysqli_query($connect, $selectRole);
     $rowRole = mysqli_fetch_array($fireRole);
  }


 
  if(isset($_POST['savedata']))
  {


        if($_REQUEST['lid'] !=''){

            $temp_name=$_FILES['banner_img']['tmp_name'];
            $file_name=$_FILES['banner_img']['name'];   
            $fbl = time();
            $nefilename =   $fbl.$file_name;
            $file_path="../img/banner/".$nefilename;
            move_uploaded_file($temp_name,$file_path);

            if($file_name ==""){
              $file_path = $rowRole['banner_img'];
            }else{
             
               unlink($rowRole['banner_img']);

            }

             $insert1 ="update banner set   
                 banner_img = '".$file_path."'
                 where bannerID ='".$_REQUEST['lid']."' ";  
                 //echo $insert1;die;

              $result=mysqli_query($connect,$insert1) or die(mysqli_error());
              header("location:banner-list.php?msg=u");
        }else{ 

            
            $temp_name=$_FILES['banner_img']['tmp_name'];
            $file_name=$_FILES['banner_img']['name'];   
            $fbl = time();
            $nefilename =   $fbl.$file_name;
            $file_path="../img/banner/".$nefilename;
            move_uploaded_file($temp_name,$file_path);
              
            if($temp_name !='')
            {
             $newfilename = '../img/banner/'.$nefilename;
           }else{
              $newfilename = '';
            } 
            
           
         
     
            $insert1 ="insert into banner set 
                         banner_img = '".$file_path."'";  
          

              $result=mysqli_query($connect,$insert1) or die(mysqli_error());
              header("location:banner-list.php?msg=c");
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
                    <li class="breadcrumb-item">View Banners</li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
             
             <div class="container-fluid">

              <div class="row">
          
              <div class="col-sm-12">
                
                <div class="card">
                 <div class="card-header">

                      <div class="header-top">
                          <h5 class="pull-left">Add Banner</h5>
                          
                      </div>
                  </div>
                  <div class="card-body">
                     <div class="col-sm-12">
                    <div class="card">
                     
                      <div class="card-body">
                        <form class="theme-form needs-validation" action="" method="post" enctype="multipart/form-data" novalidate>

                          
                            

                            <div class="mb-3 row">
                             <label class="col-sm-3 col-form-label">Banner Image <span class="text-danger">*</span> </label>
                              <div class="col-sm-9">
                                   <input class="form-control"  required accept="image/*"  type="file" placeholder="" name="banner_img" id="banner_img" value="<?php echo $rowRole['banner_img'];?>">
                                   <div class="invalid-feedback">Please upload Banner Image.</div>
 
                                  <h6 class="form-text text-muted">Allowed file types: png, jpg, jpeg.</h6>
                         <h6 class="form-text text-muted">File Ratio: 2:1 | File size limit is 2Mb</h6>
                           <?php  if($rowRole['banner_img']!='') {?>
                       <img src="<?php echo $rowRole['banner_img'] ;?>" class="img-fluid top-radius-blog hided" style="height: 100px !important; width:200px !important; margin-top:10px !important;">
                      <?php }?>
                            
                        <img id="preview-image-before-upload" src="https://dummyimage.com/200x100/ebecf0/1e2ad4"
                      alt="preview image" class="img-fluid top-radius-blog showd" style="height: 100px !important; width:200px !important; margin-top:10px !important;">
                                 
                          </div>
                          </div> 
                         <!-- <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label">Application Type<span class="text-danger">*</span> </label>
                              <div class="col-sm-9">
                             <div class="col">
                        <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input" id="radioinline1" type="radio" <?php if($rowRole['banner_app_type']=='User') {echo 'checked';}?>  name="banner_app_type" value="User" required="" data-bs-original-title="" title="">
                            <label class="form-check-label mb-0" for="radioinline1">User App</label>
                          </div>
                          <div class="form-check form-check-inline radio radio-primary">
                            <input class="form-check-input" id="radioinline2" type="radio" <?php if($rowRole['banner_app_type']=='Vendor') {echo 'checked';}?> name="banner_app_type" value="Vendor" required="" data-bs-original-title="" title="">
                            <label class="form-check-label mb-0" for="radioinline2">Vendor App</label>
                          </div>
                     
                        </div>
                      </div>
                              
                            </div>
                          </div>-->
                          
                     
                          
                          
                          
                        
                            <div class="card-footer  text-center">
                            <?php if($_REQUEST['lid'] !=""){ ?>
                          
                          <button class="btn btn-primary" id="button1"  type="submit" name="savedata"><span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit</button>
                          <?php }else{?>

                           <button class="btn btn-primary" id="button"  type="submit" name="savedata"><span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit</button>

                         <?php } ?>
                           
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
<script type="text/javascript">
      
$(document).ready(function (e) {
 
 
   $('#redirect_page').on('change', function(){
      var value = $(this).val(); 
      if(value=='Service')
      {
        $("#service_div").show();
        $("#vendor_div").hide();
      }
      else if(value=='Vendor')
      {
         $("#service_div").hide();
        $("#vendor_div").show();
      }
      else
      {
         $("#service_div").hide();
        $("#vendor_div").hide();
      }
    });


   $('#banner_img').change(function(){
             $('.hided').hide(); 
          $('.showd').show(); 
    let reader = new FileReader();
 
    reader.onload = (e) => { 
 
      $('#preview-image-before-upload').attr('src', e.target.result); 
    }
 
   var a=(this.files[0].size);
        
        if(a > 2000000) {
             $('.showd').hide();
             $('#exampleModalc').modal('show');

          $('#banner_img').val('');
          return false;
        }else{
        reader.readAsDataURL(this.files[0]); 
        }
   
   });
   
});

</script>


<script>
   $(() => {
  $('#button').on('click', e => {
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
    $(() => {
  $('#button1').on('click', e => {
       $("input[type=file]").prop('required',false);
    let spinner = $(e.currentTarget).find('span')
    spinner.removeClass('d-none')
    setTimeout(_ => spinner.addClass('d-none'), 10000)
  })
})
</script> 


<?php if($_REQUEST['lid']) { ?>
 <style type="text/css">

    .showd{
        display: none;
    }
    </style>
 <?php }else{  ?>
  <style type="text/css">

 .showd{
        display: block;
    }
    </style>
  <?php }  ?>
</style>   



           
 <?php include("include/footer.php"); ?>
