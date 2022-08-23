 <?php 
 error_reporting(0); 
include '../config/db.php'; 
 date_default_timezone_set("Asia/Karachi"); 
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $studentfee = mysqli_real_escape_string($connect, $_POST["stu_fee"]);  
      $ajax_stu_reg = mysqli_real_escape_string($connect, $_POST["ajax_fee"]);  
      $fee_status = mysqli_real_escape_string($connect, $_POST["fee_status"]); 
    
      if($_POST["employee_id"] != '')  
      {  
        $sql=mysqli_query($connect,"SELECT * FROM students WHERE stu_reg_no='$ajax_stu_reg'");
        $row=mysqli_fetch_array($sql);
        $stu_id=$row[0];
        $update_stu_fee = mysqli_query($connect,"SELECT * FROM student_fee WHERE student_id = '$stu_id' ORDER BY feeid DESC");
        $update_fee = mysqli_fetch_array($update_stu_fee);
        $old_fee = $update_fee['student_fee'];
        $new_fee = $old_fee + $studentfee;
        $current_date = date('Y-m-d h:i:s');
           $query = "  
           UPDATE student_fee   
           SET status='$fee_status',  
           student_fee = '$new_fee',
           submit_on = '$current_date'  
           WHERE feeid='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
        $sql=mysqli_query($connect,"SELECT * FROM students WHERE stu_reg_no='$ajax_stu_reg'");
        $row=mysqli_fetch_array($sql);
        $stu_id=$row[0];
        $check = mysqli_query($connect,"SELECT * FROM student_fee WHERE student_id = '$stu_id' AND Month(submit_on) = Month(NOW())");
        $count = mysqli_num_rows($check);
        if($count > 0)
        {
          ?>
          <script type="text/javascript">
            alert('Already Added');
          </script>
          <?php
        }
        else{
          $ssql = mysqli_query($connect,"SELECT * FROM student_fee WHERE student_id = '$stu_id' ORDER BY feeid DESC");
          $fee_row = mysqli_fetch_array($ssql);
          $current_balance = $fee_row['student_fee'];
          $fee_to_sub = $studentfee + $current_balance;
        $query = "  
                   INSERT INTO student_fee (student_id,student_fee,status)  
                   VALUES('$stu_id', '$fee_to_sub', '$fee_status');  
                ";

           $message = 'Data Inserted';
           }  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<div class="alert alert-success" id="message">' . $message . '</div>';  
           
          ?>  
          <div id="display"></div>
          <?php echo $output; ?>
          
               <div class="no">
                <table class="table table-bordered table-hover table-striped">  
                     <tr>
                           <th width="10%">#S.No</th> 
                           <th width="30%">Student Name</th> 
                           <th width="30%">Father Name</th> 
                           <th width="30%">Roll No</th>   
                           <th width="30%">Class</th> 
                           <th width="30%">Total Fee</th> 
                           <th width="30%">Fee Status</th>
                           <th width="30%">Submission Date</th>  
                           <th width="30%" colspan="4">Action</th>
                     </tr> 
          <?php
          $i=0; 
          
            $select=mysqli_query($connect,"SELECT A.stu_first_name,A.stu_last_name,A.stu_reg_no,B.running_status,B.class_name,A.address,A.phone,A.create_on,C.submit_on,C.status,C.student_fee,C.feeid FROM students as A inner join class as B on A.class_id=B.classid inner join student_fee as C on A.studentid=C.student_id WHERE Month(C.submit_on) = Month(NOW()) AND B.running_status = 'Active' ORDER BY C.feeid DESC");
            while ($row1=mysqli_fetch_array($select)) {
             
           $i++; 
            ?> 
                      <tr id="<?php echo $row1['feeid']; ?>">
        <td><?php echo $i; ?></td>
       <td  data-target="teachername"><?php echo $row1["stu_first_name"]; ?></td>
       <td  data-target="teachername"><?php echo $row1["stu_last_name"]; ?></td>
       <td  data-target="address"><?php echo $row1["stu_reg_no"]; ?></td>
       <td  data-target="phone"><?php echo $row1["class_name"]; ?></td>
       <td  data-target="phone"><?php echo $row1["student_fee"]; ?></td>
        <td  data-target="email"><?php echo $row1["status"]; ?></td>
       <td  data-target="email"><?php echo $row1["submit_on"]; ?></td>
       
       <td><input type="button" name="view" value="view" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><a href="reports/fee_slip.php?feeid=<?php echo $row1["feeid"]; ?>" target="_blank"><input type="button" name="view" onmouseup="bleep.play()" value="Fee Slip" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm" /></a></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row1["feeid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
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
           $('.no').show();
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "search_ajax.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
 
               },
 
               //If result found, this funtion will be called.
 
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
      
              $("#display").html(html).show();      
              $('.no').hide();
               }
 
           });
 
       }
 
   });
 
});
 </script>