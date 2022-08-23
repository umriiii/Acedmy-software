<?php  
 include '../config/db.php';  
 $sql = "DELETE FROM settings WHERE settingid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>