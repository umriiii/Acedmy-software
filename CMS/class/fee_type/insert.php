 <?php 
 error_reporting(0); 
 include '../config/db.php'; 
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $title = mysqli_real_escape_string($connect, $_POST["title"]);  
    $due_date = mysqli_real_escape_string($connect, $_POST["due_date"]);    
    $fine = mysqli_real_escape_string($connect, $_POST["fine"]);    
    $ft_kind = mysqli_real_escape_string($connect, $_POST["ft_kind"]);
    $def_fee = mysqli_real_escape_string($connect, $_POST["def_fee"]);
    $running_status = mysqli_real_escape_string($connect, $_POST["running_status"]);
    $ft_createon =  date('d-m-Y');
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE fee_type   
           SET title='$title',
           due_date='$due_date',  
           fine='$fine',  
           ft_kind='$ft_kind',  
           def_fee='$def_fee',  
           ft_createon='$ft_createon',  
           running_status='$running_status'  
           WHERE ftid='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  


           $query = "  
           INSERT INTO fee_type (title, fine, due_date, ft_kind, def_fee, ft_createon, running_status)  
     VALUES('$title', '$fine', '$due_date', '$ft_kind', '$def_fee', '$ft_createon', '$running_status');  
           ";  

           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
          $output .= '<div class="alert alert-success" id="message">' . $message . '</div>'; 
        $select_query = "
 SELECT 
 * 
 FROM 
 fee_type
 WHERE 
 running_status = 'Active'";
$result = mysqli_query($connect,$select_query);
            
          ?>  
          <div id="display"></div>
     <table class="table table-bordered table-hover table-striped">
        <tr>
        <th width="10%">#S.No</th> 
      <th width="20%">Fee Tiltle</th>
       <th width="20%">Kind</th>
       <th width="20%">Due Date</th>     
       <th width="20%">Fine</th>     
       <th width="20%">Status</th>     
       <th width="20%">Running Status</th> 
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
        <td><?php echo $row["title"]; ?></td>
       <td><?php echo $row["ft_kind"]; ?></td>
       <td><?php echo $row["due_date"]; ?></td>
       <td><?php echo $row["fine"]; ?></td>
       <td><?php echo $row["running_status"]; ?></td>
        <td><input type="button" name="view" value="view" id="<?php echo $row["ftid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["ftid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["ftid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
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