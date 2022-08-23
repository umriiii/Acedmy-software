<?php
 
//Including Database configuration file.
 
 include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT 
   A.class_id,
   A.studentid,
   A.stu_first_name,
   A.stu_last_name,
   A.stu_reg_no,
   A.address,
   A.phone,
   A.create_on,
   B.running_status,
   B.classid
    FROM students AS A inner join
     class AS B on A.class_id = B.classid
     WHERE B.running_status = 'Active'
     AND (CONCAT( A.stu_first_name,' ',A.stu_last_name)  
     LIKE '%$Name%' OR  A.stu_reg_no  
     LIKE '%$Name%' OR A.address 
     LIKE '%$Name%' OR A.create_on 
     LIKE '%$Name%')";
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->

  <table class="table table-bordered">
      <tr>
        <th width="10%">#S.No</th>
        <th width="30%">image</th>  
       <th width="30%">Student name</th>    
       <th width="30%">Father name</th>    
       <th width="30%">Address</th>
       <th width="20%">Phone Number</th>
       <th width="30%">roll num</th>
       <th width="30%" colspan="4">Action</th>
      </tr>
  
 
   <!-- //Fetching result from database. -->
 <?php
 $count=mysqli_num_rows($ExecQuery);
 if ($count==0) {
   echo "Data not found";
 } else {
    $i = 0;
   while ($row = MySQLi_fetch_array($ExecQuery)) {
 $i++;
       ?>
 
   
 <tr>
        <td>  <?php   echo $i; ?></td>
          <td><img src="class/ajax_sql_students/students_upload/<?php echo $row['image']; ?>" height="50" width="100" class="img-thumbnail" /></td>
       <td><?php echo $row["stu_first_name"];?></td>
       <td><?php echo $row["stu_last_name"];?></td>
       <td><?php echo $row["address"]; ?></td>
       <td><?php echo $row["phone"]; ?></td>
       <td><?php echo $row["stu_reg_no"]; ?></td>
       
       <td><input type="button" name="view" value="view" id="<?php echo $row["studentid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["studentid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["studentid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
       
       <!--  <td>
                <form  method="post">
                    <input type="hidden" style="border-radius: 0px;" name="text" class="form-control" autocomplete="off"  value="<?php echo $row[3]; ?>">
                    <button type="submit"  id="gen_card" class="btn btn-block btn-md btn-outline-success gen_id_card">Generate</button>
                </form>
        </td> -->
      </tr>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php
 
}
 }


}
 
 
?>
 </table> 

