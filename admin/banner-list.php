 <?php 
     $page = "Banners";

session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }

  include("include/global.php");

  
$selectRole = "SELECT * FROM  banner  ORDER BY bannerID  DESC";
    $fireRole = mysqli_query($connect, $selectRole);
    $n=0;
    while($rowRole = mysqli_fetch_array($fireRole))
    {
      
 
       if($rowRole['bannerStatus'] == 0){
            $st='<span class="btn btn-sm bg-danger">Deactive</span>';
          }else{
            $st='<span class="btn btn-sm bg-success">Active</span>';
          }
      $n++;
       $List .='<tr>
                  <td>'.$n.'</td>
                 
                  <td><img src="'.$rowRole['banner_img'].'" height="100px"  width="200px"></td> 
                 
                  <td>'.$st.'</td>
                      <td>
  <div class="card-body dropdown-basic">
                    <div class="dropdown">
                      <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Dropdown<span><i class="icofont icofont-arrow-down"></i></span></button>
                      <div class="dropdown-content"> 
   <a href="javascript:void(0)" data-id="'.$rowRole['bannerID'].'" data-status="1" data-table="banner" class="dropdown-item active_status">Active</a>

<a href="javascript:void(0)"   data-id="'.$rowRole['bannerID'].'" data-status="0" data-table="banner"  class="dropdown-item deactive_status">Deactive</a>
  
    <a href="javascript:void(0)"   data-id="'.$rowRole['bannerID'].'" data-table="banner"  class="dropdown-item delete">Delete</a></div>
                      </div></div>
               </td>

                  </tr>';
    }  




 include("include/header.php");




 if($_REQUEST['msg'] == "c"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">'.$page.' Created Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }

 if($_REQUEST['msg'] == "u"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">'.$page.' Update Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }


   if($_REQUEST['msg'] == "d"){
    $msgs = '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Deleted Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }

   if($_REQUEST['msg'] == "ac"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Activated Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }


   if($_REQUEST['msg'] == "de"){
    $msgs = '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Deactivated Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }
   
   
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
                    <li class="breadcrumb-item">View <?php echo $page; ?></li>

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
                          <h5 class="pull-left">View <?php echo $page; ?> </h5>
                          <div class="pull-right">
                              <a class="btn btn-outline-primary ms-2" href="add-banner.php" title="" data-bs-original-title=""><i data-feather="upload"></i> Add <?php echo $page; ?>  </a>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive" id="doublescroll">
                                                   
<table class="display dataTable" id="export-button">
                        <thead>
                          <tr>
                          <th>#ID</th>
                          <th>Image</th>
                         
                           <th>Status</th>
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








 <script type="text/javascript">
   $(function() {
  // HANDLE open-dialog CLICK
  $('.deactive_status').on('click',function(e) {
    // PREVENT DEFAULT BEHAVIOUR FOR <a/>
    e.preventDefault();
            var id = $(this).data("id");
        var status = $(this).data("status");
        var table = $(this).data("table");
        var action = "Update";
    // SAVE PROMISE RETURN
    var res = showPrompt('Are you sure you want to deactive the <?php echo $page; ?> ?');
    res.then(function(ret) {
      
      if(ret == true){

              
          if(id && table){
            $.ajax({
                type:'POST',
                url:'Action.php',
                data:{ id:id,status:status,table:table,action:action },
                success:function(html){
                 
                  document.location.href="banner-list.php?msg=de";
             
                }
            }); 
        }else{
            location.reload();
        }

       
 
      }else{
      return false;
      }
     
    })
  });

 $('.active_status').on('click',function(e) {
    // PREVENT DEFAULT BEHAVIOUR FOR <a/>
    e.preventDefault();
        var id = $(this).data("id");
        var status = $(this).data("status");
        var table = $(this).data("table");
        var action = "Update";
    // SAVE PROMISE RETURN
    var res = showPrompt('Are you sure you want to active the <?php echo $page; ?> ?');
    res.then(function(ret) {
       
      if(ret == true){
      if(id && table){
            $.ajax({
                type:'POST',
                url:'Action.php',
                data:{ id:id,status:status,table:table,action:action },
                success:function(html){
                  
                  document.location.href="banner-list.php?msg=ac";
             
                }
            }); 
        }else{
            location.reload();
        }

        }else{
        return false;
        }
    })
  });

 $('.delete').on('click',function(e) {
  
    e.preventDefault();
        var id = $(this).data('id');
        var table = $(this).data('table');
        var action = "Delete";
 
    var res = showPrompt('Are you sure you want to delete <?php echo $page; ?> ?');
    res.then(function(ret) {
         if(ret == true){
        if(id && table){
            $.ajax({
                type:'POST',
                url:'Action.php',
                data:{ id:id,table:table,action:action },
                success:function(html){
                
                  document.location.href="banner-list.php?msg=d";
                }
            }); 
        }else{
            location.reload();
        }
        }else{
        return false;
        }
    })
  });

});
 </script>
 <?php include("include/footer.php"); ?>