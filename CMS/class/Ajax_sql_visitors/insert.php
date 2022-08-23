 <?php 
 error_reporting(0); 
 include '../config/db.php';  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $stu_name = mysqli_real_escape_string($connect, $_POST["std_name"]);  
    $fat_name = mysqli_real_escape_string($connect, $_POST["sf_name"]);  
    $fat_ocu = mysqli_real_escape_string($connect, $_POST["ftocu_name"]);  
    $p_ins_name = mysqli_real_escape_string($connect, $_POST["p_ins_name"]);  
    $std_class = mysqli_real_escape_string($connect, $_POST["std_class"]);  
    $mob_num = mysqli_real_escape_string($connect, $_POST["mob_num"]);  
    $stu_add = mysqli_real_escape_string($connect, $_POST["stu_add"]);   
    $status = mysqli_real_escape_string($connect, $_POST["status"]);  
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE guest_student   
           SET student_name='$stu_name',
           father_name='$fat_name',   
           father_business='$fat_ocu',   
           previous_institute='$p_ins_name',   
           class = '$std_class',   
           contact_number = '$mob_num',   
           address = '$stu_add',      
           Add_status = '$status'  
           WHERE id='".$_POST["employee_id"]."'";  
           $message = '<div id="message" class="alert alert-success">Data Updated</div>';  
      }  
      else  
      {  


           $query = "  
           INSERT INTO guest_student (student_name, father_name, father_business, previous_institute, class, contact_number, address, Add_status)  
     VALUES('$stu_name', '$fat_name', '$fat_ocu', '$p_ins_name', '$std_class', '$mob_num', '$stu_add', '$status');  
           ";  
           $message = '<div id="message" class="alert alert-success">Data Inserted </div>';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM guest_student ORDER BY id DESC";  
           $result = mysqli_query($connect, $select_query);  
          ?>  
          <div id="display"></div>
          <?php echo '<div style="position: sticky;
  position: -webkit-sticky;
  top: 0;">'.$output.'</div>'; ?>
          <div class="not">
                <table class="table table-bordered table-hover table-striped">
 <tr>
      <th>#</th>
      <th>Student Name</th>
      <th>Father Name</th>
      <th>Father Business</th>
      <th>Prevoius institute</th>
      <th>class</th>
      <th>Contact Number</th>
      <th>Address</th>
      <th>Stauts</th>
      <th colspan="4">Action</th>
    </tr>
          <?php
          $i=0; 
           while($row = mysqli_fetch_array($result))  
           { 
           $i++; 
            ?> 
                      <tr id="<?php echo $row['id']; ?>">
        <td><?php echo $i; ?></td>
        <td><?php echo $row["student_name"]; ?></td>
       <td><?php echo $row["father_name"]; ?></td>
       <td><?php echo $row["father_business"]; ?></td>
       <td><?php echo $row["previous_institute"]; ?></td>
       <td><?php echo $row["class"]; ?></td>
       <td><?php echo $row["contact_number"]; ?></td>
       <td><?php echo $row["address"]; ?></td>

       <td><?php echo $row["Add_status"]; ?></td>
       
        <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
       <td><input type="button" name="Send_SMS" value="Send_SMS" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm Send_SMS" /></td>
      </tr>
            <?php       
           }  
           ?>
      
          </table> 
        </div>
          <?php 
      }  
     
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
           $(".not").show();      
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_visitors/search_ajax.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
 
               },
 
               //If result found, this funtion will be called.
 
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
      
              $("#display").html(html).show();      
              $(".not").hide();      
 
               }
 
           });
 
       }
 
   });
 
});
 </script>