<?php
include 'include/top_web.php';

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
   ?>
   <title>View Attandance</title>
<?php  
include 'include/header.php'; 
include 'include/navigation.php'; 
 ?>
    
    <!-- Side Navbar -->
    
    <div class="page">
     
<?php 
include 'include/web_header.php'; 
?>
      
<!-- content area -->
<br>  
<br>  
<div class="container "> 
<div class="row">
<div class="col-sm-12">
  <div class="card">
    <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i>
      &nbsp;Attandance List&emsp;</h6>
      <div class="col-sm-12">
        <?php 
 $sql_present = mysqli_query($conn,"SELECT * FROM attandance WHERE status = 'Present' AND DATE(time_to_show) = DATE(NOW())");
 $sql_leave = mysqli_query($conn,"SELECT * FROM attandance WHERE status = 'Leave' AND DATE(time_to_show) = DATE(NOW())");
 $sql_absent = mysqli_query($conn,"SELECT * FROM attandance WHERE status = 'Absent' AND DATE(time_to_show) = DATE(NOW())");
         ?>
        
      </div>            <!-- Modal-->
    <div class="card-body">
  <div class="container">
    <div class="row" >
      <div class="col-sm-4 text-center" style="border: 2px solid black;border-radius: 15px;">
      <?php 
$row_present = mysqli_num_rows($sql_present);
       ?>
        <h2 class="text-success"><?php echo $row_present; ?> Present</h2>
      </div>
      <div class="col-sm-4 text-center" style="border: 2px solid black;border-radius: 15px;">
        <?php 
$row_leave = mysqli_num_rows($sql_leave);
       ?>
        <h2 class="text-info"><?php echo $row_leave; ?> on Leave</h2>
      </div>
      <div class="col-sm-4 text-center" style="border: 2px solid black;border-radius: 15px;">
         <?php 
$row_absent = mysqli_num_rows($sql_absent);
       ?>
        <h2 class="text-danger"><?php echo $row_absent; ?> Absent</h2>
      </div>
    </div>
  </div>
 </div>
  
   <table class="table table-bordered table-hover">
  <tr style="background-color: #0f1427;color: white">
    <th>#</th>
    <th>R.ID</th>
    <th>Student name</th>
    <th>Class</th>
    <th>Student status</th>
    <th>Attandance status</th>
    <th>Contact No</th>
    <th>Date</th>

  </tr>
   <?php 

 
$i = 0;
$select_all = mysqli_query($conn,"
  SELECT A.attandance_status,A.id,A.time_to_show,
  A.status,B.stu_first_name,B.stu_last_name,
  B.stu_reg_no,B.phone,B.studentid,C.class_name 
  FROM attandance as A inner join 
  students as B on A.student_id=B.studentid
   inner join class as C on 
   B.class_id=C.classid 
   WHERE DATE(A.time_to_show) = DATE(NOW())");
while ($value = mysqli_fetch_array($select_all)) {
$i++;
 ?>

<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo $value['stu_reg_no']; ?></td>
  <td><?php echo $value['stu_first_name']." ".$value['stu_last_name']; ?></td>
  <td><?php echo $value['class_name']; ?></td>
  <td><?php echo $value['status']; ?></td>
  <td><?php echo $value['attandance_status']; ?></td>
  <td><?php echo $value['phone']; ?></td>
  <td><?php echo $value['time_to_show']; ?></td>
      
</tr>
 <?php } ?>
</table>
 <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>

<!-- Add data modal start -->

<!-- Add data modal end -->

   <?php 
}
else{
header('location: login1.php');
 } ?>