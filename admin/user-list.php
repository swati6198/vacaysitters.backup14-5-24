<?php 
$msgs=''; 
$page = "Client";
session_start();
if(!isset($_SESSION['LOGIN']['VaccaySitters']))
{
   header("location:index.php");
}
include("include/global.php");
    $selectRole = mysqli_query($connect, "SELECT * FROM user WHERE userStatus!=2 ORDER BY userID   desc ");
    $n1=0;
    while($rowRole = mysqli_fetch_array($selectRole))
    {
        $selectPet = mysqli_query($connect, "SELECT * FROM pet WHERE petStatus=1 AND userID='".$rowRole['userID']."' ORDER BY petID   desc ");
        $n1=0;$petlist='';$rowRole1='';
        while($rowRole1 = mysqli_fetch_array($selectPet))
        {
            $n1++;
            $petlist.='<tr>
                 <td>'.$n1.'</td>
                    <td>'.$rowRole1['petName'].'</td>
                    <td>'.$rowRole1['petSize'].'</td>
                    <td>'.$rowRole1['petBreed'].'</td>
                    </tr>';
        }
       
       if($rowRole['userStatus'] == 0){
            $st='<span class="btn btn-sm bg-danger">Deactive</span>';
          }else{
            $st='<span class="btn btn-sm bg-success">Active</span>';
          }
      $n++;
       $List .='<tr>
                 
                 <td>'.$n.'</td>
                    <td>'.$rowRole['userFirstname'].' '.$rowRole['userLastname'].'</td>
                    <td>'.$rowRole['userEmail'].'</td>
                    <td>'.$rowRole['userMobileno'].'</td>
                    <td>'.$rowRole['userAddress'].'</td>
                   <td><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalq-'.$n.'" style="width: 97px !important; " data-bs-original-title="" title=""><span class="title" style="font-size:13px !important;">View Details</span></button>
                    <div class="modal fade"  id="exampleModalq-'.$n.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog"  style="max-width: 80%;" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Pet Details</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>  
                    <div class="modal-body">
                     <div class="card">
                 <div class="card-header">
                      <div class="header-top">
                          <h5 class="pull-left">View Pet Details </h5>
                      </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive" id="">
                      <table class="display dataTable" id="export-button">
                        <thead>
                          <tr>
                          <th>#ID</th>
                          <th>Pet Name</th>
                          <th>Pet Size</th>
                          <th>Pet Breed No</th>
                          </tr>
                        </thead>
                        <tbody>
                        '.$petlist.'
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                </div>
            </div>
        </div>
</div>

                                      
                    </td>
                    <td>'.$st.'</td>
                     <td>
  <div class="card-body dropdown-basic">
                    <div class="dropdown">
                      <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Dropdown<span><i class="icofont icofont-arrow-down"></i></span></button>
                      <div class="dropdown-content"> 

 <a href="javascript:void(0)"   data-id="'.$rowRole['userID'].'" data-status="1" data-table="user"  class="dropdown-item active_status">Activate</a>
    <a href="javascript:void(0)"   data-id="'.$rowRole['userID'].'" data-status="0" data-table="user"  class="dropdown-item deactive_status">Deactivate</a>
    <a href="javascript:void(0)"   data-id="'.$rowRole['userID'].'" data-table="user"  class="dropdown-item delete">Delete</a>

    </div>
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
                          <strong class="text-center">Approved Successfully</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
   }


   if($_REQUEST['msg'] == "de"){
    $msgs = '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Pending Successfully</strong>
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
                      </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                                                    
  <table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>#ID</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Phone No</th>
                          <th>Address</th>
                          <th>Pets</th>
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
    var res = showPrompt('Are you sure you want to deactivate the <?php echo $page; ?> ?');
    res.then(function(ret) {
      
      if(ret == true){

              
          if(id && table){
            $.ajax({
                type:'POST',
                url:'Action.php',
                data:{ id:id,status:status,table:table,action:action },
                success:function(html){
                 
                  document.location.href="user-list.php?msg=de";
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
    var res = showPrompt('Are you sure you want to activate the <?php echo $page; ?> ?');
    res.then(function(ret) {
       
      if(ret == true){
      if(id && table){
            $.ajax({
                type:'POST',
                url:'Action.php',
                data:{ id:id,status:status,table:table,action:action },
                success:function(html){
                  document.location.href="user-list.php?msg=ac";
             
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
   
    var res = showPrompt('Are you sure do you want to delete <?php echo  $page; ?> ?');
    res.then(function(ret) {
         if(ret == true){
        if(id && table){
            $.ajax({
                type:'POST',
                url:'Action.php',
                data:{ id:id,table:table,action:action },
                success:function(html){
                  document.location.href="user-list.php?msg=d";
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