<?php
 
//Including Database configuration file.
 
 include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT
    A.classid,
           A.class_name,
           A.class_fee,
           A.class_status,
           A.running_status,
           A.Date,
           B.firstname,
           B.lastname 
    FROM class As A inner join 
    teacher As B on A.teacher_id=B.teacherid 
    WHERE A.class_name  
    LIKE '%$Name%' OR B.firstname 
    LIKE '%$Name%' OR B.lastname  
    LIKE '%$Name%' OR A.running_status  
    LIKE '%$Name%' OR A.Date  
    LIKE '%$Name%'";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->
 
   
 
  <table class="table table-bordered">
      <tr>
         <th width="10%">#S.No</th> 
       <th width="20%">class name</th>    
       <th width="20%">Class teacher</th>
       <th width="15%">Class Fee</th>
       <th width="20%">Class Status</th>
       <th width="20%">Running Status</th>
       <th width="30%">Date</th>
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
<tr id="<?php echo $row['classid']; ?>">
     <td><?php echo $i; ?></td>
       <td><?php echo $row["class_name"]; ?></td>
       <td><?php echo $row["firstname"]." ".$row["lastname"]; ?></td>
       <td><?php echo $row["class_fee"]; ?></td>
       <td><?php echo $row["class_status"]; ?></td>
       <td><?php echo $row["running_status"]; ?></td>
       <td><?php echo $row["Date"]; ?></td>
       <td><input type="button" name="view" value="view" id="<?php echo $row["classid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["classid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["classid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php
 
}
 }


}
 
 
?>
 </table> 

