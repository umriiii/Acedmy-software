<?php
include 'include/top_web.php';
if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
?>
<title>Fee Voucher</title>
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
<div class="container">
    <div class="row no-print">
        <table  class="table table-bordered table-striped">
  <tr>
      <th>Fee Type</th>
      <th>Select Class</th>
      <th>Generate Voucher</th>
    </tr>
    <tr>
      <td> 
        <select class="form-control selectpicker"  data-live-search="true" id="fee_type" name="fee_type" onchange="fee_Type();">
            <option value="" selected="">--Fee Type--</option>
           <?php 
$query = mysqli_query($conn,"SELECT * FROM fee_type WHERE running_status = 'Active'");
while ($row = mysqli_fetch_array($query)) {

            ?> 
            <option value="<?php echo $row['ftid'] ?>"><?php echo $row['title']; ?></option>
       <?php } ?>
        </select>
   </td>
    <td> <select class="form-control selectpicker"  data-live-search="true" id="class_id" name="class_id">
            <option value="" selected="">--Select Class--</option>
             <?php 
$query = mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
while ($row = mysqli_fetch_array($query)) {

            ?> 
            <option value="<?php echo $row['classid'] ?>"><?php echo $row['class_name']; ?></option>
       <?php } ?>
        </select>
   </td>
  
   <td>
     <button type="button" name="filter" id="filter" class="form-control btn btn-outline-primary" onclick="fetch_data()">Filter</button>
   </td>

    </tr>
   </table>
      <select class="form-control selectpicker"  data-live-search="true" id="stu_id" name="stu_id">
            <option value="" selected="">--Select Student--</option>
             <?php 
$query = mysqli_query($conn,"SELECT * FROM students");
while ($row = mysqli_fetch_array($query)) {
            ?> 
            <option value="<?php echo $row['studentid'] ?>"><?php echo $row['stu_reg_no']."-".$row['stu_first_name']." S/o ".$row['stu_last_name']; ?></option>
       <?php } ?>
        </select>
    </div>
</div>

    <div class="container-fluid box">
         <div class="row">
      <div class="col-md-12">
<br>
   <h1 align="center">Fee Voucher</h1>
   <div class="table-responsive">
  <div id="display">
    
  </div>
  
   </div>
  </div>
  </div>
</div>






    <!-- JavaScript files-->
 
<?php  
include 'include/fotter.php';
 ?>

  </body>
</html>
<?php 
}else{
    header('location: login1.php');
}
 ?>

 <script type="text/javascript">
    $(document).ready(function(){
    
 $(function() {

  $('.selectpicker').selectpicker();

});
});
   
      function fetch_data() {
        var class_id = $('#class_id').val();
                                 window.open('reports/class_fee_voucher.php?class_id='+class_id, '_blank');
                        }

$( "#fee_type" ).change(function() {
    var fee_type=$('#fee_type').val();
     $.ajax({
        url: 'class/ajax_monthly/fee_type.php',
        method: 'POST',
        data: {"only_fee_type": fee_type},
        success:function(data){
     
        $('#display').html(data);
       

        }
     });
    
});

 </script>
