 <?php 
 error_reporting(0); 
 include '../config/db.php'; 
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $sub_name = mysqli_real_escape_string($connect, $_POST["sub_name"]);  
    $sub_teacher = mysqli_real_escape_string($connect, $_POST["sub_tec"]);    
    $sub_class = mysqli_real_escape_string($connect, $_POST["sub_class"]);
       
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE subjects   
           SET sub_name='$sub_name',
           sub_tec_id='$sub_teacher',  
           class_id='$sub_class'  
           WHERE subjectid='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  


           $query = "  
           INSERT INTO subjects (sub_name, sub_tec_id, class_id)  
     VALUES('$sub_name', '$sub_teacher', $sub_class);  
           ";  

           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
          $output .= '<div class="alert alert-success" id="message">' . $message . '</div>'; 
           $select_query = "SELECT A.sub_name,B.firstname,B.lastname,C.class_name,A.subjectid FROM subjects as A inner join teacher as B on A.sub_tec_id=B.teacherid inner join class as C on A.class_id=C.classid WHERE (C.running_status = 'Active') ORDER BY C.classid DESC";  
           $result = mysqli_query($connect, $select_query);  
          ?>  
          <div id="display"></div>
                <table class="table table-bordered">  
                     <tr>
        <th width="10%">#S.No</th> 
       <th width="30%">Subject</th>    
       <th width="30%">Teacher name</th>
       <th width="30%">Subject Class</th>
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
        <td  data-target="address"><?php echo $row["sub_name"]; ?></td>
       <td  data-target="teachername"><?php echo $row["firstname"]." ".$row["lastname"] ; ?></td>
       <td  data-target="phone"><?php echo $row["class_name"]; ?></td>
       
        <td><input type="button" name="view" value="view" id="<?php echo $row["subjectid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["subjectid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["subjectid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
            <?php       
           }  
           ?>
          </table> 
          <?php 
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
 
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_subjects/search_ajax.php",
 
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