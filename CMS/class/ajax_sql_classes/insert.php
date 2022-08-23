 <?php 
 error_reporting(0); 
  include '../config/db.php';  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $class_fee =  mysqli_real_escape_string($connect, $_POST["class_fee"]);
      $class_name = mysqli_real_escape_string($connect, $_POST["name"]);  
    $class_teacher = mysqli_real_escape_string($connect, $_POST["c_teacher"]);    
    $class_status = mysqli_real_escape_string($connect, $_POST["class_status"]);    
    $running_status = mysqli_real_escape_string($connect, $_POST["running_status"]);    
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE class   
           SET class_name='$class_name',
           teacher_id='$class_teacher',
           class_fee = '$class_fee',
           class_status = '$class_status',
           running_status = '$running_status'  
           WHERE classid='".$_POST["employee_id"]."'";  
           $message = '<div id="message" class="alert alert-success">Data Updated</div>';
      }  
      else  
      {  


           $query = "  
           INSERT INTO class (class_name, teacher_id, class_fee, class_status, running_status)  
     VALUES('$class_name', '$class_teacher', '$class_fee', '$class_status', '$running_status');  
           ";  

           $message = '<div id="message" class="alert alert-success">Data Inserted </div>';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
$select_query = "SELECT 
                 A.classid,
                 A.class_name,
                 A.class_fee,
                 A.class_status,
                 A.running_status,
                 A.Date,
                 B.firstname,
                 B.lastname 
                 FROM class As A 
                 inner join teacher As B on A.teacher_id=B.teacherid WHERE (running_status = 'Active') ORDER BY classid DESC";  
                 $result = mysqli_query($connect, $select_query);  
                ?>  
         
                <div id="display"></div>
              
                <?php echo $output; ?>
                <div class="not">
                <table class="table table-bordered">  
                     <tr>
        <th width="10%">#S.No</th> 
       <th width="30%">class name</th>    
       <th width="30%">Class teacher</th>
       <th width="30%">Class Fee</th>
       <th width="30%">Class Status</th>
       <th width="30%">Running Status</th>
       <th width="30%">Date</th>
       <th width="30%" colspan="3">Action</th>
      </tr> 
          <?php
          $i=0; 
           while($row = mysqli_fetch_array($result))  
           { 
           $i++; 
            ?> 
                     <tr>
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
           $('.not').show();
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_classes/search_ajax.php",
 
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
 
});
 </script>