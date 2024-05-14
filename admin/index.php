<?php 

   include("include/global.php");

session_start();
if(isset($_SESSION['LOGIN']['VaccaySitters']))
  {
   
    header("location:dashboard.php");
  }
 

if($_POST)
  {

 
     $sql = "select * from  admin where  adminEmail = '".$_REQUEST['member_name']."' AND  adminPassword = '".md5($_REQUEST['member_password'])."'";
  
    $result = mysqli_query($connect, $sql);
    $user = mysqli_fetch_array($result);
    if($user) {
              $_SESSION['LOGIN']['VaccaySitters']  = $user;

            if(!empty($_POST["remember"])) {
                setcookie ("member_login",$_POST["member_name"],time()+ (10 * 365 * 24 * 60 * 60));
                setcookie ("member_password",$_POST["member_password"],time()+ (10 * 365 * 24 * 60 * 60));
            } else {
                if(isset($_COOKIE["member_login"])) {
                    setcookie ("member_login","");
                }
                if(isset($_COOKIE["member_password"])) {
                    setcookie ("member_password","");
                }
            }
             header("location:dashboard.php");
    } else { 
        $EnqMsg = '<div class="text-danger text-bold text-center">Password Incorrect with this email</div>';
    }
    
   
  }



  ?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="VaccaySitterss">
    <meta name="keywords" content="VaccaySitterss Administration ">
    <meta name="author" content="VaccaySitterss Administration">
<link rel="icon" href="../upload/img/favis.png" type="image/x-icon">
    <link rel="shortcut icon" href="../upload/img/favis.png" type="image/x-icon">
    <title>VaccaySitters Administration</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/feather-icon.css">

    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">

  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
      <div class="container-fluid">
        <div class="row">
<!-- <div class="col-xl-5"><img class="bg-img-cover bg-center" src="../img/3.png" alt="looginpage"></div> -->
          <div class="col-12">

            <div class="login-card">
                  
              <form class="theme-form login-form" action="" method="post">
               <h4>Login</h4>
               <h6>Welcome back! Log in to your account.</h6>
                   <h4 class="text-center pb-10"> <?php echo  $EnqMsg; ?></h4>
            <!--     <h4 class="text-center">  @if(session()->has('error'))
                          <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                          <i class="bi-check-circle-fill"></i>
                          <strong> {{session('error')}}.</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          </div>

                               @endif  </h4> -->
          
                <div class="form-group">
                  <label>Email Address</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                    <input class="form-control" type="email" id="userEmail" placeholder="Test@gmail.com" name="member_name" required="" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" type="password" name="member_password" id="userPassword" placeholder="*********" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" required="">
                    <div class="show-hide"><span class="show"></span></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="checkbox">
                    <input id="checkbox1" type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>>
                    <label class="text-muted" for="checkbox1">Remember password</label>
                  </div><a class="link" href="forget-password.php">Forgot password?</a>
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                </div>
                <!-- <div class="login-social-title">                
                  <h5>Sign in with</h5>
                </div>
               
                <p>Don't have account?<a class="ms-2" href="{{url('admin/register')}}">Create Account</a></p> -->
            <div id="error"></div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section> 
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
        <script src="assets/ajax/login.js"></script>

    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>