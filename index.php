<?php
   include('includes0/head.php');
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
         <h4 class="header-line">USER LOGIN FORM</h4>
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
                        <label>Enter Email id</label>
                        <input class="form-control" type="text" name="emailid" required autocomplete="off" />
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
