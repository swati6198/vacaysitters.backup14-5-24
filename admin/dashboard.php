 <?php 

 $page = "Dashboard";
session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  } 

  include("include/global.php");

 include("include/header.php");
 
 
 $userc =  mysqli_query($connect,"SELECT * FROM user  ORDER BY userID desc ");
$usercount = mysqli_num_rows($userc);

$sitterc =  mysqli_query($connect,"SELECT * FROM sitter where sitterIsapproved=1 ORDER BY sitterID desc ");
$sittercount = mysqli_num_rows($sitterc);


$psitterc =  mysqli_query($connect,"SELECT * FROM sitter where sitterIsapproved=0 ORDER BY sitterID desc ");
$psittercount = mysqli_num_rows($psitterc);


$books =  mysqli_query($connect,"SELECT  * FROM booking ");
$bookcount = mysqli_num_rows($books);


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
                    <li class="breadcrumb-item"> <?php echo $page; ?> List</li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
             
             <div class="container-fluid">

                  <!--<div class="card-body">-->
               <div class="row">
              <div class="col-sm-6 col-xl-3 col-lg-6">
                                <a href="customer-list.php">

                <div class="card o-hidden border-0">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Total Users</span>
                        <h4 class="mb-0 counter"><?php echo $usercount ; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
                 </a>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                            <a href="booking-list.php">
                <div class="card o-hidden border-0">
                  <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                      <div class="media-body"><span class="m-0">Total Booking</span>
                        <h4 class="mb-0 counter"><?php echo $bookcount; ?></h4><i class="icon-bg" data-feather="shopping-bag"></i>
                      </div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
           
              <div class="col-sm-6 col-xl-3 col-lg-6">
                            <a href="booking-list.php">

                <div class="card o-hidden border-0">
                  <div class="bg-info b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i class="fa fa-inr" style="font-size:30px"></i></div>
                      <div class="media-body"><span class="m-0">Approved Sitter</span>
                        <h4 class="mb-0 counter"><?php echo $sittercount; ?></h4><i class="icon-bg fa fa-inr" style="font-size:10px"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              </div>
         
              
              
            
                 <div class="col-sm-6 col-xl-3 col-lg-6">
                  <a href="">
                <div class="card o-hidden border-0">
                  <div class="bg-danger b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="slash"></i></div>
                      <div class="media-body" style="padding-left:20px !important;"><span class="m-0">Pending  Sitters</span>
                        <h4 class="mb-0 counter"><?php echo $psittercount; ?></h4><i class="icon-bg" data-feather="slash"></i>
                      </div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
           

               
                            </a>

              </div>
        
                     
                  </div>
                  

                  <div></div>
            
                 <div class="row"> 
     <div class="col-xl-6 xl-100 box-col-12">
                <div class="card">
                  <div class="cal-date-widget card-body">
                    <div class="row">
                      <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                        <div class="cal-info text-center">
                          <div>
                            <h2><?php echo date('d'); ?></h2>
                            <div class="d-inline-block"><span class="b-r-dark pe-3"><?php echo date('F'); ?></span><span class="ps-3"><?php echo date('Y'); ?></span></div>
                            <p class="f-16"></p>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                        <div class="cal-datepicker">
                          <div class="datepicker-here float-sm-end" data-language="en">           </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
             

<style type="text/css">
  .apexcharts-toolbar{
    display: none !important;
  }
</style>
  
    <script type="text/javascript"> 
                        var my_js_count = <?php print json_encode($newb);?> ;
                        var my_js_count1 = <?php print json_encode($newbb);?> ;
                        var my_date = <?php echo stripslashes(json_encode($newdate)); ?>

             </script>
 <?php include("include/footer.php"); ?>
