 <?php  
 error_reporting(0);
  include '../config/db.php';  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';    
    $sms_title = mysqli_real_escape_string($connect, $_POST["sms_title"]);    
    $message = mysqli_real_escape_string($connect, $_POST["message"]); 
       
      if($_POST["employee_id"] != '')  
        {  
         $sql = mysqli_query($connect,"SELECT * FROM sms_to_all WHERE smsid = '".$_POST["employee_id"]."'");
           $row = mysqli_fetch_array($sql);
           $sms_title =  $row['sms_title'];
           $sms_details = $row['sms_details'];
           $sms = $sms = $sms_title."\n".$sms_details;
$sql_stu_ph = mysqli_query($connect,"SELECT * FROM students ");
while ($row1=mysqli_fetch_array($sql_stu_ph)) {
$stu_ph_no = $row1['phone'];
include '../config/sms_api.php';
}
$query = "  
           UPDATE sms_to_all   
           SET status = 'Delivered'  
           WHERE smsid='".$_POST["employee_id"]."'";
           $message = 'Delivered';
      }  
      else  
      {  
           $query = "  
           INSERT INTO sms_to_all (sms_title, sms_details,status)  
     VALUES('$sms_title', '$message', 'Not Send');  
           ";  

           $message = 'Inserted'; 

           
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<div class="alert alert-success" id="message">' . $message . '</div>';  
           $select_query = "SELECT * FROM sms_to_all ORDER BY smsid DESC";  
           $result = mysqli_query($connect, $select_query);  
           
         $output .='
          
                <table class="table table-bordered">  
                     <tr>
        <th width="5%">#S.No</th> 
       <th width="20%">Sms Title</th>    
       <th width="20%">Sms Details</th>
       <th width="40%">Date</th>
       <th width="40%">Status</th>
       <th width="30%" colspan="2">Action</th>
      </tr>';
          
          $i=0; 
           while($row = mysqli_fetch_array($result))  
           { 
           $i++; 
          $output .='
                     <tr>
        <td>' . $i .'</td>
       <td>'. $row["sms_title"] .'</td>
       <td>'. $row["sms_details"] .'</td>
       <td>'. $row["create_on"] .'</td>
       <td>'. $row["status"] .'</td>
       <td><button type="button" name="delete_btn" id="'. $row["smsid"] .'" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" disabled="" value="Send sms" id="'. $row["smsid"] .'" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
       ';
       }  
      $output .=  '</table>';
      }  
 }  
echo $output;
 ?>
 
<script type="text/javascript">
  $( document ).ready(function(){
            $('#message').fadeIn('slow', function(){
               $('#message').delay(2000).fadeOut(); 
            });
        });
</script>