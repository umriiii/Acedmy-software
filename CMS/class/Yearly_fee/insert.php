 <?php  
error_reporting(0);
  include '../config/db.php';  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $roll_num = mysqli_real_escape_string($connect, $_POST["roll_num"]);  
    $bise_reg_fee = mysqli_real_escape_string($connect, $_POST["bise_reg_fee"]);    
    $bise_exam_fee = mysqli_real_escape_string($connect, $_POST["bise_exam_fee"]);    
    $paper_fund = mysqli_real_escape_string($connect, $_POST["paper_fund"]);    
    $party_fund = mysqli_real_escape_string($connect, $_POST["party_fund"]);    
    $misc_fee = mysqli_real_escape_string($connect, $_POST["misc_fee"]);    
    $fine = mysqli_real_escape_string($connect, $_POST["fine"]);    
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE yearly_fee   
           SET bise_reg_fee='$bise_reg_fee',
           bise_exam_fee ='$bise_exam_fee',
           paper_fund = '$paper_fund',
            fine = '$fine',
            party_fund = '$party_fund',
            miscellaneous = '$misc_fee'  
           WHERE yfeeid ='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
        $sel = mysqli_query($connect,"SELECT * FROM students WHERE stu_reg_no = '$roll_num'");
        $res = mysqli_fetch_array($sel);
        $STUDENT_ID = $res['studentid'];
        $Class_ID = $res['class_id'];
        $count_query = mysqli_query($connect,"SELECT * FROM yearly_fee WHERE student_id = '$STUDENT_ID' AND class_id = '$Class_ID' AND year(submit_on) = year(NOW())");
        $count_row = mysqli_num_rows($count_query);
        if($count_row > 0)
        {
          ?>
          <script type="text/javascript">
            alert('Already Added');
          </script>
          <?php 
        }
        else{
           $query = "  
           INSERT INTO yearly_fee (student_id, class_id, bise_reg_fee, bise_exam_fee, paper_fund, fine, party_fund, miscellaneous)  
     VALUES('$STUDENT_ID', '$Class_ID','$bise_reg_fee', '$bise_exam_fee', '$paper_fund', '$fine', '$party_fund', '$misc_fee');  
           ";  

           $message = 'Data Inserted'; 
           } 
      }  
      if(mysqli_query($connect, $query))  
      {  
            $output .= '<div class="alert alert-success" id="message">' . $message . '</div>';
           $select_query = "SELECT * FROM yearly_fee AS A Inner Join students AS B ON A.student_id = B.studentid Inner Join class AS C ON B.class_id = C.classid ORDER BY A.yfeeid DESC";  
           $result = mysqli_query($connect, $select_query);  
           
         $output .='
           <div id="display"></div>
      <div class="not">
                <table class="table table-bordered">  
                     <tr>
        <th width="10%">#S.No</th>
         <th width="30%">Roll No</th> 
       <th width="30%">Student Name</th>    
       <th width="30%">Father Name</th>
       <th width="30%">Class</th>
       <th width="30%" colspan="3">Action</th>
      </tr> ';
          
          $i=0; 
           while($row = mysqli_fetch_array($result))  
           { 
           $i++; 
          $output .='
                     <tr>
        <td>' . $i .'</td>
       <td>'. $row["stu_reg_no"] .'</td>
       <td>'. $row["stu_first_name"] .'</td>
       <td>'. $row["stu_last_name"] .'</td>
       <td>'. $row["class_name"] .'</td>
       <td><input type="button" name="view" value="view" id="'. $row["yfeeid"] .'" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="'. $row["yfeeid"] .'" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="'. $row["yfeeid"] .'" class="btn btn-info btn-sm edit_data" /></td>
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
 
               url: "class/Yearly_fee/search_ajax.php",
 
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