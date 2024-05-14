     <?php 
     $page = "Coupon";
  


  include("include/global.php");

  if($_REQUEST['act'] == "del")
  {
  
   
     $query="delete from coupon where couponID =".$_REQUEST['lid'];
     $row = mysqli_query($connect,$query) or die(mysqli_error());
      ?>
      <script language="javascript" type="text/javascript">
      document.location.href="coupon-list.php?msg=d";
      </script>
      <?php
      
  } 


 if($_REQUEST['couponStatus'] == 1)
  {
    $query="update coupon set couponStatus = 0  where couponID  =".$_REQUEST['lid'];
    mysqli_query($connect,$query);
  }

  if($_REQUEST['couponStatus'] == 0)
  {
    $query="update coupon set couponStatus = 1  where couponID  =".$_REQUEST['lid'];
    mysqli_query($connect,$query);  
  }


    $selectRole = "SELECT * FROM coupon ORDER BY couponID  desc ";
    $fireRole = mysqli_query($connect, $selectRole);
    $n=0;
    while($rowRole = mysqli_fetch_array($fireRole))
    {
      

       if($rowRole['couponStatus'] == 0){
            $st='<span class="btn btn-sm bg-danger">Deactive</span>';
          }else{
            $st='<span class="btn btn-sm bg-success">Active</span>';
          }
      $n++;
       $List .='<tr>
                  <td>'.$n.'</td>
                  <td>'.$rowRole['couponTitle'].'</td>
                 <td>'.$rowRole['couponMinamt'].'</td> 
                  <td>'.$rowRole['couponMaxamt'].'</td> 
                   <td>'.$rowRole['couponLimit'].'</td> 
                  <td>'.$rowRole['couponPercent'].'</td>
                  <td>'.$st.'</td>
                 <td>
 <div class="card-body dropdown-basic">
                    <div class="dropdown">
                      <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Dropdown<span><i class="icofont icofont-arrow-down"></i></span></button>
                      <div class="dropdown-content"> 
  
<a href="javascript:void(0)" data-id="'.$rowRole['couponID'].'" data-status="1" data-table="coupon" class="dropdown-item active_status">Active</a>

    <a href="javascript:void(0)"   data-id="'.$rowRole['couponID'].'" data-status="0" data-table="coupon"  class="dropdown-item deactive_status">Deactive</a>
    <a href="javascript:void(0)"   data-id="'.$rowRole['couponID'].'" data-table="coupon"  class="dropdown-item delete">Delete</a>

                   
   <a  href="add-coupon.php?lid='.$rowRole['couponID'].'" class="dropdown-item">Edit</a>
   </div>
                      </div></div>
               </td>
                  </tr>';
    }  



 include("include/header.php");




 if($_REQUEST['msg'] == "c"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">'.$page.'  Created Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }

 if($_REQUEST['msg'] == "u"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">'.$page.'  Update Successfully</strong>
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
                    <li class="breadcrumb-item"><?php echo  $page; ?> list</li>

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
                          <h5 class="pull-left">View <?php echo  $page; ?> </h5>
                          <div class="pull-right">
                              <a class="btn btn-outline-primary ms-2" href="add-coupon.php" title="" data-bs-original-title=""><i data-feather="upload"></i> Add <?php echo  $page; ?>  </a>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                                                  
<table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>#ID</th>
                          <th>Coupon Code Name</th>
                          <th>Min Cart Amount</th>
                           <th>Coupon Percent</th>
                          <th>Max Discount Amount</th>
                          <th>Usage Limit Per User</th>
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

 <?php include("include/footer.php"); ?>
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
                  document.location.href="coupon-list.php?msg=de";
              
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
                  document.location.href="coupon-list.php?msg=ac";
              
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
    // PREVENT DEFAULT BEHAVIOUR FOR <a/>
    e.preventDefault();
        var id = $(this).data('id');
        var table = $(this).data('table');
        var action = "Delete";
    // SAVE PROMISE RETURN
    var res = showPrompt('Are you sure do you want to delete <?php echo  $page; ?> ?');
    res.then(function(ret) {
         if(ret == true){
        if(id && table){
            $.ajax({
                type:'POST',
                url:'Action.php',
                data:{ id:id,table:table,action:action },
                success:function(html){
                  document.location.href="coupon-list.php?msg=d";
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