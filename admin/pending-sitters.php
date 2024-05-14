 <?php 
     $page = "Pending Sitter";

   session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }

  include("include/global.php");
 

  if(isset($_POST['savedatas']))
  {

     /*$insert1 ="insert into  salonrejected set                 
              salonrejectedSid   = '".$_REQUEST['sid']."',
              salonrejectedMessage   = '".addslashes($_REQUEST['message'])."'";  
              $result=mysqli_query($connect,$insert1);*/
                $query="update sitter set sitterIsapproved = 2 ,sitterRejecteddate='".date('Y-m-d H:i:s')."'  where sitterID ='".$_REQUEST['sid']."'";
              mysqli_query($connect,$query);
     /*    $selectD = mysqli_query($connect,"SELECT * FROM salons WHERE salonID ='".$_REQUEST['sid']."'");
     $rows = mysqli_fetch_array($selectD);
            $subject = "Rejected Your Request  Makeup Central ";
            infomailtemplate($subject, $_REQUEST['message'], $rows['salonEmail'],$rows['salonName']);*/
              header("location:pending-sitters.php?msg=r");

  }


  


 if($_REQUEST['sitterStatus'] == 1)

  {
    $query="update sitter set sitterStatus = 1  where sitterID =".$_REQUEST['lid'];
    mysqli_query($connect,$query);  
     
  }
    $selectRole = "SELECT * FROM sitter WHERE sitterIsapproved = 0 ORDER BY sitterID desc ";
    $fireRole = mysqli_query($connect, $selectRole);
    $n=0;
    while($rowRole = mysqli_fetch_array($fireRole))
    {

 
   

       if($rowRole['sitterIsapproved'] == 2){
            $st='<span class="btn btn-sm bg-success">Rejected</span>';

          }else{
                $st='<span class="btn btn-sm bg-danger">Pending</span>';

          }
      $n++;
       $List .='<tr>
                  <td>'.$n.'</td>
                  
                   <td>'.$rowRole['sitterFirstname'].' '.$rowRole['sitterLastname'].'</td>
                    
                  
                  <td>'.$rowRole['sitterEmail'].'</td>
                   <td>'.$rowRole['sitterMobileno'].'</td>
                  <td>'.$rowRole['sitterAddress'].'</td>

                  <td>
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalq-'.$n.'" style="width: 97px !important; " data-bs-original-title="" title=""><span class="title" style="font-size:13px !important;">View Details</span></button>
                      
                                <div class="modal fade"  id="exampleModalq-'.$n.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                  <div class="modal-dialog"  style="max-width: 80%;" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Sitter Details</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>  
                                      <div class="modal-body">
      <section style="background-color: #eee;">
  <div class="container py-5">                                
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Sitter Name : </h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterFirstname'].' '.$rowRole['sitterLastname'].'</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email : </h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterEmail'].'</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Address : </h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterAddress'].'</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Proviance : </h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterProviance'].'</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Bio : </h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterBio'].'</p>
              </div> 
            </div>
             <hr>
             <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Skills : </h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterSkills'].'</p>
              </div> 
            </div>
            <hr>
             <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0"> Sitter Document : </h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterDocumentname'].' ( '.$rowRole['sitterDocumentno'].' ) '.'</p>
              </div>
            </div> <hr>
             <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Document Image: </h6>
              </div>
              <div class="col-sm-9">
               <a href="'.$rowRole['sitterDocumenturl'].'"> <img style="height:100px;width:100px;" src="'.$rowRole['sitterDocumenturl'].'"><a>
              </div>
            </div> <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Experianced With : </h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterExperiancewith'].'</p>
              </div>
            </div> <hr> 
             <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Work Status</h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterWorkstatus'].'</p>
              </div>
            </div> <hr>
             <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Sitter Have Visa ?</h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterHavevisa'].'</p>
              </div>
            </div> <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Sitter Have Transport?</h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">'.$rowRole['sitterHavetransport'].'</p>
              </div>
            </div> <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-10">Sitter Video Interview</h6>
              </div>
              <div class="col-sm-9">
             
              <a href="'.$rowRole['sitterVideointerview'].'"><iframe src="'.$rowRole['sitterVideointerview'].'" width="500" height="350"></iframe></a>

              </div>
            </div> <hr>
          </div>
        </div>
       
      </div>
    </div>
  </div>
</section>
</div></div></div></div></section></td> 
                  <td>'.$st.'</td>
                 
                  

                    <td>
 <div class="card-body dropdown-basic">
                    <div class="dropdown">
                      <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Dropdown<span><i class="icofont icofont-arrow-down"></i></span></button>
                      <div class="dropdown-content"> 
  <a href="javascript:void(0)" data-id="'.$rowRole['sitterID'].'" data-status="1" data-table="sitter" class="dropdown-item active_status">Active</a>
 <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2-'.$n.'" class="dropdown-item">Reject</a>
                       
   <!-- <a  href="add-salon.php?lid='.$rowRole['salonID'].'" class="dropdown-item">Edit</a> -->
   <!--<a href="pending-sitters.php?lid='.$rowRole['salonID'].'&act=del"  onclick="return delete_row();"class="dropdown-item">Delete</a>-->
   <!-- <a  href="availability.php?sid='.$rowRole['salonID'].'" class="dropdown-item">Availability</a> -->

<!-- <a  href="salon-gallery.php?sid='.$rowRole['salonID'].'" class="dropdown-item">Gallery</a> -->
    </div></div></div>


                                <div class="modal fade" id="exampleModal2-'.$n.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Reject</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>  
                                      <div class="modal-body">
                     <div class="col-sm-12">
                    <div class="card">
                     
                      <div class="card-body">
                        <form class="theme-form" action="" method="post" enctype="multipart/form-data">

                       <div class="mb-3 row">
                             <label class="col-sm-3 col-form-label">Reason</label>
                              <div class="col-sm-12">
                              <input type="hidden" name="sid" value="'.$rowRole['sitterID'].'">
                              <input type="hidden" name="sname" value="'.$rowRole['sitterName'].'">
                              <input type="hidden" name="semail" value="'.$rowRole['sitterEmail'].'">
                            <textarea class="form-control" required="" type="text" placeholder="Description" name="message" id="message" rows="3"></textarea>

                         </div>
                          </div>


                        
                            <div class="card-footer  text-center">
                            <button class="btn btn-primary"  type="submit" name="savedatas"><span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit</button>
                           
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
               </td>

                  </tr>';
                  
  $imgs ='';  
$sumrating='';
$scatname ='';
$catname ='';              
                  
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

    if($_REQUEST['msg'] == "r"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Sitter Rejected </strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
  }
  
    if($_REQUEST['msg'] == "ac"){
    $msgs = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show text-center">
                          <i class="bi-check-circle-fill"></i>
                          <strong class="text-center">Sitter Approved </strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
  }


   
  ?>
<!---->
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
                    <li class="breadcrumb-item"><?php echo $page; ?> list</li>

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
                    <div class="table-responsive" id="doublescroll">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>#ID</th>
                          <th>Sitter Name</th>
                          <th>Email</th>
                          <th>Mobile No</th>
                          <th>Address</th>
                          <th>Details</th>
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


   <script language="javascript" type="text/javascript">


function delete_row()
{
  var t=confirm("Are you sure do you want to delete <?php echo $page; ?> ?");
  if (t)
    {
      return true;
    }
  else
    {
      return false;
    }
}

 $('.active_status').on('click',function(e) {
    // PREVENT DEFAULT BEHAVIOUR FOR <a/>
    e.preventDefault();
        var id = $(this).data("id");
        var status = $(this).data("status");
        var table = $(this).data("table");
        var action = "ApproveSitter";
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
                  document.location.href="pending-sitters.php?msg=ac";
             
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

</script>        
 <?php include("include/footer.php"); ?>
