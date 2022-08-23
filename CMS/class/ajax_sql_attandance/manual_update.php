<br>
<?php
date_default_timezone_set("Asia/Karachi");
 include '../config/db.php'; 
  $create_on = date("Y-m-d");
if(isset($_POST['manual_absent_id'])){
  $ABSENT_STUDENT_ID = $_POST['manual_absent_id'];
$update = mysqli_query($connect," UPDATE attandance   
           SET status='Absent'
           WHERE student_id = '$ABSENT_STUDENT_ID' 
           AND create_on = '$create_on'");
$sql = mysqli_query($connect,"SELECT A.studentid,A.phone,A.stu_first_name,B.create_on FROM students as A inner join attandance as B on A.studentid = B.student_id WHERE A.studentid = '$ABSENT_STUDENT_ID' AND B.create_on = '$create_on'");
$Sql_absent = mysqli_query($connect,"SELECT * FROM settings");
$absent_row = mysqli_fetch_array($Sql_absent);
$row = mysqli_fetch_array($sql);
$student_name = $row['stu_first_name'];
$stu_ph_no = $row['phone'];
$absent_sms = $absent_row['absent_sms'];
$sms =  $student_name." ".$absent_sms;
include '../config/sms_api.php';
}
if(isset($_POST['manual_leave_id'])){
  $LEAVE_STUDENT_ID = $_POST['manual_leave_id'];
$update = mysqli_query($connect," UPDATE attandance   
           SET status='Leave'
           WHERE student_id = '$LEAVE_STUDENT_ID' 
           AND create_on = '$create_on'");
$sql = mysqli_query($connect,"SELECT A.studentid,A.phone,A.stu_first_name,B.create_on FROM students as A inner join attandance as B on A.studentid = B.student_id WHERE A.studentid = '$LEAVE_STUDENT_ID' AND B.create_on = '$create_on' ");
$Sql_leave = mysqli_query($connect,"SELECT * FROM settings");
$leave_row = mysqli_fetch_array($Sql_leave);
$row = mysqli_fetch_array($sql);
$student_name = $row['stu_first_name'];
$stu_ph_no = $row['phone'];
$leave_sms = $leave_row['leave_sms'];
$sms =  $student_name." ".$leave_sms;
include '../config/sms_api.php';
} 
 ?>

 <br>
 <div id="display"></div>
 <div class="no">
  <table class="table table-bordered table-hover">
  <tr>
    <th>#</th>
    <th>R.ID</th>
    <th>Student name</th>
    <th>Father name</th>
    <th>Class</th>
    <th>Status</th>
    <th>Contact No</th>
    <th>Date</th>
    <th colspan="2">Action</th>
  </tr>
  <?php 

 $create_on = date("Y-m-d");
$i = 0;
$select_all = mysqli_query($connect,
  "SELECT A.id,A.time_to_show,A.status,A.create_on,
  B.stu_first_name,B.stu_last_name,
  B.stu_reg_no,B.phone,B.studentid,
  C.class_name 
  FROM attandance as A 
  inner join students as B 
  on A.student_id=B.studentid
  inner join class as C 
  on B.class_id=C.classid 
  WHERE A.status = 'Present' AND A.create_on = '$create_on'");
while ($value = mysqli_fetch_array($select_all)) {
$i++;
 ?>
<tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $value['stu_reg_no']; ?></td>
      <td><?php echo $value['stu_first_name']; ?></td>
      <td><?php echo $value['stu_last_name']; ?></td>
      <td><?php echo $value['class_name']; ?></td>
      <td><?php echo $value['status']; ?></td>
      <td><?php echo $value['phone']; ?></td>
      <td><?php echo $value['time_to_show']; ?></td>
      <td><input type="button" name="absent" value="Absent" id="<?php echo $value["studentid"]; ?>" class="btn btn-danger btn-sm absent" /></td>
      <td><input type="button" name="edit" value="Leave" id="<?php echo $value["studentid"]; ?>" class="btn btn-success btn-sm leave" /></td>
</tr>
 <?php } ?>
</table>
</div>
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
 
               url: "class/ajax_sql_attandance/search_ajax.php",
 
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