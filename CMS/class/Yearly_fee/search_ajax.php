<?php
 
//Including Database configuration file.
 
 include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT * 
    FROM yearly_fee AS A inner join
    students AS B ON A.student_id = B.studentid
    inner join class AS C on A.class_id = C.classid 
    WHERE B.stu_first_name  
    LIKE '%$Name%' OR B.stu_reg_no
    LIKE '%$Name%' OR C.class_name  
    LIKE '%$Name%'";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->
 
   
 
  <table class="table table-bordered">
      <tr>
       <th width="10%">#S.No</th>
         <th width="30%">Roll No</th> 
       <th width="30%">Student Name</th>    
       <th width="30%">Father Name</th>
       <th width="30%">Class</th>
       <th width="30%" colspan="3">Action</th>
      </tr>
  
 
   <!-- //Fetching result from database. -->
 <?php
 $i=0;
 $count=mysqli_num_rows($ExecQuery);
 if ($count==0) {
   echo "Data not found";
 } else {
    
   while ($row = MySQLi_fetch_array($ExecQuery)) {
 $i++;
       ?>
 
   <!-- Creating unordered list items.
 
        Calling javascript function named as "fill" found in "script.js" file.
 
        By passing fetched result as parameter. -->
 <tr>
        <td><?php echo $i; ?></td>
       <td  data-target="teachername"><?php echo $row["stu_reg_no"]; ?></td>
       <td  data-target="address"><?php echo $row["stu_first_name"]; ?></td>
       <td  data-target="address"><?php echo $row["stu_last_name"]; ?></td>
       <td  data-target="address"><?php echo $row["class_name"]; ?></td>
       <td><input type="button" name="view" value="view" id="<?php echo $row["yfeeid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["yfeeid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["yfeeid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php
 
}
 }


}
 
 
?>
 </table> 

