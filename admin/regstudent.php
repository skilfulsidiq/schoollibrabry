<?php
include('layout/master.php');

if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "UPDATE students set Status=:status  WHERE id=:id";
$query = $conn->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:regstudent.php');
}



//code for active students
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "UPDATE students set Status=:status  WHERE id=:id";
$query = $conn->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:regstudent.php');
}
?>
   <div class="content-wrapper">
      <section class="content-header">
         <h2 class="text-center">Register Student</h2>
      </section><hr>
      <!-- main content -->
      <section class="content">
         <div class="panel panel-info">
           <div class="panel-heading">
             <h3 class="panel-title text-center">Register Students' List</h3>
           </div>
           <div class="panel-body">
              <div class="table-responsive">
                 <table class="table table-condensed table-striped table-bordered"  id="dataTables-example">
                    <thead>
                       <th>#</th><th>Student ID</th><th>Student Name</th><th>Email</th><th>Mobile Number</th><th>Reg Date</th> <th>Status</th><th></th>
                    </thead>
                    <tbody>
                       <?php $sql = "SELECT * from students";
                        $query = $conn -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_ASSOC);
                        $cnt=1;
                        if($query->rowCount() > 0):
                        foreach($results as $result):?>
                       <tr>
                          <td><?=$cnt;?></td>
                          <td><?=$result['StudentId'];?></td>
                          <td><?=$result['FullName'];?></td>
                          <td><?=$result['EmailId'];?></td>
                          <td><?=$result['MobileNumber'];?></td>
                          <td><?=$result['RegDate'];?></td>
                          <td><?=$result['Status'];?></td>
                          <td class="center">
                           <?php if($result['Status']==1)
                            {?>
                              <a href="regstudent.php?inid=<?php echo htmlentities($result['id']);?>" onclick="return confirm('Are you sure you want to block this student?');" class="btn btn-danger"> Inactive</a>
                              <?php } else {?>

                                            <a href="regstudent.php?id=<?php echo htmlentities($result['id']);?>" onclick="return confirm('Are you sure you want to active this student?');" class="btn btn-primary"> Active</a>
                                            <?php } ?>

                                            </td>
                                        </tr>

                       <?php $cnt +=1;
                    endforeach;
                 endif;?>
                    </tbody>
                 </table>
              </div>
           </div>
         </div>
      </section>
   </div>
 <?php include('../includes/footer.php');?>
