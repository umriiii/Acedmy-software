<?php 
error_reporting(0);
 include '../config/db.php';
$exam_id = $_POST['exam_id'];
$class_id = $_POST['class_id'];
$output = '';
$sql=mysqli_query($connect,"
  SELECT DISTINCT A.student_id,A.msg_status,B.stu_first_name,B.stu_last_name,B.stu_reg_no FROM marks as A inner join students as B on 
  A.student_id=B.studentid WHERE A.exam_id = '$exam_id' AND A.class_id = '$class_id'
     ");
?>



<div id="pdf">

</div>
<div class="no-print">
<div class="no_show">
<!-- hidden inputs for sending requests start -->
<input type="hidden" name="hid_exam_id" id="hid_exam_id" value="<?php echo $exam_id; ?>">
<input type="hidden" name="hid_class_id" id="hid_class_id" value="<?php echo $class_id; ?>">
<!-- hidden inputs for sending requests end -->


 <input type="submit" id="message" onclick="send_sms();" name="message" value="Send message" class="btn btn-primary">

<a href="reports/pdf_per_student.php?exam_id=<?php echo $exam_id; ?>&class_id=<?php echo $class_id; ?>" target="_blank" name="generate_pdf" class="btn btn-info print_pdf">PDF Per Student</a>
<a href="reports/pdf_per_class.php?exam_id=<?php echo $exam_id; ?>&class_id=<?php echo $class_id; ?>" target="_blank" name="Combine_pdf" class="btn btn-dark combine_pdf">PDF Per Class</a>

 
  
  

<div id="sms_res"></div>
 <!-- for sending sms ending -->

 <div class="col-md-4 offset-md-8">
             <div class="input-group" id="adv-search">
                <input type="text" class="form-control" id="search" placeholder="Enter Keyword To search Data" style="border:1px solid black;border-top-left-radius: 15px" />
                <button type="button" class="btn btn-primary"><span class="fa fa-search" aria-hidden="true" style="height: 20px"></span></button>
             </div>
       </div>
       <br>
       <div id="display"></div>
<?php 
$output .= '  
<div class="not">
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">R.id</th>  
                     <th width="20%">Student Name</th>
                     <th width="20%">Father Name</th>
                      <th width="10%">Status</th>    
                     <th width="5%">Mark sheet</th>
                     <th width="10%">Action</th>
                     

                </tr>';  
if(mysqli_num_rows($sql) > 0)  
 {  
      while($row = mysqli_fetch_array($sql))  
      {  
           $output .= '
             
                <tr>  
                     <td>'.$row["stu_reg_no"].'</td>
                     <td>'.$row["stu_first_name"].'</td> 
                     <td>'.$row["stu_last_name"].'</td> 
                     <td>'.$row["msg_status"].'</td> 
                     <td><input type="button" name="view" value="view" id="'.$row["student_id"] .'" class="btn btn-info btn-sm view_data" /></td> 
                     <td><input type="button" name="send_result" value="Send Result" id="'.$row["student_id"] .'" class="btn btn-info btn-sm send_result" /></td> 
                     <input type="hidden" name="hid_status" id="hid_status" value="'.$row["msg_status"].'">
                      
                </tr>  
          
           ';  
      }  
     
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="5" class="text-danger">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
   </div>
      </div>';  
 echo $output; 
 ?>

</div>
</div>
<?php 
include 'modal_view_result.php';
 ?>




<script type="text/javascript">

$(document).ready(function() {
    var hid_status=$('#hid_status').val();
  if(hid_status == "Delivered" || hid_status == "Delivered Second Time"){
          $('#message').hide();
           }
});

   $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           var sel_exam=$('#sel_exam').val();
           var sel_class=$('#sel_class').val();
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"class/ajax_sql_student_result/select_result.php",  
                     method:"POST",  
                     data:{
                        employee_id: employee_id,
                        "exam_id" : sel_exam,
                        "class_id": sel_class
                      },
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });
   // For Send Result of One Student ->>
      $(document).on('click', '.send_result', function(e){  
           var employee_id = $(this).attr("id");  
           var sel_exam=$('#sel_exam').val();
           var sel_class=$('#sel_class').val();
           if(employee_id != '')  
           {  
             if (confirm('Are you sure you want to Send Result to a single student??')) { 
                $.ajax({  
                     url:"class/ajax_sql_student_result/single_stu_res.php",  
                     method:"POST",  
                     data:{
                        employee_id: employee_id,
                        "exam_id" : sel_exam,
                        "class_id": sel_class
                      },
                     success:function(data){  

                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });

                }  
           } 
             e.stopImmediatePropagation();           
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
 
               url: "class/ajax_sql_student_result/search_ajax.php",
 
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
 <script type="text/javascript">
   function send_sms(){
     $('#message').hide();
     // alert(sel_class);
      if (confirm('Are you sure you want to Send Result to All Students??')) { 
     $.ajax({
        url: 'class/ajax_sql_student_result/sms_to_all.php',
        method: 'POST',
        data: {
          exam_id: $('#hid_exam_id').val(),
          class_id: $('#hid_class_id').val()
        },
        success:function(data){
       $('#employee_detail').html(data);  
       $('#dataModal').modal('show'); 

        }
     });
   }
   }
 </script>
 

