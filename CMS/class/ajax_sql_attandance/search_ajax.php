<?php
 
//Including Database configuration file.
 
 include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT B.stu_first_name,B.stu_last_name,B.phone,B.stu_reg_no,C.class_name,A.status,A.time_to_show,A.student_id FROM attandance as A inner join students as B on A.student_id = B.studentid inner join class as C on B.class_id = C.classid WHERE   CONCAT(B.stu_first_name, ' ', B.stu_last_name)  LIKE '%$Name%' OR C.class_name  LIKE '%$Name%' OR A.status LIKE '%$Name%' OR B.stu_reg_no LIKE '%$Name%' OR A.time_to_show LIKE '%$Name%' ORDER BY A.time_to_show DESC";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->
 
   <br>
 
  <table class="table table-bordered">
     <tr>
    <th>#</th>
    <th>R.ID</th>
    <th>Student name</th>
    <th>Father name</th>
    <th>Class</th>
    <th>Status</th>
    <th>Contact No</th>
    <th>Date</th>
    <th colspan="2">Action</th>
  </tr>
  
 
   <!-- //Fetching result from database. -->
 <?php
 $i=0;
 $count=mysqli_num_rows($ExecQuery);
 if ($count==0) {
   echo "Data not found";
 } else {
    
   while ($value = MySQLi_fetch_array($ExecQuery)) {
 $i++;
       ?>
 
   <!-- Creating unordered list items.
 
        Calling javascript function named as "fill" found in "script.js" file.
 
        By passing fetched result as parameter. -->
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo $value['stu_reg_no']; ?></td>
  <td><?php echo $value['stu_first_name']; ?></td>
  <td><?php echo $value['stu_last_name']; ?></td>
  <td><?php echo $value['class_name']; ?></td>
  <td><?php echo $value['status']; ?></td>
  <td><?php echo $value['phone']; ?></td>
  <td><?php echo $value['time_to_show']; ?></td>
       <td><input type="button" name="absent" value="Absent" id="<?php echo $value["student_id"]; ?>" class="btn btn-danger btn-sm absent" /></td>
       <td><input type="button" name="leave" value="Leave" id="<?php echo $value["student_id"]; ?>" class="btn btn-success btn-sm leave" /></td>
</tr>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php
 
}
 }


}
 
 
?>
 </table> 

