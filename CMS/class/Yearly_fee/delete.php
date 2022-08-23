<?php  
 include '../config/db.php';  
 $sql = "DELETE FROM yearly_fee WHERE yfeeid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>