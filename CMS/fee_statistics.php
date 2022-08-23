<?php

include 'include/top_web.php';
if(isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
?>
<title>Fee Statistics</title>
<?php  
include 'include/header.php'; 
include 'include/navigation.php'; 
 ?>
    
    <!-- Side Navbar -->
    
    <div class="page">
     
<?php 
include 'include/web_header.php'; 
?>
      <br>
<!-- content area -->
<div class="container "> 
<div class="row">
<div class="col-sm-12">
  <div class="card">
    <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i>
      &nbsp;Fee Statistics&emsp;</h6>
      <div class="col-sm-12">
                  <!-- Modal-->
 
       
    </div>
    <br>
    
 <div class="container">  
    
   <div class="table-responsive">
   <br>
    <div id="employee_table">
      <div id="display"></div>
      <div class="no">
     <table class="table table-bordered table-hover table-striped">  
        <tr>
             <th>Total Fee</th>
             <th>Submitted Fee</th>
            
       </tr> 
      <?php
     $i=0;
     $total = 0;
     $Total_submitted_fee = 0;
         $select=mysqli_query($conn,"SELECT A.student_fee as student_discount,A.studentid,B.class_fee,B.running_status FROM students as A inner join class as B on A.class_id = B.classid WHERE B.running_status = 'Active'");
            while ($row=mysqli_fetch_array($select)) {
              $student_id = $row['studentid'];
             $student_fee_discount_per =  $row['student_discount'];
             $Class_fee = $row['class_fee'];
              $stu_fee_dis_act = $Class_fee * $student_fee_discount_per;
              $stu_fee_dis_act = $stu_fee_dis_act / 100;
              $Actual_stu_fee = $Class_fee - $stu_fee_dis_act;
              $array_actual_fee = array($Actual_stu_fee);
              $Sum_Actual_Fee = array_sum($array_actual_fee);
              $total += $Sum_Actual_Fee;

           $i++; 
      ?>
      
      <?php 
}
      ?>
       <tr>
        <td><b>RS  <?php echo $total; ?></b></td>
       <?php 
$query = mysqli_query($conn,"SELECT * FROM student_fee WHERE year(submit_on) = year(NOW())");
while ($row1 = mysqli_fetch_array($query)) {
  $Student_submitted_fee = array($row1['student_fee']);
  $Sum_submitted_Fee = array_sum($Student_submitted_fee);
  $Total_submitted_fee += $Sum_submitted_Fee; 
}
        ?>
        <td><b>RS <?php echo $Total_submitted_fee; ?></b></td>
        </tr>
     </table>
   </div>
    </div>
   </div>  
  </div>     

<audio id="audio">
    <source src="audio/clicking.mp3" type="audio/mpeg" />
</audio>

<?php 
include 'modals/modal_addfee.php';
 ?>
    <!-- JavaScript files-->

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

 </script>
<?php
}
else{
header('location: login1.php');
 } ?>

