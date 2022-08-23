<?php
 
//Including Database configuration file.
 
 include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT * FROM guest_student WHERE student_name  LIKE '%$Name%' OR address LIKE '%$Name%' OR add_status LIKE '%$Name%' OR class LIKE '%$Name%' OR source_info LIKE '%$Name%'";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->
 
   
 
  <table class="table table-bordered table-hover table-striped">
 <tr>
      <th>#</th>
      <th>Student Name</th>
      <th>Father Name</th>
      <th>Father Business</th>
      <th>Prevoius institute</th>
      <th>class</th>
      <th>Contact Number</th>
      <th>Address</th>
      <th>Source Info</th>
      <th>Stauts</th>
      <th colspan="3">Action</th>
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
<tr id="<?php echo $row['id']; ?>">
        <td><?php echo $i; ?></td>
        <td><?php echo $row["student_name"]; ?></td>
       <td><?php echo $row["father_name"]; ?></td>
       <td><?php echo $row["father_business"]; ?></td>
       <td><?php echo $row["previous_institute"]; ?></td>
       <td><?php echo $row["class"]; ?></td>
       <td><?php echo $row["contact_number"]; ?></td>
       <td><?php echo $row["address"]; ?></td>
       <td><?php echo $row["source_info"]; ?></td>
       <td><?php echo $row["Add_status"]; ?></td>
       
        <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php
 
}
 }


}
 
 
?>
 </table> 

