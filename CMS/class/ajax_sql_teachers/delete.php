<?php  
 include '../config/db.php';  
 $sql = "DELETE FROM teacher WHERE teacherid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>