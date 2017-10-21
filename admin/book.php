<?php
include('layout/master.php');
   if(isset($_GET['delete'])){
   $id = (int)$_GET['delete'];
   $sql = "DELETE FROM books WHERE id=:id";
   $stmtdel = $conn->prepare($sql);
   $stmtdel->bindParam('id', $id, PDO::PARAM_STR);
   $stmtdel->execute();
   $_SESSION['success_flash']="Author Deleted";
   header('Location:book.php');
}
?>
   <div class="content-wrapper">
<?php   if (isset($_GET['add']) || isset($_GET['edit'])) {
            $book = ((isset($_POST['book']))?$_POST['book']:'');
            $category = ((isset($_POST['category']))?$_POST['category']:'');
            $author = ((isset($_POST['author']))?$_POST['author']:'');
            $isbn = ((isset($_POST['isbn']))?$_POST['isbn']:'');
            $price = ((isset($_POST['price']))?$_POST['price']:'');
            if (isset($_GET['edit'])) {
               $id = (int)$_GET['edit'];
              $sql = "SELECT * FROM books WHERE id =:id";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $id, PDO::PARAM_STR);
              $stmt->execute();
              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($results as $result){}
              $book = ((isset($_POST['book']) && $_POST['book'] !='')?$_POST['book']:show($result['BookName']));
              $category = ((isset($_POST['category']) && $_POST['category'] !='')?$_POST['category']:show($result['CatId']));
              $author = ((isset($_POST['author']) && $_POST['author'] !='')?$_POST['author']:show($result['AuthorId']));
              $isbn = ((isset($_POST['isbn']) && $_POST['isbn'] !='')?$_POST['isbn']:show($result['ISBNNumber']));
              $price = ((isset($_POST['price']) && $_POST['price'] !='')?$_POST['price']:show($result['BookPrice']));
            }
            $errors = [];
             if($_POST){
                if(isset($_GET['edit'])){

                }else{
                   $query = "SELECT * FROM books WHERE BookName=:book";
                   $stmt= $conn->prepare($query);
                   $stmt->bindParam(':book',$book, PDO::PARAM_STR);
                   $stmt->execute();
                   $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   if($stmt->rowCount() != 0){
                      $errors[]="book already exist";
                   }
                }
                if(!empty($errors)){
                   echo display_error($errors);
                }else{
                  $sql="INSERT INTO books(BookName,CatId,AuthorId,ISBNNumber,BookPrice) VALUES(:book,:catid,:authorid,:isbn,:bookprice)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(':book',$book, PDO::PARAM_STR);
                  $stmt->bindParam(':catid',$category, PDO::PARAM_STR);
                  $stmt->bindParam(':authorid',$author, PDO::PARAM_STR);
                  $stmt->bindParam(':isbn',$isbn, PDO::PARAM_STR);
                  $stmt->bindParam(':bookprice',$price, PDO::PARAM_STR);
                     //  $_SESSION['success_flash']="Author Added";
                   if(isset($_GET['edit'])){
                      $sql = "UPDATE books SET BookName=:book,CatId=:catid,AuthorId=:authorid,ISBNNumber=:isbn,BookPrice=:bookprice WHERE id=:id";
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(':book',$book, PDO::PARAM_STR);
                     $stmt->bindParam(':catid',$category, PDO::PARAM_STR);
                     $stmt->bindParam(':authorid',$author, PDO::PARAM_STR);
                     $stmt->bindParam(':isbn',$isbn, PDO::PARAM_STR);
                     $stmt->bindParam(':bookprice',$price, PDO::PARAM_STR);
                      $stmt->bindParam(':id',$id, PDO::PARAM_STR);
                   }
                   $stmt->execute();

             }
             header('Location:book.php');
          }
   ?>
         <section class="content-header">
            <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add');?> Books</h2>
         </section><hr>
         <!-- main content -->
         <section class="content">
            <div class="row">
               <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-info">
                       <div class="panel-heading">
                         <h3 class="panel-title">Book Info</h3>
                       </div>
                       <div class="panel-body">
                          <form class="" action="" method="post">
                            <div class="form-group">
                               <label for="book">Book Name</label>
                               <input type="text" name="book"  class="form-control" value="<?=$book;?>">
                            </div>
                            <div class="form-group">
                               <select class="form-control" name="category">
                                     <option value="">Select Caregory</option>
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
                               <select class="form-control" name="author">
                                     <option value="">Select Author</option>
                                     <?php

                                       $sql = "SELECT * FROM  authors";
                                       $query = $conn-> prepare($sql);
                                       $query->execute();
                                       $results=$query->fetchAll(PDO::FETCH_ASSOC);
                                       $cnt=1;
                                       if($query->rowCount() > 0)
                                       {
                                          foreach($results as $result)
                                          { ?>
                                     <option value="<?=$result['id'];?>"><?=$result['author_name'];?></option>
                                  <?php }} ?>
                               </select>
                            </div>
                            <div class="form-group">
                               <label for="">ISBN Number</label>
                               <input type="text" name="isbn" class="form-control" value="<?=$isbn;?>">
                            </div>
                            <div class="form-group">
                               <label for="">Price</label>
                               <input type="text" name="price" class="form-control" value="<?=$price;?>">
                            </div>
                            <a href = "book.php" class="btn btn-default">Cancel</a>
                            <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Book" class="btn btn-info btn-sm">
                         </form>
                       </div>
                     </div>
               </div>

            </div>
         </section>
      <?php }else{ ?>
         <section class="content-header">
            <h2 class="text-center">Manage Books</h2>
         </section>
         <section class="content">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title text-center">Books List</h3>
                <a href="book.php?add=1" class="btn btn-primary">Add Book</a>
              </div>
              <div class="panel-body">
                 <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered"  id="dataTables-example">
                       <thead>
                          <th>#</th><th>Book Name</th><th>Category</th><th>Author</th><th>ISBN Number</th><th>Price</th> <th></th>
                       </thead>
                       <tbody>
                          <?php
                            $sql = "SELECT * FROM books";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $results =$stmt->fetchAll(PDO::FETCH_ASSOC);
                            $sn =1;
                               foreach ($results as $result):?>
                          <tr>
                             <td><?=$sn;?></td>
                             <td><?=$result['BookName'];?></td>
                             <td><?=$result['CatId'];?></td>
                             <td><?=$result['AuthorId'];?></td>
                             <td><?=$result['ISBNNumber'];?></td>
                             <td><?=$result['BookPrice'];?></td>
                             <td>
                                <a href="book.php?edit=<?=$result['id'];?>"><span class="glyphicon glyphicon-pencil btn btn-success"></span></a>
                                <a href="book.php?delete=<?=$result['id'];?>"><span class="glyphicon glyphicon-remove-sign btn btn-danger"></span></a>

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
 <?php include('../includes/footer.php');?>
