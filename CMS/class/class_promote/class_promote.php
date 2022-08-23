<?php 
  include '../config/db.php';
$new_id = $_POST['new_id'];
$old_id = $_POST['old_id'];
 $query = mysqli_query($connect,"UPDATE students   
           SET class_id='$new_id'
           WHERE class_id='$old_id'");  
           echo '<div class="alert alert-success" id="message">Data Updated</div>';

 ?>
 <script type="text/javascript">
  $( document ).ready(function(){
            $('#message').fadeIn('slow', function(){
               $('#message').delay(2000).fadeOut(); 
            });
        });
</script>