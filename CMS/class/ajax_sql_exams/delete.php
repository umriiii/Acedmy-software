<?php  
 include '../config/db.php';  
 $sql = "DELETE FROM exams WHERE examid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>