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
      $stu_class_fee = mysqli_real_escape_string($connect, $_POST["stu_class_fee"]);  
      $stu_name = mysqli_real_escape_string($connect, $_POST["stu_name"]);  
      $fat_name = mysqli_real_escape_string($connect, $_POST["fat_name"]);  
      $mot_name = mysqli_real_escape_string($connect, $_POST["mot_name"]);    
      $birthday = mysqli_real_escape_string($connect, $_POST["birthday"]);  
      $gender = mysqli_real_escape_string($connect, $_POST["gender"]);  
      $religion = mysqli_real_escape_string($connect, $_POST["religion"]);  
      $blood = mysqli_real_escape_string($connect, $_POST["blood"]);  
      $address = mysqli_real_escape_string($connect, $_POST["address"]);  
      $phone = mysqli_real_escape_string($connect, $_POST["phone"]);  
      $stu_class = mysqli_real_escape_string($connect, $_POST["add_stu_class"]);  
      $stu_reg_no = mysqli_real_escape_string($connect, $_POST["stu_reg"]);  
      $date = mysqli_real_escape_string($connect, $_POST["create_on"]);  
      $discount_category = mysqli_real_escape_string($connect, $_POST["dis_cat"]);  
      $misc_disc_cat = mysqli_real_escape_string($connect, $_POST["misc_disc_cat"]);
      if($_POST["employee_id"] != '')  
      {  
       
       
      if ((!($_FILES["pic"]["name"])))
      {
           $query = "  
           UPDATE students   
           SET stu_first_name='$stu_name',
           stu_last_name='$fat_name',      
           birthday='$birthday',   
           sex='$gender',   
           religion = '$religion',   
           blood_group = '$blood',   
           address = '$address',   
           phone = '$phone',   
           class_id = '$stu_class',  
           stu_reg_no = '$stu_reg_no', 
           create_on = '$date',
           student_fee = '$stu_class_fee',
           discount_category = '$discount_category',
           misc_disc_cat = '$misc_disc_cat'
             
           WHERE studentid='".$_POST["employee_id"]."'";  
           $message = 'Data Updated'; 
           }

       else   
      {
        $location = 'students_upload/' . $file_name;
        move_uploaded_file($tmp_name, $location);
          $query = "  
           UPDATE students   
           SET stu_first_name='$stu_name',
           stu_last_name='$fat_name',      
           birthday='$birthday',   
           sex='$gender',   
           religion = '$religion',   
           blood_group = '$blood',   
           address = '$address',   
           phone = '$phone',   
           class_id = '$stu_class',  
           stu_reg_no = '$stu_reg_no', 
           create_on = '$date',
           student_fee = '$stu_class_fee',
           discount_category = '$discount_category',
           misc_disc_cat = '$misc_disc_cat',
           image = '$file_name'  
           WHERE studentid='".$_POST["employee_id"]."'";  
           $message = 'Data Updated'; 
           }
        } 
       
      else  
      {  
          $location = 'students_upload/' . $file_name;
        move_uploaded_file($tmp_name, $location);
        

           $query = "  
           INSERT INTO students (stu_first_name, stu_last_name, stu_reg_no, birthday, sex, religion, blood_group, address, phone, class_id, create_on, image, student_fee, discount_category, misc_disc_cat)  
     VALUES('$stu_name', '$fat_name', '$stu_reg_no', '$birthday', '$gender', '$religion', '$blood', '$address', '$phone', '$stu_class', '$date', '$file_name', '$stu_class_fee', '$discount_category', '$misc_disc_cat');  
           ";

           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
        
           $output .= '<div class="alert alert-success" id="message">' . $message . '</div>'; 
           $select_query = "SELECT * FROM students WHERE class_id='$_POST[add_stu_class]' ORDER BY studentid DESC";  
           $result = mysqli_query($connect, $select_query);  
          ?>  
          <div id="display"></div>
        <?php 
  $output .= '
            <div class="not">
                <table class="table table-bordered">  
                     <tr>
        <th width="10%">#S.No</th> 
        <th width="30%">image</th> 
       <th width="30%">Student name</th>    
       <th width="30%">Father name</th>    
       <th width="30%">Address</th>
       <th width="20%">Phone Number</th>
       <th width="30%">roll num</th>
       <th width="30%" colspan="4">Action</th>
      </tr>
         '; 
          $i=0; 
           while($row = mysqli_fetch_array($result))  
           { 
           $i++; 
    $output .='        
       <tr id="'. $row['studentid'] .'">
        <td>'. $i .'</td>
        <td>
      <img src="class/ajax_sql_students/students_upload/'.$row['image'] .'" height="50" width="100" class="img-thumbnail" />
     </td>
       <td>'. $row['stu_first_name'].'</td>
       <td>'. $row["stu_last_name"] .'</td>
       <td>'. $row["address"] .'</td>
       <td>'. $row["phone"] .'</td>
       <td>'. $row["stu_reg_no"] .'</td>
       <td><input type="button" name="view" value="view" id="'. $row["studentid"] .'" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="'. $row["studentid"] .'" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="'. $row["studentid"] .'" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
           ';      
           } 

       $output .= '</table> </div>';

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
 <script type="text/javascript">
    
 
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
 
   $("#search").keyup(function() {
 
       //Assigning search box value to javascript variable named as "name".
 
       var name = $('#search').val();


 
       //Validating, if "name" is empty.
 
       if (name == "") {
 
           //Assigning empty value to "display" div in "search.php" file.
 
           $("#display").html("");
           $('.not').show();
 
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_students/search_ajax.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
 
               },
 
               //If result found, this funtion will be called.
 
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
              $("#display").html(html).show(); 
              $('.not').hide();     
 
               }
 
           });
 
       }
 
   });
 

  </script>