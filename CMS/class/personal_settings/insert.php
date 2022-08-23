 <?php  
 // error_reporting(0);
  include '../config/db.php';  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';
      
  // for uploading images
     
        if( !($_FILES["pic"]["name"]=="") )
      {
      $file_name = $_FILES["pic"]["name"];
      $tmp_name = $_FILES["pic"]['tmp_name'];
      $file_array = explode(".", $file_name);
      $file_extension = end($file_array);
      }
      $system_name = mysqli_real_escape_string($connect, $_POST["system_name"]);  
      $phone = mysqli_real_escape_string($connect, $_POST["phone"]);  
    
     
      if($_POST["employee_id"] != '')  
      {  
       
      if ((!($_FILES["pic"]["name"])))
      {
           $query = "  
           UPDATE settings   
           SET name = '$system_name',
           phone = '$phone'  
           WHERE settingid = '".$_POST["employee_id"]."'";  
           if($query)
           {
            $message = 'Data Updated';
           } 
           else{
            $message = 'Error';
           }
           }

       else   
      {
        $location = 'files/' . $file_name;
        move_uploaded_file($tmp_name, $location);
          $query = "  
           UPDATE settings  
           SET name='$system_name',
           phone='$phone',
           logo = '$file_name'  
           WHERE settingid='".$_POST["employee_id"]."'";  
           if($query)
           {
            $message = 'Data Updated';
           } 
           else{
            $message = 'Error';
           } 
           }
            if(mysqli_query($connect, $query))  
      {
         $output .= '<div class="alert alert-success" id="message">' . $message . '</div>';
        ?>
         <table class="table table-bordered table-hover table-striped">
      <tr> 
        <th width="15%">Logo</th>
       <th width="20%">System Name</th>    
       <th width="20%">Phone No</th>
       <th width="30%" colspan="2">Action</th>
      </tr>
        <?php 
        $query = "SELECT 
       * 
           FROM settings";
$result = mysqli_query($connect,$query);
while($row = mysqli_fetch_array($result))
      {
      ?>
  <tr>
      
       <td><img src="class/personal_settings/files/<?php echo $row['logo']; ?>" height="100" width="100"></td>
       <td><?php echo $row["name"]; ?></td>
       <td><?php echo '+'.$row["phone"]; ?></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["settingid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["settingid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
      <?php 
      }
      ?>
    </table>
      <?php
        } 
       

     
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
 