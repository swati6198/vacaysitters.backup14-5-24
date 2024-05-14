  <?php 

 $page = "Sitters Reward Points";
session_start();
  if(!isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   header("location:index.php");
  }

  include("include/global.php");
     $selectBooking =  mysqli_query($connect,"SELECT * FROM transaction WHERE transactionsTypeID='Sitter' ORDER BY transactionsId  desc ");
   
    $n=0;
    while($rowRole = mysqli_fetch_array($selectBooking))
    {

      $sqlC = mysqli_query($connect,"SELECT * FROM sitter WHERE sitterID = '".$rowRole['transactionsUserID']."'");
      $rowC = mysqli_fetch_array($sqlC);
 
      $n++; 
       $List .='<tr>
                  <td>'.$n.'</td>
                    <td>'.$rowC['sitterFirstname'].' '.$rowC['userLastname'].'</td>
                   <td>'.$rowC['sitterMobileno'].'</td>
                     <td>'.$rowRole['transactionsTitle'].'</td>
                      <td>'.$rowRole['transactionsAbout'].'</td>
                       <td>'.$rowRole['transactionsType'].'</td>
                   <td>R '.round($rowRole['transactionsAmount']).'</td>
                        <td>'.date('d M Y h:i A',strtotime($rowRole['transactionsDate'])).'</td>
                  </tr>';

                   $bookingdetail='';
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
                    <li class="breadcrumb-item"> <?php echo $page; ?> List</li>

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
                          <h5 class="pull-left"><?php echo $page; ?> List </h5>
                         
                      </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                          <th>#ID</th>
                          <th>Full Name</th>
                          <th>Phone No</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Type</th>
                          <th> Amount</th>
                         <th>Date</th>
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


<style type="text/css">
  .testnew{
    background-color: none !important;
    color: #0d6efd !important;
}
  </style>
  
 <?php include("include/footer.php"); ?>
