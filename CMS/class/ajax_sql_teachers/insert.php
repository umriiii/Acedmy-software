 <?php  
  error_reporting(0);
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

    $first_name = mysqli_real_escape_string($connect, $_POST["f_name"]);  
    $last_name = mysqli_real_escape_string($connect, $_POST["l_name"]);  
    $birthday = mysqli_real_escape_string($connect, $_POST["birthday"]);  
    $gender = mysqli_real_escape_string($connect, $_POST["gender"]);  
    $religion = mysqli_real_escape_string($connect, $_POST["religion"]);  
    $blood = mysqli_real_escape_string($connect, $_POST["blood"]);  
    $address = mysqli_real_escape_string($connect, $_POST["address"]);  
    $phone = mysqli_real_escape_string($connect, $_POST["phone"]);  
    // $email = mysqli_real_escape_string($connect, $_POST["email"]);  
    // $qualification = mysqli_real_escape_string($connect, $_POST["t_qtion"]);  
    // $communication = mysqli_real_escape_string($connect, $_POST["c_skill"]);  
    // $Teaching_Method = mysqli_real_escape_string($connect, $_POST["t_method"]);  
    // $Experience = mysqli_real_escape_string($connect, $_POST["t_exp"]);  
    // $Achivements = mysqli_real_escape_string($connect, $_POST["t_achiv"]);  
    // $Teacher_Discription = mysqli_real_escape_string($connect, $_POST["t_disc"]);   
      if($_POST["employee_id"] != '')  
      {  
        if ((!($_FILES["pic"]["name"])))
      {
        $query = "  
           UPDATE teacher   
           SET firstname='$first_name',
           lastname='$last_name',   
           birthday='$birthday',   
           sex='$gender',   
           religion = '$religion',   
           blood_group = '$blood',   
           address = '$address',   
           phone = '$phone'  
           WHERE teacherid='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';
      }
       else   
      {
        $location = 'files/' . $file_name;
        move_uploaded_file($tmp_name, $location);
        
           $query = "  
           UPDATE teacher   
           SET firstname='$first_name',
           lastname='$last_name',   
           birthday='$birthday',   
           sex='$gender',   
           religion = '$religion',   
           blood_group = '$blood',   
           address = '$address',   
           phone = '$phone',   
           image = '$file_name'  
           WHERE teacherid='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
        }
      }  
      else  
      {  
       $location = 'files/' . $file_name;
        move_uploaded_file($tmp_name, $location);

        $query = "  
           INSERT INTO teacher (firstname, lastname, birthday, sex, religion, blood_group, address, phone, image)  
     VALUES('$first_name', '$last_name', '$birthday', '$gender', '$religion', '$blood', '$address', '$phone','$file_name');  
           "; 
          
             

           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
          $output .= '<div class="alert alert-success" id="message">' . $message . '</div>';  
           $select_query = "SELECT * FROM teacher ORDER BY teacherid DESC";  
           $result = mysqli_query($connect, $select_query);  
          ?>  
          <div id="display"></div>
             <div class="not">
                <table class="table table-bordered">  
                     <tr>
        <th width="10%">#S.No</th> 
        <th width="40%">Image</th>
       <th width="30%">Teacher Name</th>    
       <th width="30%">Address</th>
       <th width="20%">Phone Number</th>
       <th width="30%" colspan="3">Action</th>
      </tr> 
          <?php
          $i=0; 
           while($row = mysqli_fetch_array($result))  
           { 
           $i++; 
            ?> 
                     <tr id="<?php echo $row['teacherid']; ?>">
        <td><?php echo $i; ?></td>
        <td><img src="class/ajax_sql_teachers/files/<?php echo $row['image']; ?>" height="250" width="150" class="img-thumbnail" /></td>
       <td  data-target="teachername"><?php echo $row["firstname"]." ".$row["lastname"] ; ?></td>
       <td  data-target="address"><?php echo $row["address"]; ?></td>
       <td  data-target="phone"><?php echo $row["phone"]; ?></td>  
       <td><input type="button" name="view" value="view" id="<?php echo $row["teacherid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["teacherid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["teacherid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
            <?php       
           }  
           ?>
          </table> 
        </div>
          <?php 
      }  
    echo $output; 
 }  
 ?>


<script type="text/javascript">
  $( document ).ready(function(){
            $('#message').fadeIn('slow', function(){
               $('#message').delay(2000).fadeOut(); 
            });
        });
</script>
  <script type="text/javascript">
  function fill(Value) {
 
   //Assigning value to "search" div in "search.php" file.
 
   $('#search').val(Value);
 
   //Hiding "display" div in "search.php" file.
}
    $(document).ready(function() {
 
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
 
   $("#search").keyup(function() {
 
       //Assigning search box value to javascript variable named as "name".
 
       var name = $('#search').val();


 
       //Validating, if "name" is empty.
 
       if (name == "") {
 
           //Assigning empty value to "display" div in "search.php" file.
 
           $("#display").html("");
          $('.no').show();
 
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_teachers/search_ajax.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
 
               },
 
               //If result found, this funtion will be called.
 
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
      
              $("#display").html(html).show();      
 
               }
 
           });
 
       }
 
   });
 
});
 </script>