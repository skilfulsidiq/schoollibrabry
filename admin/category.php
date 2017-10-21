<?php
session_start();
include('layout/master.php');
   if(isset($_GET['delete'])){
   $id = (int)$_GET['delete'];
   $sql = "DELETE FROM categories WHERE id=:id";
   $stmtdel = $conn->prepare($sql);
   $stmtdel->bindParam('id', $id, PDO::PARAM_STR);
   $stmtdel->execute();
   $_SESSION['success_flash']="Author Deleted";
   header('Location:author.php');

} ?>
   <div class="content-wrapper">
<?php   if (isset($_GET['add']) || isset($_GET['edit'])) {
         $category = ((isset($_POST['category']))?$_POST['category']:'');
         if (isset($_GET['edit'])){
           $id = (int)$_GET['edit'];
           $sql = "SELECT * FROM categories WHERE id =:id";
           $stmt = $conn->prepare($sql);
           $stmt->bindParam(':id', $id, PDO::PARAM_STR);
           $stmt->execute();
           $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           foreach($results as $result){
         $category = ((isset($_POST['category']) && $_POST['category'] !='')?$_POST['category']:show($result['CategoryName']));}
         }
         $errors = [];
          if($_POST){
             if(isset($_GET['edit'])){

             }else{
                $query = "SELECT * FROM categories WHERE CategoryName=:category";
                $stmt= $conn->prepare($query);
                $stmt->bindParam(':category',$category, PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($stmt->rowCount() != 0){
                   $errors[]="category already exist";
                }
             }
             if(!empty($errors)){
                echo display_error($errors);
             }else{
                $status=$_POST['status'];
                $sql="INSERT INTO categories(CategoryName, Status) VALUES(:category,:status)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':category',$category, PDO::PARAM_STR);
                 $stmt->bindParam(':status',$status, PDO::PARAM_STR);
                   $_SESSION['success_flash']="Category Added";
                if(isset($_GET['edit'])){
                   $sql = "UPDATE categories SET CategoryName=:category, Status=:status WHERE id=:id";
                   $stmt = $conn->prepare($sql);
                   $stmt->bindParam(':category',$category, PDO::PARAM_STR);
                   $stmt->bindParam(':status',$status, PDO::PARAM_STR);
                   $stmt->bindParam(':id',$id, PDO::PARAM_STR);
                    $_SESSION['success_flash']="Category Updated";
                }
                $stmt->execute();

          }
          header('Location:category.php');
       }



?>
         <section class="content-header">
            <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add');?> Category</h2>
         </section><hr>
         <!-- main content -->
         <section class="content">
            <div class="row">
               <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-success">
                     <div class="panel-heading">
                      <h3 class="panel-title">Category Info</h3>
                     </div>
                     <div class="panel-body">
                        <form role="form" action="" method="post">
                           <div class="form-group">
                              <label for="">Category Name</label>
                              <input type="text" name="category"  class="form-control" value="<?=show($category);?>" required>
                           </div>
                           <div class="form-group">
                              <label>Status:</label>
                                 <div class="form-group">
                                    <label>Active</lable>
                                    <input type="radio"  name="status" value="1" checked="checked" id="status">
                                 </div>
                                 <div class="form-group">
                                    <label>Inactive</lable>
                                    <input type="radio"  name="status" value="0"  id="status">
                                 </div>
                           </div>
                               <a href = "category.php" class="btn btn-default">Cancel</a>
                              <input type="submit" name="add_category" value="<?=((isset($_GET['edit']))?'Edit':'Add');?>Category" class="btn btn-success btn-sm">
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      <?php }else{
         ?>
         <section class="content-header">
            <h2 class="text-center">Manage Category</h2>
         </section>
         <section class="content">
            <div class="panel panel-success">
               <div class="panel-heading">
                   <h3 class="panel-title text-center">Category Info</h3>
                    <a href = "category.php?add=1" class="btn btn-primary btn-sm " id="add-user-btn">Add New Category</a>
               </div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <table class="table table-condensed table-striped table-bordered"  id="dataTables-example">
                        <thead>
                           <th>#</th><th>Category</th><th>Status</th><th>Creation Date</th><th>Update date</th><th></th>
                        </thead>
                        <tbody>
                           <?php
                              $sql = "SELECT * FROM categories";
                              $stmt = $conn->prepare($sql);
                              $stmt->execute();
                              $results =$stmt->fetchAll(PDO::FETCH_ASSOC);
                              $sn =1;
                              foreach ($results as $result):?>
                           <tr>
                              <td><?=$sn;?></td>
                              <td><?=$result['CategoryName'];?></td>
                              <td><?=$result['Status'];?></td>
                              <td><?=$result['CreationDate'];?></td>
                              <td><?=$result['UpdationDate'];?></td>
                              <td>
                                 <a href="category.php?edit=<?=$result['id'];?>"><span class="glyphicon glyphicon-pencil btn btn-success"></span></a>
                                 <a href="category.php?delete=<?=$result['id'];?>"><span class="glyphicon glyphicon-remove-sign btn btn-danger"></span></a>

                              </td>
                           </tr>
                           <?php $sn +=1;
                        endforeach;?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </section>
    <?php } ?>
   </div>
 <?php include('../includes/footer.php');
?>
