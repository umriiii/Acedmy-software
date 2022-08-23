 <?php  
 //fetch.php  
include '../config/db.php';  
 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT A.feeid,A.student_fee,A.status,B.stu_first_name,B.stu_last_name,B.phone,B.stu_reg_no,B.create_on,C.class_name FROM student_fee as A 
      inner join students as B 
      on A.student_id = B.studentid
      inner join class as C
      on B.class_id = C.classid 
      WHERE A.feeid = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>