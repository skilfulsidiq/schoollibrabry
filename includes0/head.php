<?php ob_start(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Library|Home</title>
      <link rel="stylesheet" href="asset/css/bootstrap.min.css">
      <link href="asset/css/font-awesome.css" rel="stylesheet" />
      <link href="asset/css/skins/_all-skins.min.css" rel="stylesheet" />
      <link href="asset/css/AdminLTE.min.css" rel="stylesheet" />
       <link href="asset/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <!-- <link rel="stylesheet" href="plugins/iCheck/flat/blue.css"> -->
        <!-- Morris chart -->
        <!-- <link rel="stylesheet" href="plugins/morris/morris.css"> -->
        <!-- jvectormap -->
        <!-- <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
        <!-- Date Picker -->
        <!-- <link rel="stylesheet" href="plugins/datepicker/datepicker3.css"> -->
        <!-- Daterange picker -->
        <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
        <!-- bootstrap wysihtml5 - text editor -->
        <!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
      <script src="asset/js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript">
      // function for get student name
         function getstudent() {
         $("#loaderIcon").show();
         jQuery.ajax({
         url: "../admin/ajaxstudent.php",
         data:'studentid='+$("#studentid").val(),
         type: "POST",
         success:function(data){
         $("#get_student_name").html(data);
         $("#loaderIcon").hide();
         },
         error:function (){
            alert("something went wrong");
         }
         });
         }
      </script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#dataTables-example').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

   </head>
   <body class="hold-transition skin-blue sidebar-mini">
