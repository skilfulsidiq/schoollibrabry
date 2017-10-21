<?php
define('HOST','localhost');
define('USER','skilfulsidiq');
define('PASS','humble');
define('DB', 'db_library');

try {
   $conn = new PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
   $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}catch (PDOException $e)
   {
   exit("Error: " . $e->getMessage());
   }

   function show($value){
      echo htmlentities($value);
   }

   function display_error($errors){
      $display ='<ul class="bg-danger" style="height:50px;">';
     foreach($errors as $error){
         $display .='<li class="text-danger">'.$error.'</li>';
     }
     $display .='</ul>';
     return $display;
   }

   //check the success flash session
if(isset($_SESSION['success_flash'])){
    echo '<div class="bg-success"><p class="text-success text-center" style="height:50px;">'.$_SESSION['success_flash'].'</p></div>';
    unset($_SESSION['success_flash']);
}
// //check for the erroe session
if(isset($_SESSION['error_flash'])){
    echo '<div class="bg-danger"><p class="text-danger text-center" style="height:50px;>'.$_SESSION['error_flash'].'</p></div>';
    unset($_SESSION['error_flash']);
}
