<?php
 
//Including Database configuration file.
 
 include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT DISTINCT A.mark_obt,A.total_mark,A.comment,A.student_id,B.stu_first_name,B.stu_last_name,B.stu_reg_no,C.class_name,D.exam_name,E.sub_name FROM marks as A inner join students as B on 
  A.student_id=B.studentid inner join class as C on
  A.class_id=C.classid inner join exams as D on 
  A.exam_id=D.examid inner join subjects as E on
  A.subject_id=E.subjectid WHERE B.stu_reg_no LIKE '%$Name%' OR CONCAT(B.stu_first_name, ' ', B.stu_last_name) LIKE '%$Name%' OR B.stu_last_name LIKE '%$Name%' OR C.class_name LIKE '%$Name%' ";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->

  <table class="table table-bordered">
      <tr>  
                     <th width="5%">R.id</th>  
                     <th width="20%">Student Name</th>  
                     <th width="20%">Father Name</th>  
                     <th width="10%">Mark sheet</th>
                     <th width="10%">Print result</th>

                </tr>
  
 
   <!-- //Fetching result from database. -->
 <?php
 $i=0;
 $count=mysqli_num_rows($ExecQuery);
 if ($count==0) {
   echo "Data not found";
 } else {
    
  $row = MySQLi_fetch_array($ExecQuery)

       ?>
 
 <tr>  
                     <td><?php echo  $row["stu_reg_no"]; ?></td>
                     <td><?php echo $row["stu_first_name"]; ?></td>  
                     <td><?php echo $row["stu_last_name"]; ?></td>  
                      <td><input type="button" name="view" value="marksheet" id="<?php echo $row['student_id']; ?>" class="btn btn-info btn-sm view_data" /></td> 
                       <td><input type="button" name="send_result" value="Send Result" id="<?php echo $row["student_id"] ?>" class="btn btn-info btn-sm send_result" /></td> 
                     
                </tr>  
   <?php
 

 }


}
 
 
?>
 </table> 

