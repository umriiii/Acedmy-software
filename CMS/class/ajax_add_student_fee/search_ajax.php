<?php
 
//Including Database configuration file.
 
include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT A.stu_first_name,A.stu_last_name,A.stu_reg_no,B.class_name,A.address,A.phone,A.create_on,C.submit_on,C.status,C.student_fee,C.feeid FROM students as A inner join class as B on A.class_id=B.classid inner join student_fee as C on A.studentid=C.student_id WHERE (CONCAT(A.stu_first_name, ' ', A.stu_last_name)  LIKE '%$Name%' OR A.stu_last_name LIKE '%$Name%' OR A.stu_reg_no  LIKE '%$Name%' OR A.create_on  LIKE '%$Name%' OR C.submit_on  LIKE '%$Name%' OR C.status  LIKE '%$Name%' OR B.class_name  LIKE '%$Name%') AND Month(C.submit_on) = Month(NOW())";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->
 
   
 
  <table class="table table-bordered table-hover table-striped">
       <tr>
        <th width="10%">#S.No</th> 
       <th width="30%">Student Name</th> 
       <th width="30%">Father Name</th> 
       <th width="30%">Roll No</th>   
       <th width="30%">Class</th> 
       <th width="30%">Total Fee</th> 
       <th width="30%">Fee Status</th>
       <th width="30%">submission Date</th>  
 
       
       <th width="30%" colspan="3">Action</th>
     </tr> 
  
 
   <!-- //Fetching result from database. -->
 <?php
 $i=0;
 $count=mysqli_num_rows($ExecQuery);
 if ($count==0) {
   echo "Data not found";
 } else {
    
   while ($row1 = MySQLi_fetch_array($ExecQuery)) {
 $i++;
       ?>
 
   <!-- Creating unordered list items.
 
        Calling javascript function named as "fill" found in "script.js" file.
 
        By passing fetched result as parameter. -->
 <tr id="<?php echo $row1['feeid']; ?>">
        <td><?php echo $i; ?></td>
       <td  data-target="teachername"><?php echo $row1["stu_first_name"]; ?></td>
       <td  data-target="teachername"><?php echo $row1["stu_last_name"]; ?></td>
       <td><?php echo $row1["stu_reg_no"]; ?></td>
       <td><?php echo $row1["class_name"]; ?></td>
       <td><?php echo $row1["student_fee"]; ?></td>
        <td ><?php echo $row1["status"]; ?></td>
       <td><?php echo $row1["submit_on"]; ?></td>
       
 
      <td><input type="button" name="view" value="view" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
         <td><a href="reports/fee_slip.php?feeid=<?php echo $row1["feeid"]; ?>" target="_blank"><input type="button" name="view" onmouseup="bleep.play()" value="Fee Slip" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm" /></a></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row1["feeid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php
 
}
 }


}
 
 
?>
 </table> 
<?php
if (isset($_POST['previous_fee'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['previous_fee'];
//Search query.
 
   $Query = "SELECT A.stu_first_name,A.stu_last_name,A.stu_reg_no,B.class_name,A.address,A.phone,A.create_on,C.submit_on,C.status,C.student_fee,C.feeid FROM students as A inner join class as B on A.class_id=B.classid inner join student_fee as C on A.studentid=C.student_id WHERE CONCAT(A.stu_first_name, ' ', A.stu_last_name)  LIKE '%$Name%' OR A.stu_last_name LIKE '%$Name%' OR A.stu_reg_no  LIKE '%$Name%' OR A.create_on  LIKE '%$Name%' OR C.submit_on  LIKE '%$Name%' OR C.status  LIKE '%$Name%' OR B.class_name  LIKE '%$Name%'";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->
 
   
 
  <table class="table table-bordered table-hover table-striped">
       <tr>
        <th width="10%">#S.No</th> 
       <th width="30%">Student Name</th> 
       <th width="30%">Father Name</th> 
       <th width="30%">Roll No</th>   
       <th width="30%">Class</th> 
       <th width="30%">Total Fee</th> 
       <th width="30%">Fee Status</th>
       <th width="30%">submission Date</th>  
 
       
       <th width="30%" colspan="3">Action</th>
     </tr> 
  
 
   <!-- //Fetching result from database. -->
 <?php
 $i=0;
 $count=mysqli_num_rows($ExecQuery);
 if ($count==0) {
   echo "Data not found";
 } else {
    
   while ($row1 = MySQLi_fetch_array($ExecQuery)) {
 $i++;
       ?>
 
   <!-- Creating unordered list items.
 
        Calling javascript function named as "fill" found in "script.js" file.
 
        By passing fetched result as parameter. -->
 <tr id="<?php echo $row1['feeid']; ?>">
        <td><?php echo $i; ?></td>
       <td  data-target="teachername"><?php echo $row1["stu_first_name"]; ?></td>
       <td  data-target="teachername"><?php echo $row1["stu_last_name"]; ?></td>
       <td><?php echo $row1["stu_reg_no"]; ?></td>
       <td><?php echo $row1["class_name"]; ?></td>
       <td><?php echo $row1["student_fee"]; ?></td>
        <td ><?php echo $row1["status"]; ?></td>
       <td><?php echo $row1["submit_on"]; ?></td>
       
 
      <td><input type="button" name="view" value="view" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
         <td><a href="reports/fee_slip.php?feeid=<?php echo $row1["feeid"]; ?>" target="_blank"><input type="button" name="view" onmouseup="bleep.play()" value="Fee Slip" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm" /></a></td>
      </tr>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php
 
}
 }


}
 
 
?>
 </table> 