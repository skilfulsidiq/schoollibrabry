<?php
session_start();
include('layout/master.php');
   if(isset($_GET['delete'])){
   $id = (int)$_GET['delete'];
   $sql = "DELETE FROM authors WHERE id=:id";
   $stmtdel = $conn->prepare($sql);
   $stmtdel->bindParam('id', $id, PDO::PARAM_STR);
   $stmtdel->execute();
   // $_SESSION['success_flash']="Author Deleted";
   header('Location:author.php');

} ?>

<div class="content-wrapper">
   <!-- if add button oe edit is clicked show form -->
<?php   if (isset($_GET['add']) || isset($_GET['edit'])) {
            $author = ((isset($_POST['author']))?$_POST['author']:'');
            if (isset($_GET['edit'])){
              $id = (int)$_GET['edit'];
              $sql = "SELECT * FROM authors WHERE id =:id";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $id, PDO::PARAM_STR);
              $stmt->execute();
              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($results as $result){}
              $author = ((isset($_POST['author']) && $_POST['author'] !='')?$_POST['author']:show($result['author_name']));
           }
           $errors = [];
            if($_POST){
               if(isset($_GET['edit'])){

               }else{
                  $query = "SELECT * FROM authors WHERE author_name=:author";
                  $stmt= $conn->prepare($query);
                  $stmt->bindParam(':author',$author, PDO::PARAM_STR);
                  $stmt->execute();
                  $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  if($stmt->rowCount() != 0){
                     $errors[]="author already exist";
                  }
               }
               if(!empty($errors)){
                  echo display_error($errors);
               }else{
                  $sql="INSERT INTO authors(author_name) VALUES(:author)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(':author',$author, PDO::PARAM_STR);
                     $_SESSION['success_flash']="Author Added";
                  if(isset($_GET['edit'])){
                     $sql = "UPDATE authors SET author_name=:author WHERE id=:id";
                     $stmt = $conn->prepare($sql);
                     $stmt->bindParam(':author',$author, PDO::PARAM_STR);
                     $stmt->bindParam(':id',$id, PDO::PARAM_STR);
                  }
                  $stmt->execute();

            }
            header('Location:author.php');
         }


   ?>
         <section class="content-header">
            <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit': 'Add');?> Author</h2>
         </section><hr>
         <!-- main content -->
         <section class="content">
            <div class="row">
               <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title"> <?=((isset($_GET['edit']))?'Edit':'Add');?> Author</h3>
                    </div>
                    <div class="panel-body">
                       <form class="form" method="post">
                          <div class="form-group">
                             <label>Author Name</label>
                             <input type="text" name="author" class="form-control" value="<?php echo $author;?>" required>
                          </div>
                          <div class="form-group">
                             <a href = "author.php" class="btn btn-default">Cancel</a>
                             <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add')?> Author" class="btn  btn-sm btn-primary">
                          </div>
                       </form>
                    </div>
                  </div>
               </div>
            </div>
         </section>
   <?php }else{
      ?>
         <!--else show  VIew ATHORS table -->
         <section class="content-header">
            <h4 class="text-center">Manage Authors</h4>
         </section>
         <section class="content">
            <div class="panel panel-info">
               <div class="panel-heading">
                 <h3 class="panel-title text-center"> Authors' List</h3>
                 <a href = "author.php?add=1" class="btn btn-primary btn-sm " id="add-user-btn">Add New Author</a>
               </div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <table class="table table-condensed table-striped table-bordered"  id="dataTables-example">
                        <thead>
                           <th>#</th><th>Author</th><th>Creation Date</th><th>Update date</th><th></th>
                        </thead>
                        <tbody><?php
                           $sql = "SELECT * FROM authors";
                           $stmt = $conn->prepare($sql);
                           $stmt->execute();
                           $results =$stmt->fetchAll(PDO::FETCH_ASSOC);
                           $sn =1;
                              foreach ($results as $result):?>
                           <tr>
                              <td><?=$sn;?></td>
                              <td><?=show($result['author_name']);?></td>
                              <td><?=show($result['creationDate']);?></td>
                              <td><?=show($result['UpdationDate']);?></td>
                              <td>
                                 <a href="author.php?edit=<?=show($result['id']);?>"><span class="glyphicon glyphicon-pencil btn btn-success"></span></a>
                                 <a href="author.php?delete=<?=show($result['id']);?>"><span class="glyphicon glyphicon-remove-sign btn btn-danger"></span></a>

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
  <?php } ?>
</div>
<?php include('../includes/footer.php'); ?>
