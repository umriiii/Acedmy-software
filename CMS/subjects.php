<?php
include 'include/top_web.php';

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
   ?>
   <title>Subjects</title>
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
<div class="container"> 
<div class="row">
<div class="col-md-12">
  <div class="card">
    <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i>
      &nbsp;Class List&emsp;<a href="" id="add" data-toggle="modal" data-target="#add_data_Modal"><span class="add"><i class="fa fa-plus"></i>&nbsp; Add Subject </span></a></h6>
      <div class="col-md-12">
                  <!-- Modal-->
                  <div class="card-body">
      <div class="col-md-4 offset-md-4">
        <label><h4>Select Class for Subjects</h4></label>
           <select name="sel_class" id="sel_class" class="form-control">
      <option value="">--Select Class--</option>
      <?php 
      $sql=mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
      while ($row=mysqli_fetch_array($sql)) {
       ?>
      <option value="<?php echo $row[0] ?>"><?php echo $row[1]; ?></option>  
     <?php } ?>
     </select>
      </div> 
  
   <div class="table-responsive">
    <br />
    <div id="employee_table">
      <div id="display"></div>
      <div class="no">
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>#S.No</th> 
        <th>Subject</th>    
        <th>Teacher name</th>
        <th>Subject Class</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
     </thead>
    </table>
   </div>
    </div>
   </div>  
  </div> 
      
   
       <br /><br />  
   
<?php 
include 'include/fotter.php';
  ?>
  </body>
</html>

<!-- Add data modal start -->

<?php 
include 'modals/modal_add_subjects.php';
 ?>
<!-- Add data modal end -->

<!-- update data modal start -->
<script type="text/javascript">
$(document).ready(function(){ 

      $('#add').click(function(){  
           $('#insert_form')[0].reset();
  $('.modal-title').text("Add Class");
  $('#operation').val("Add"); 
  $('#insert').val("Add Data"); 
      }); 

 function fill_datatable(class_id = '')
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"req/subjects/fetch.php",
     type:"POST",
     data:{
      class_id:class_id
     }
    },
        
   });
        
  }


  $(document).on('change', '#sel_class', function(){

   var class_id = $(this).val();
   if(class_id != '')
   {
    $('#user_data').DataTable().destroy();
    fill_datatable(class_id);
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
    url:"req/subjects/insert.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
      var class_id = $('#sel_class').val();
      $('#user_data').DataTable().destroy();
        fill_datatable(class_id);
     $('#insert_form')[0].reset();
     $('#add_data_Modal').modal('hide');
     Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: data,
  showConfirmButton: false,
  timer: 2500
})
    
    }
   }); 
 });

// ******************************************************************************************************************************************************************************
// Update data
// ********************************************************************************************************************************************************************************

$(document).on('click', '.update', function(){
 
  var user_id = $(this).attr("id");
  $.ajax({
   url:"req/subjects/fetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
  
     $('#add_data_Modal').modal('show');
     $('#sub_name').val(data.sub_name);  
     $('#sub_tec').val(data.sub_tec_id);    
     $('#sub_class').val(data.class_id);    
     $('#employee_id').val(data.subjectid);          
     $('#operation').val("Edit");
     $('#insert').val("Edit Data");
   
   }
  })
 });

// ******************************************************************************************************************************************************************************
// Delete Data
// ********************************************************************************************************************************************************************************
$(document).on('click', '.delete', function(){
  var user_id = $(this).attr("id");
   var el = this;
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
      $.ajax({
    url:"req/subjects/delete.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
           $(el).closest('tr').css('background','#d31027');
                $(el).closest('tr').fadeOut(2000, function(){      
                    $(el).remove();
                });
      swal("Poof! Record has been deleted!", {
      icon: "success",
    });
     dataTable.ajax.reload();
    }
   });
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }

})

 
 }); 


    });
</script>

<!-- update Data modal End -->

   <?php 
}
else{
header('location: login1.php');
 } ?>