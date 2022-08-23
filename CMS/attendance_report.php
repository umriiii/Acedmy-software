<?php
include 'include/top_web.php';
if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
?>
<title>Attendance</title>
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
  <br><br>
    <div class="row no-print">
    
   
   <h2>Select Student</h2>
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
   <h1 align="center">Attendance Report</h1>

   <br>
   <div class="table-responsive">
 <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>#S.No</th> 
       <th>Reg iD</th>    
       <th>Student Name</th>
       <th>Father Name</th>
       <th>Class</th>
       <th>Status</th>
       <th>Message Status</th>
       <th>Date</th>
      </tr>
     </thead>
    </table>
  
   </div>
  </div>

  <div class="col-md-3" style="border: 3px solid black;border-radius: 10px;text-align: center;"><h2>Normal <br> <?php   
$query = mysqli_query($conn,"SELECT * FROM raw_data WHERE att_status = 0");
$count = mysqli_num_rows($query);
echo $count;
   ?></h2></div>
  <div class="col-md-3" style="border: 3px solid black;border-radius: 10px;text-align: center;"><h2>Absent <br> <?php   
$query = mysqli_query($conn,"SELECT * FROM raw_data WHERE att_status = 1");
$count = mysqli_num_rows($query);
echo $count;
   ?></h2></div>
  <div class="col-md-3" style="border: 3px solid black;border-radius: 10px;text-align: center;"><h2>Late <br> <?php   
$query = mysqli_query($conn,"SELECT * FROM raw_data WHERE att_status = 2");
$count = mysqli_num_rows($query);
echo $count;
   ?></h2></div>
  <div class="col-md-3" style="border: 3px solid black;border-radius: 10px;text-align: center;"><h2>Leave <br> <?php   
$query = mysqli_query($conn,"SELECT * FROM raw_data WHERE att_status = 3");
$count = mysqli_num_rows($query);
echo $count;
   ?></h2></div>
  <div class="col-md-3" style="border: 3px solid black;border-radius: 10px;text-align: center;"><h2>Early Leave <br> <?php   
$query = mysqli_query($conn,"SELECT * FROM raw_data WHERE att_status = 4");
$count = mysqli_num_rows($query);
echo $count;
   ?></h2></div>
  <div class="col-md-3" style="border: 3px solid black;border-radius: 10px;text-align: center;"><h2>Late & Early Leave <br> <?php   
$query = mysqli_query($conn,"SELECT * FROM raw_data WHERE att_status = 5");
$count = mysqli_num_rows($query);
echo $count;
   ?></h2></div>
  </div>
</div>
    <!-- JavaScript files-->
<?php  
include 'modals/attendance_modal.php';
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
     $('#add').click(function(){  
           $('#insert_form')[0].reset();
  $('.modal-title').text("Add Attendance");
  $('#operation').val("Add"); 
  $('#insert').val("Submit Attendance"); 
      });
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
     url:"req/att_reports/fetch_student.php",
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





 


// ******************************************************************************************************************************************************************************
// insert data
// ********************************************************************************************************************************************************************************
 $(document).on('submit', '#insert_form', function(event){
  event.preventDefault(); 
       $.ajax({
    url:"req/attendance/insert.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     $('#insert_form')[0].reset();
     $('#add_data_Modal').modal('hide');
     $('#user_id').val('');
     Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: data,
  showConfirmButton: false,
  timer: 1500
})
    
    }
   }); 
 });




















});
   
      



 </script>
