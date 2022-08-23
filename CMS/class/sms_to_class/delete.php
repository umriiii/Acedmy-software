<?php  
  include '../config/db.php';

 $sql = "DELETE FROM sms_to_class WHERE smsid = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>