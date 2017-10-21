<?php
include('layout/master.php');
   if(isset($_GET['delete'])){
   $id = (int)$_GET['delete'];
   $sql = "DELETE FROM issuedbook WHERE id=:id";
   $stmtdel = $conn->prepare($sql);
   $stmtdel->bindParam('id', $id, PDO::PARAM_STR);
   $stmtdel->execute();
   $_SESSION['success_flash']="Author Deleted";
   header('Location:issued.php');
}
?>
   <div class="content-wrapper">
<?php   if (isset($_GET['add']) || isset($_GET['edit'])) {
            $studentid = ((isset($_POST['studentid']))?$_POST['studentid']:'');
            $bookid = ((isset($_POST['bookid']))?$_POST['bookid']:'');
            $category = ((isset($_POST['category']))?$_POST['category']:'');
            if (isset($_GET['edit'])){
              $id = (int)$_GET['edit'];
              $sql = "SELECT * FROM issuedbook WHERE id =:id";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $id, PDO::PARAM_STR);
              $stmt->execute();
              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($results as $result){}
              $studentid = ((isset($_POST['studentid']) && $_POST['studentid'] !='')?$_POST['studentid']:show($result['StudentID']));
               $bookid = ((isset($_POST['bookid']) && $_POST['bookid'] !='')?$_POST['bookid']:show($result['BookId']));
           }
           $errors = [];
            if($_POST){

               if(!empty($errors)){
                  echo display_error($errors);
               }else{
                  $sql="INSERT INTO issuedbook(StudentID,BookId) VALUES(:studentid,:bookid)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(':studentid',$studentid,PDO::PARAM_STR);
                  $stmt->bindParam(':bookid',$bookid,PDO::PARAM_STR);
                     $_SESSION['success_flash']="Author Added";
                  if(isset($_GET['edit'])){
                     $sql = "UPDATE issuedbook SET StudentID=:studentid,BookId=:bookid WHERE id=:id";
                     $stmt = $conn->prepare($sql);
                     $stmt->bindParam(':studentid',$studentid,PDO::PARAM_STR);
                     $stmt->bindParam(':bookid',$bookid,PDO::PARAM_STR);
                     $stmt->bindParam(':id',$id, PDO::PARAM_STR);
                  }
                  $stmt->execute();

            }
            header('Location:issued.php');
         }




   ?>



               <section class="content-header">
                  <h2 class="text-center"><?= ((isset($_GET['edit']))?'Edit Issued':'Issue');?> Books</h2>
               </section><hr>
               <!-- main content -->
               <section class="content">
                  <div class="row">
                     <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h3 class="panel-title text-center">Issue Book info</h3>

                          </div>
                          <div class="panel-body">

                            <form class="" action="" id="search" method="post">
                               <div class="form-group">
                                  <label for="">Student Matric Number<span style="color:red;">*</span></label>
                                  <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off" value="<?=$studentid;?>" required />
                               </div>
                               <div class="form-group">
                                  <span id="get_student_name" style="font-size:16px;"></span>
                              </div>
                               <div class="form-group">
                                  <select class="form-control" name="category" id="category">
                                     <option value="">Select Book Category</option>
                                     <?php
                                       $status=1;
                                       $sql = "SELECT * FROM  categories WHERE Status=:status";
                                       $query = $conn-> prepare($sql);
                                       $query -> bindParam(':status',$status, PDO::PARAM_STR);
                                       $query->execute();
                                       $results=$query->fetchAll(PDO::FETCH_ASSOC);
                                       $cnt=1;
                                       if($query->rowCount() > 0)
                                       {
                                          foreach($results as $result)
                                          { ?>
                                     <option value="<?=$result['id'];?>"><?=$result['CategoryName'];?></option>
                                  <?php }} ?>
                                  </select>
                               </div>
                               <div class="form-group">
                                  <label for="">Select Book</label>
                                  <select class="form-control" name="bookid" id="book" value="<?=$bookid;?>"> </select>
                               </div>
                               <div class="form-group">
                                   <div class="row">
                                      <div class="col-md-3">

                                      </div>
                                   </div>
                               </div>
                                <a href = "issued.php" class="btn btn-default">Cancel</a>
                               <input type="submit" value="<?= ((isset($_GET['edit']))?'Edit Issued':'Issue');?> Book" class="btn btn-sm btn-primary">
                            </form>
                          </div>
                        </div>
                     </div>
                  </div>
               </section>
   <?php }else{ ?>
            <section class="content-header">
               <h2 class="text-center">Manage Issued Books</h2>
            </section>
            <section class="content">
               <div class="panel panel-primary">
                 <div class="panel-heading">
                   <h3 class="panel-title text-center" >Books List</h3>
                    <a href="issued.php?add=1" class="btn btn-success">Issue Book</a>
                 </div>
                 <div class="panel-body">
                    <div class="table-responsive">
                       <table class="table table-condensed table-striped table-bordered"  id="dataTables-example">
                          <thead>
                             <th>#</th><th>Student Name</th><th>Category</th><th>Book Title</th><th>Issued Date</th><th>Return Date</th> <th></th>
                          </thead>
                          <tbody>
                             <?php
                              $sql = "SELECT students.FullName,books.BookName,books.ISBNNumber,issuedbook.IssuesDate,issuedbook.ReturnDate,issuedbook.id as rid from  issuedbook join students on students.StudentId=issuedbook.StudentId join books on books.id=issuedbook.BookId order by issuedbook.id desc";
                              $stmt = $conn->prepare($sql);
                              $stmt->execute();
                              $results =$stmt->fetchAll(PDO::FETCH_ASSOC);
                              $sn =1;
                                 foreach ($results as $result):?>
                             <tr>
                                <td><?=$sn;?></td>
                                <td><?= $result['FullName'];?></td>
                                <td><?= $result['BookName'];?></td>
                                <td><?= $result['ISBNNumber'];?></td>
                                <td><?= $result['IssuesDate'];?></td>
                                <td><?if($result['ReturnDate'] == ''){
                                        echo "Not Return Yet";
                                       }else{
                                          echo $result['ReturnDate'];
                                       }?></td>
                                <td>
                                   <a href="issued.php?edit=<?=$result['rid'];?>"><span class="glyphicon glyphicon-pencil btn btn-success"></span></a>
                                   <a href="issued.php?delete=<?=$result['rid'];?>"><span class="glyphicon glyphicon-remove-sign btn btn-danger"></span></a>

                                </td>
                             </tr>
                             <?php $sn +=1;
                          endforeach; ?>
                          </tbody>
                       </table>
                    </div>
                 </div>
               </div>
            </section>
   <?php }?>
   </div>
 <?php include('../includes/footer.php');?>
