 <?php  
 error_reporting(0);
  include '../config/db.php';  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $exam_name = mysqli_real_escape_string($connect, $_POST["ex_name"]);  
    $exam_date = mysqli_real_escape_string($connect, $_POST["ex_date"]);    
    $exam_comm = mysqli_real_escape_string($connect, $_POST["ex_com"]);    
    $exam_status = mysqli_real_escape_string($connect, $_POST["exam_status"]);    
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE exams   
           SET exam_name='$exam_name',
           exam_date ='$exam_date',
           exam_comment = '$exam_comm',
           exam_status = '$exam_status'  
           WHERE examid='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  


           $query = "  
           INSERT INTO exams (exam_name, exam_date, exam_comment, exam_status)  
     VALUES('$exam_name', '$exam_date', '$exam_comm', '$exam_status');  
           ";  

           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
            $output .= '<div class="alert alert-success" id="message">' . $message . '</div>';
           $select_query = "SELECT * FROM exams WHERE exam_status='Active' ORDER BY examid DESC";  
           $result = mysqli_query($connect, $select_query);  
           
         $output .='
           <div id="display"></div>
      <div class="not">
                <table class="table table-bordered">  
                     <tr>
        <th width="10%">#S.No</th> 
       <th width="30%">Exam name</th>    
       <th width="30%">Exam Date</th>
       <th width="30%">Exam Status</th>
       <th width="30%">Comments</th>
       <th width="30%" colspan="3">Action</th>
      </tr> ';
          
          $i=0; 
           while($row = mysqli_fetch_array($result))  
           { 
           $i++; 
          $output .='
                     <tr id="'. $row['examid'] .'">
        <td>' . $i .'</td>
       <td>'. $row["exam_name"] .'</td>
       <td>'. $row["exam_date"] .'</td>
       <td>'. $row["exam_status"] .'</td>
       <td>'. $row["exam_comment"] .'</td>
       <td><input type="button" name="view" value="view" id="'. $row["examid"] .'" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="'. $row["examid"] .'" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="'. $row["examid"] .'" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
       ';
       }  
      $output .=  '</table></div>';
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
            $('.not').show(); 
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_exams/search_ajax.php",
 
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