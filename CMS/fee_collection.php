<?php
include 'include/top_web.php';
if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
?>
<title>Fee Collection</title>
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
   <br>
   <label>Select Student</label>
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
   <h1 align="center">Fee Collection</h1>
   <div class="table-responsive">
 <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>#S.No</th> 
        <th>Fee Type</th>    
        <th>Student Name</th>
        <th>Father Name</th>
          <th>Class Name</th>
          <th>Fee Amount</th>
          <th>After Discount</th>
        <th>Collected Amount</th>
        
        <th>Status</th>
        <th>Fee Details</th>
      </tr>
     </thead>
    </table>
  
   </div>
  </div>
  </div>
</div>






    <!-- JavaScript files-->
 
<?php  
include 'modals/view_modal.php';
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

function fill_datatable(stu_id = '')
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"req/collect_fee/fetch_student.php",
     type:"POST",
     data:{
      stu_id:stu_id
     }
    },
        
   });
        
  }


  $(document).on('change', '#stu_id', function(){

   var stu_id = $(this).val();
   if(stu_id != '')
   {
    $('#user_data').DataTable().destroy();
    fill_datatable(stu_id);
   }
   else
   {
    alert('Select filter option');
    $('#user_data').DataTable().destroy();
    fill_datatable();
   }
  });

$(document).on('click', '.collect_fee', function(){
  var feeid = $(this).attr("id");
  $.ajax({
   url:"req/collect_fee/view.php",
   method:"POST",
   data:{fee_id:feeid},
   success:function(data)
   {
    $('#dataModal').modal('show');
    $('#display_modal_inputs').html(data);
    $('.modal-title').text("Collect Fee");
   }
  })
 });


  $(document).on('keyup', '.colted_amount', function(){
    var colted_amount=$(this).val();
    var hidden_feeid=$('#hidden_feeid').val();
     $.ajax({
        url: 'req/collect_fee/fee_col.php',
        method: 'POST',
        data:{colted_amount:colted_amount,feeid:hidden_feeid},
        success:function(data){
        $('#display').html(data);
       $('.not-show').hide();

       var stu_id = $('#stu_id').val();
        $('#user_data').DataTable().destroy();
    fill_datatable(stu_id);
        }
     });
    
});




});
   
      function fetch_data() {
        var class_id = $('#class_id').val();
                                 window.open('reports/class_fee_voucher.php?class_id='+class_id, '_blank');
                        }



 </script>
