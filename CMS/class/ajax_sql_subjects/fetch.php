 <?php  
 //fetch.php  
 include '../config/db.php';  
 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT A.subjectid,A.class_id,A.sub_tec_id,A.sub_name,B.firstname,B.lastname,C.class_name 
      FROM subjects as A
      inner join teacher as B on A.sub_tec_id = B.teacherid
      inner join class as C on A.class_id = C.classid
      WHERE A.subjectid = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);
 }  
 ?>