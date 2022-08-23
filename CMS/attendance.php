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
    <div class="row no-print">
        <table  class="table table-bordered table-striped">
  <tr>
      <th>Select Class</th>
      <th>Filter</th>
    </tr>
    <tr>
     
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
     <button type="button" name="filter" id="filter" class="form-control btn btn-outline-primary">Filter</button>
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
   <h1 align="center">Attendance</h1>
   <a href="" name="age" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Add Manual Attencance </a>
   <br>
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
       <th>Normal</th>
        <th>Absent</th>
         <th>Late</th>
          <th>Leave</th>
           <th>Early Leave</th>
            <th>Late & Early Leave</th>
      </tr>
     </thead>
    </table>
  
   </div>
  </div>
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
     url:"req/collect_fee/fetch_student.php",
     type:"POST",
     data:{
      stu_id:stu_id
     }
    },
        
   });
          
  }

  function fill_class_data(class_id = '')
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"req/attendance/fetch_class.php",
     type:"POST",
     data:{
      class_id:class_id
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
 $(document).on('click', '#filter', function(){
       
   var class_id = $('#class_id').val();
   if(class_id != '')
   {
    $('#user_data').DataTable().destroy();
    fill_class_data(class_id);
   }
   else
   {
    alert('Select filter option');
    $('#user_data').DataTable().destroy();
    fill_class_data();
   }
                        });




 



// ******************************************************************************************************************************************************************************
// Normal
// ********************************************************************************************************************************************************************************

$(document).on('click', '.normal', function(){
  var user_id = $(this).attr("id");
   var el = this;
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, i am sure!'
}).then((result) => {
  if (result.value) {
      $.ajax({
    url:"req/attendance/normal.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
           $(el).closest('tr').css('background','#05ff33');
                $(el).closest('tr').fadeOut(5000, function(){      
                    
                });
      swal("Poof! Record has been deleted!", {
      icon: "success",
    });
     dataTable.ajax.reload();
    }
   });
    Swal.fire(
      'Message has been sent successfully',
      'Record Updated',
      'success'
    )
  }

})
 });

// ******************************************************************************************************************************************************************************
// Absent
// ********************************************************************************************************************************************************************************

$(document).on('click', '.absent', function(){
  var user_id = $(this).attr("id");
   var el = this;
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, i am sure!'
}).then((result) => {
  if (result.value) {
      $.ajax({
    url:"req/attendance/absent.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
           $(el).closest('tr').css('background','#05ff33');
                $(el).closest('tr').fadeOut(5000, function(){      
                    
                });
      swal("Poof! Record has been deleted!", {
      icon: "success",
    });
     dataTable.ajax.reload();
    }
   });
    Swal.fire(
      'Message has been sent successfully',
      'Record Updated',
      'success'
    )
  }

})
 });

// ******************************************************************************************************************************************************************************
// Early Leave
// ********************************************************************************************************************************************************************************

$(document).on('click', '.e_leave', function(){
  var user_id = $(this).attr("id");
   var el = this;
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, i am sure!'
}).then((result) => {
  if (result.value) {
      $.ajax({
    url:"req/attendance/early_leave.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
           $(el).closest('tr').css('background','#05ff33');
                $(el).closest('tr').fadeOut(5000, function(){      
                    
                });
      swal("Poof! Record has been deleted!", {
      icon: "success",
    });
     dataTable.ajax.reload();
    }
   });
    Swal.fire(
      'Message has been sent successfully',
      'Record Updated',
      'success'
    )
  }

})
 });
// ******************************************************************************************************************************************************************************
// Leave
// ********************************************************************************************************************************************************************************

$(document).on('click', '.leave', function(){
  var user_id = $(this).attr("id");
   var el = this;
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, i am sure!'
}).then((result) => {
  if (result.value) {
      $.ajax({
    url:"req/attendance/leave.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
           $(el).closest('tr').css('background','#05ff33');
                $(el).closest('tr').fadeOut(5000, function(){      
                    
                });
      swal("Poof! Record has been deleted!", {
      icon: "success",
    });
     dataTable.ajax.reload();
    }
   });
    Swal.fire(
      'Message has been sent successfully',
      'Record Updated',
      'success'
    )
  }

})
 });
// ******************************************************************************************************************************************************************************
// Late And Early Leave
// ********************************************************************************************************************************************************************************

$(document).on('click', '.late_e_leave', function(){
  var user_id = $(this).attr("id");
   var el = this;
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, i am sure!'
}).then((result) => {
  if (result.value) {
      $.ajax({
    url:"req/attendance/late_early.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
           $(el).closest('tr').css('background','#05ff33');
                $(el).closest('tr').fadeOut(5000, function(){      
                    
                });
      swal("Poof! Record has been deleted!", {
      icon: "success",
    });
     dataTable.ajax.reload();
    }
   });
    Swal.fire(
      'Message has been sent successfully',
      'Record Updated',
      'success'
    )
  }

})
 });
// ******************************************************************************************************************************************************************************
// Late
// ********************************************************************************************************************************************************************************

$(document).on('click', '.late', function(){
  var user_id = $(this).attr("id");
   var el = this;
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, i am sure!'
}).then((result) => {
  if (result.value) {
      $.ajax({
    url:"req/attendance/late.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
           $(el).closest('tr').css('background','#05ff33');
                $(el).closest('tr').fadeOut(5000, function(){      
                    
                });
      swal("Poof! Record has been deleted!", {
      icon: "success",
    });
     dataTable.ajax.reload();
    }
   });
    Swal.fire(
      'Message has been sent successfully',
      'Record Updated',
      'success'
    )
  }

})
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
