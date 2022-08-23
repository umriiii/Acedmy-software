<?php
 
//Including Database configuration file.
 
 include '../config/db.php';
 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
//Search query.
 
   $Query = "SELECT A.sub_name,B.firstname,B.lastname,C.class_name FROM subjects as A inner join teacher as B on A.sub_tec_id=B.teacherid inner join class as C on A.class_id=C.classid WHERE C.running_status = 'Active' AND (A.sub_name  LIKE '%$Name%' OR B.firstname LIKE '%$Name%' OR B.lastname LIKE '%$Name%' OR C.class_name LIKE '%$Name%')";
 
//Query execution
 
   $ExecQuery = MySQLi_query($connect, $Query);
 ?>
<!-- Creating unordered list to display result. -->

  <table class="table table-bordered table-hover table-striped">
      <tr>
        <th width="10%">#S.No</th> 
       <th width="30%">Subject</th>    
       <th width="30%">Teacher name</th>
       <th width="30%">Subject Class</th>
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
 
 <tr id="<?php echo $row['teacherid']; ?>">
        <td><?php echo $i; ?></td>
        <td  data-target="address"><?php echo $row["sub_name"]; ?></td>
       <td  data-target="teachername"><?php echo $row["firstname"]." ".$row["lastname"] ; ?></td>
       <td  data-target="phone"><?php echo $row["class_name"]; ?></td>
       
        <td><input type="button" name="view" value="view" id="<?php echo $row["teacherid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["teacherid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["teacherid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
   <?php
 
}
 }


}
 
 
?>
 </table> 

