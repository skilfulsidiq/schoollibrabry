<?php
require_once('includes0/db.php');
   include('includes0/head.php');
   if(isset($_POST['signup']))
{
   $StudentId= $_POST['studentid'];
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$status=1;
$sql="INSERT INTO  students(StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
$query = $conn->prepare($sql);
$query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $conn->lastInsertId();
   if($lastInsertId)
   {
   echo '<script>alert("Your Registration successfull and your student id is  "+"'.$StudentId.'")</script>';
   }
   else
   {
   echo "<script>alert('Something went wrong. Please try again');</script>";
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
         <h4 class="header-line">SignUp FORM</h4>
         </div>
      </div>

<!--LOGIN PANEL START-->
         <div class="row">
            <div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                  <div class="panel-heading">
                     Register FORM
                  </div>
                  <div class="panel-body">
                      <form name="signup" method="post" onSubmit="return valid();">
                        <div class="form-group">
                        <label>Enter Full Name</label>
                        <input class="form-control" type="text" name="fullanme" autocomplete="off" required />
                        </div>
                        <div class="form-group">
                        <label>SrudentID</label>
                        <input class="form-control" type="text" name="studentid" autocomplete="off" required />
                        </div>

                        <div class="form-group">
                        <label>Mobile Number :</label>
                        <input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
                        </div>

                        <div class="form-group">
                        <label>Enter Email</label>
                        <input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  />
                           <span id="user-availability-status" style="font-size:12px;"></span>
                        </div>

                        <div class="form-group">
                        <label>Enter Password</label>
                        <input class="form-control" type="password" name="password" autocomplete="off" required  />
                        </div>

                        <div class="form-group">
                        <label>Confirm Password </label>
                        <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
                        </div>
                        <button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button>

                     </form>
                  </div>
               </div>
            </div>
        </div>
   </div>



 <?php include('includes0/footer.php');?>
