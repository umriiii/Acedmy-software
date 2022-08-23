<?php  
 include '../config/db.php';  
 $sql = "DELETE FROM subjects WHERE subjectid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>