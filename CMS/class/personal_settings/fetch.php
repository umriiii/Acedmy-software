 <?php  
 //fetch.php  
  include '../config/db.php';  
 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT * FROM settings WHERE settingid = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>