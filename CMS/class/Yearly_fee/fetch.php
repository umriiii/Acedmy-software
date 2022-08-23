 <?php  
 //fetch.php  
  include '../config/db.php';  
 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT * FROM yearly_fee AS A Inner Join students AS B ON A.student_id = B.studentid Inner Join class AS C ON B.class_id = C.classid WHERE A.yfeeid = '".$_POST["employee_id"]."'";
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>