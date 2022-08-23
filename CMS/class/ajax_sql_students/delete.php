<?php  
 include '../config/db.php'; 
 $sql = "DELETE FROM students WHERE studentid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>