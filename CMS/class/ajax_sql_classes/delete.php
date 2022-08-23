<?php  
 include '../config/db.php';  
 $sql = "DELETE FROM class WHERE classid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>