<?php  
	include '../config/db.php'; 
	$id = $_POST["id"];  
	$text = $_POST["text"];  
	$column_name = $_POST["column_name"];  
	$sql = "UPDATE settings SET ".$column_name."='".$text."' WHERE settingid='".$id."'";  
	if(mysqli_query($connect, $sql))  
	{  
		echo '<div id="message" class="alert alert-success">Data Updated</div>';  
	}  
 ?>
 <script type="text/javascript">
  $( document ).ready(function(){
            $('#message').fadeIn('slow', function(){
               $('#message').delay(700).fadeOut(); 
            });
        });
</script>