<?php
 
//Including Database configuration file.
 
 include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT * FROM teacher WHERE firstname  LIKE '%$Name%' OR lastname  LIKE '%$Name%' OR address LIKE '%$Name%' OR phone LIKE '%$Name%'";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->
 
   
 
  <table class="table table-bordered">
      <tr>
         <th width="10%">#S.No</th> 
         <th width="10%">Image</th> 
       <th width="30%">Teacher Name</th>    
       <th width="30%">Address</th>
       <th width="20%">Phone Number</th>
       <th width="30%">Email</th>
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
<tr id="<?php echo $row['teacherid']; ?>">
        <td><?php echo $i; ?></td>
        <td><img src="class/ajax_sql_teachers/files/<?php echo $row['image']; ?>" height="250" width="150" class="img-thumbnail" /></td>
       <td  onclick='fill("<?php echo $row[1]; ?>")'><?php echo $row["firstname"]." ".$row["lastname"] ; ?></td>
       <td  data-target="address"><?php echo $row["address"]; ?></td>
       <td  data-target="phone"><?php echo $row["phone"]; ?></td>
       <td  data-target="email"><?php echo $row["email"]; ?></td>
       <td><input type="button" name="view" value="view" id="<?php echo $row["teacherid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["teacherid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["teacherid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php
 
}
 }


}
 
 
?>
 </table> 

