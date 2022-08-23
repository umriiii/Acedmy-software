<?php
include 'include/top_web.php';
if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
 ?>
 <title>Class Promotion</title>
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
      &nbsp;Class Promotion&emsp;</h6>
      <div class="col-sm-12">
                  <!-- Modal-->
                  <div class="card-body">
   
  </div>
 <div class="container">  
   <br />  
   <div class="table-responsive">
    <br />
    <div id="employee_table">
     <table class="table table-bordered">
      <tr>
       <th width="40">Select Class To be Promoted</th>
       <th width="40">Select Class into</th>
       <th width="10">Promote</th>
      </tr>
     <div class="alert alert-info"><h3 class="text-danger">Jis Class Me Promote Krna ha Wo Class Empty Honi Cahiye</h3></div>
       <tr>
        <td>
        <select name="old" id="old" class="form-control">
         <option disabled="" selected="">--select class</option>
         <?php 
$sql = mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
while ($row = mysqli_fetch_array($sql)) {
          ?>
          <option value="<?php echo $row['classid']; ?>"><?php echo $row['class_name']; ?></option>
<?php 
}
 ?>
       </select>
     </td>
     <td>
        <select name="new" id="new" class="form-control">
         <option disabled="" selected="">--select class</option>
         <?php 
$query = mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
while ($row1 = mysqli_fetch_array($query)) {
          ?>
          <option value="<?php echo $row1['classid']; ?>"><?php echo $row1['class_name']; ?></option>
<?php 
}
 ?>
       </select>
     </td>
     <td>
      <input type="button" name="promote" id="promote" onclick="promote();" class="btn btn-outline-success form-control" value="Promote">
     </td>
     <div id="sms_res"></div>
      </tr>
     
     </table>
    </div>
   </div>  
  </div><br /><br /> 

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

<?php 
include 'modals/modal_sms_to_all.php';
 ?>
<!-- Add data modal end -->


 <script type="text/javascript">
   $( "#promote" ).click(function promote(){
     
     // alert(sel_class);
     $.ajax({
        url: 'class/class_promote/class_promote.php',
        method: 'POST',
        data: {
          old_id: $('#old').val(),
          new_id: $('#new').val()
          
        },
        success:function(data){
        $('#sms_res').html(data);
        
        
        }
     });
   })
 </script>
 <?php 
}
else{
  header('location: login1.php');
 } ?>