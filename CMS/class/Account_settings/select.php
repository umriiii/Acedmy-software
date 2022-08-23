<?php  
 include '../config/db.php';   
 $output = '';  
 $sql = "SELECT * FROM login ORDER BY loginid ASC";  
 $result = mysqli_query($connect, $sql);  
 $output .= '
 <br>  
      <div class="table-responsive table-striped">  
           <table class="table table-bordered">  
                <tr>  
                       
                     <th width="5%">User Name</th>  
                     <th width="8%">User Password</th>  
                   
                </tr>';  
 $rows = mysqli_num_rows($result);
 if($rows > 0)  
 {  
	  if($rows > 10)
	  {
		  $delete_records = $rows - 10;
		  $delete_sql = "DELETE FROM login LIMIT $delete_records";
		  mysqli_query($connect, $delete_sql);
	  }
      while($row = mysqli_fetch_array($result))  
      {  

           $output .= '  
                <tr>  
                     <td class="user_name" data-id1="'.$row["loginid"].'" contenteditable>'.$row["user_name"].'</td>  
                     <td class="user_pass" data-id2="'.$row["loginid"].'" contenteditable>'.$row["user_pass"].'</td>
                     
                       
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
 <!-- <td><button type="button" name="delete_btn" data-id3="'.$row["settingid"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  -->