<?php
include('layout/master.php');?>
   <div class="content-wrapper">
      <section class="content-header">
         <h2 class="text-center">DashBoard</h2>
      </section><hr>
      <!-- main content -->
      <section class="content">
         <div class="row">
            <div class="col-md-3">
               <div class="small-box bg-aqua">
                  <div class="inner">
                     <?php
                        $sql="SELECT * FROM books";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row=$stmt->fetchAll();
                     ?>
                     <h3><?=count($row);?></h3>
                     <p>Listed Books</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-book"></i>
                  </div>
                  <a href="#" class="small-box-footer">More Info<i class="fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!--authors  -->
            <div class="col-md-3">
               <div class="small-box bg-yellow">
                  <div class="inner">
                     <?php
                        $sql="SELECT * FROM authors";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row=$stmt->fetchAll();
                     ?>
                     <h3><?=count($row);?><sup style="font-size: 20px"></sup></h3>
                     <p>Listed Authors</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-users"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info<i class="fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- Category -->
            <div class="col-md-3">
               <div class="small-box bg-green">
                  <div class="inner">
                     <?php
                        $sql="SELECT * FROM categories";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row=$stmt->fetchAll();
                     ?>
                     <h3><?=count($row);?><sup style="font-size: 20px"></sup></h3>
                     <p>Listed Categories</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-file-archive-o"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info<i class="fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- students -->
            <div class="col-md-3">
               <div class="small-box bg-danger">
                  <div class="inner">
                     <?php
                        $sql="SELECT * FROM students";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row=$stmt->fetchAll();
                     ?>
                     <h3><?=count($row);?><sup style="font-size: 20px"></sup></h3>
                     <p>Register Students</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-user"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info<i class="fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- issued books -->
            <div class="col-md-3">
               <div class="small-box bg-purple">
                  <div class="inner">
                     <?php
                        $sql="SELECT * FROM issuedbook";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row=$stmt->fetchAll();
                     ?>
                     <h3><?=count($row);?><sup style="font-size: 20px"></sup></h3>
                     <p>Issued Books</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info<i class="fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- Return books -->
            <div class="col-md-3">
               <div class="small-box bg-primary">
                  <div class="inner">
                     <?php
                        $sql="SELECT * FROM issuedbook WHERE ReturnStatus = 1";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $row=$stmt->fetchAll();
                     ?>
                     <h3><?=count($row);?><sup style="font-size: 20px"></sup></h3>
                     <p>Return Books</p>
                  </div>
                  <div class="icon">
                     <i class="fa fa-recycle"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info<i class="fa-arrow-circle-right"></i></a>
               </div>
            </div>
         </div>
      </section>
   </div>


 <?php include('../includes/footer.php');?>
