<?php
include('includes0/db.php');
   include('includes0/head.php');
   if(isset($_POST['login']))
{
  $username=$_POST['username'];
  $password=$_POST['password'];
  $sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
  $query= $conn-> prepare($sql);
  $query-> bindParam(':username', $username, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_ASSOC);
  if($query->rowCount() > 0)
  {
    $_SESSION['alogin']=$_POST['username'];
   header('Location:admin/dashboard.php');
// echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
  } else{
    echo "<script>alert('Invalid Details');</script>";
  }
}

?>
<header class="main-header">
   <a href="#" class="logo"><span class="logo-lg">LIBRARY</span></a>
   <nav class="navbar navbar-static-top">
     <!-- Sidebar toggle button-->
     <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
     </a>
     <div class="navbar-collapse collapse ">
         <ul id="menu-top" class="nav navbar-nav navbar-right">
             <li><a href="signup.php">User Signup</a></li>
            <li><a href="adminlogin.php">Admin Login</a></li>
              <li><a href="index.php">User Login</a></li>
         </ul>
      </div>
   </nav>
</header>
<!-- <div class="content-wrapper"> -->
   <div class="container">
      <div class="row pad-botm">
         <div class="col-md-12">
         <h4 class="header-line">Admin LOGIN FORM</h4>
         </div>
      </div>

<!--LOGIN PANEL START-->
         <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
               <div class="panel panel-info">
                  <div class="panel-heading">   LOGIN FORM
                  </div>
                  <div class="panel-body">
                     <form role="form" method="post">

                        <div class="form-group">
                           <label>Enter Username</label>
                           <input class="form-control" type="text" name="username" autocomplete="off" required />
                        </div>
                        <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" required autocomplete="off"  />
                        <p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
                        </div>



                        <button type="submit" name="login" class="btn btn-info">LOGIN </button> | <a href="signup.php">Not Register Yet</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>


 <?php include('includes0/footer.php');?>
