 <?php
  error_reporting(0);
 set_time_limit(0); 
 include '../config/db.php';  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';    
       
    $sms_title = mysqli_real_escape_string($connect, $_POST["sms_title"]);    
    $message = mysqli_real_escape_string($connect, $_POST["message"]); 
       
      if($_POST["employee_id"] != '')  
      {  
         
    $sms_class = mysqli_real_escape_string($connect, $_POST["sms_class"]);    
$class_sms_id = mysqli_query($connect,"UPDATE sms_to_class   
           SET class_id = '$sms_class'  
           WHERE smsid='".$_POST["employee_id"]."'");   
           
        $sms_id = $_POST["employee_id"];
         $sql = mysqli_query($connect,"SELECT * FROM sms_to_class WHERE smsid = '$sms_id' AND class_id = '$sms_class'");
           $row = mysqli_fetch_array($sql);
           $sms_title =  $row['sms_title'];
           $sms_details = $row['sms_details'];
           $sms = $sms_title."\n".$sms_details;
$sql_stu_ph = mysqli_query($connect,"SELECT * FROM students WHERE class_id = '$sms_class'");
while ($row1=mysqli_fetch_array($sql_stu_ph)) {
$stu_ph_no = $row1['phone'];
include '../config/sms_api.php'; 
}
$query = "  
           UPDATE sms_to_class   
           SET status = 'Delivered'  
           WHERE smsid='".$_POST["employee_id"]."'";
           $message = 'Delivered';
      }  
      else  
      {  
           $query = "  
           INSERT INTO sms_to_class (sms_title, sms_details, status)  
     VALUES('$sms_title', '$message', 'Not Send');  
           ";  

           $message = 'Inserted'; 

           
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM sms_to_class ORDER BY smsid DESC";  
           $result = mysqli_query($connect, $select_query);  
           ?>
       
          
                <table class="table table-bordered">  
                     <tr>
        <th width="5%">#S.No</th> 
       <th width="20%">Sms Title</th>    
       <th width="20%">Sms Details</th>
       <th width="30%">Date</th>
       <th width="30%">Status</th>
      <th width="30%">Select Class</th>
       <th width="30%" colspan="2">Action</th>
      </tr>
          <?php
          $i=0; 
           while($row = mysqli_fetch_array($result))  
           { 
           $i++; 
           ?>
         
                     <tr>
        <td><?php echo $i ?></td>
       <td><?php echo $row["sms_title"]; ?></td>
       <td><?php echo $row["sms_details"];  ?></td>
       <td><?php echo $row["create_on"]; ?></td>
       <td><?php echo $row["status"]; ?></td>
       <td><select name="class_sms_id" id="class_sms_id">
      <option value="" selected="">--Select Class--</option>
      <?php 
$sql = mysqli_query($connect,"SELECT * FROM class WHERE running_status = 'Active'");
while ($row1 = mysqli_fetch_array($sql)) {
 
       ?>
      <option value="<?php echo $row1['classid']; ?>"><?php echo $row1['class_name']; ?></option>
    <?php 
}
     ?>
     </select></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["smsid"] ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" disabled="" value="Send sms" id="<?php echo $row["smsid"];  ?> " class="btn btn-info btn-sm edit_data" /></td>
      </tr>
       ';
     <?php } ?>
       
      </table>
      <?php  
      }  
 }  
echo $output;
 ?>