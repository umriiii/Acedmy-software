<?php  
 include '../config/db.php'; 
 $sql = "DELETE FROM student_fee WHERE feeid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>