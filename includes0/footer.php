
   </div>
<script type="text/javascript"src="asset/js/bootstrap.min.js"></script>
<script type="text/javascript"src="asset/js/app.min.js"></script>
<script type="text/javascript"src="asset/js/demo.min.js"></script>
<!-- DATATABLE SCRIPTS  -->
   <script src="asset/js/dataTables/jquery.dataTables.js"></script>
   <script src="asset/js/dataTables/dataTables.bootstrap.js"></script>
   <script type="text/javascript">
   function get_book_option(){
         var categoryID = jQuery('#category').val();
         jQuery.ajax({
           url : '../admin/ajaxbook.php',
           type : 'POST',
           data : {'categoryID' : categoryID},
           success:function(data){
             jQuery('#book').html(data);
           },
           error: function(){alert("Something went wrong")},
         });
       }
 jQuery('select[name = "category"]').change(function(){
   get_book_option();
 });
</script>
</body>
</html>
