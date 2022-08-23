<?php  
 include '../config/db.php';   
 $output = '';  
 $sql = "SELECT * FROM settings ORDER BY settingid DESC";  
 $result = mysqli_query($connect, $sql);  
 $output .= '
 <br>  
      <div class="table-responsive table-striped">  
           <table class="table table-bordered">  
                <tr>  
                       
                     <th width="16%">Absent Sms</th>  
                     <th width="16%">Leave Sms</th>  
                     <th width="16%">Late Sms</th>  
                     <th width="16%">Normal Sms</th>  
                     <th width="16%">Early Leave Sms</th>  
                     <th width="16%">Late and Early sms</th>  
                </tr>';  
 $rows = mysqli_num_rows($result);
 if($rows > 0)  
 {  
    if($rows > 10)
    {
      $delete_records = $rows - 10;
      $delete_sql = "DELETE FROM settings LIMIT $delete_records";
      mysqli_query($connect, $delete_sql);
    }
      while($row = mysqli_fetch_array($result))  
      {  

           $output .= '  
                <tr>  
                     
                     <td class="absent_sms" data-id1="'.$row["settingid"].'" contenteditable>'.$row["absent_sms"].'</td>  
                     <td class="leave_sms" data-id2="'.$row["settingid"].'" contenteditable>'.$row["leave_sms"].'</td>
                     <td class="late_sms" data-id3="'.$row["settingid"].'" contenteditable>'.$row["late_sms"].'</td>  
                     <td class="normal_sms" data-id4="'.$row["settingid"].'" contenteditable>'.$row["normal_sms"].'</td>  
                     <td class="early_sms" data-id5="'.$row["settingid"].'" contenteditable>'.$row["early_sms"].'</td>  
                     <td class="late_n_early_sms" data-id6="'.$row["settingid"].'" contenteditable>'.$row["late_n_early_sms"].'</td>  
                       
                </tr>  
           ';  
      }  
     
 }  
 else  
 {  
      $output .= 'Data Not Found';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>
