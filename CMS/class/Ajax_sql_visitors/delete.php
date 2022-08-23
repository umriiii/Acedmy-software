<?php  
  include '../config/db.php';  
 $sql = "DELETE FROM guest_student WHERE id = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>