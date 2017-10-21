<?php
include('layout/master.php');
if(isset($_POST['change']))
  {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['alogin'];
  $sql ="SELECT Password FROM admin where UserName=:username and Password=:password";
$query= $conn -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_ASSOC);
if($query -> rowCount() > 0)
{
$con="update admin set Password=:newpassword where UserName=:username";
$chngpwd1 = $conn->prepare($con);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong";
}
}

?>

?>
<div class="content-wrapper">
   <section class="content-header">
      <h2 class="text-center">Change Password</h2>
   </section><hr>
   <section class="content">
      <div class="row">
         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
               <div class="panel panel-info">
                  <div class="panel-heading">
                        Change Password
                  </div>
                  <div class="panel-body">
                     <form role="form" method="post" onSubmit="return valid();" name="chngpwd">

                     <div class="form-group">
                     <label>Current Password</label>
                     <input class="form-control" type="password" name="password" autocomplete="off" required  />
                     </div>

                     <div class="form-group">
                     <label>Enter Password</label>
                     <input class="form-control" type="password" name="newpassword" autocomplete="off" required  />
                     </div>

                     <div class="form-group">
                     <label>Confirm Password </label>
                     <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
                     </div>

                      <button type="submit" name="change" class="btn btn-info">Chnage </button>
                     </form>
                   </div>
               </div>
            </div>
      </div>
   </section>
<div>
