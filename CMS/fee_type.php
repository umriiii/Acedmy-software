<?php
include 'include/top_web.php';

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
   ?>
   <title>Fee Types</title>
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
<div class="container "> 
<div class="row">
<div class="col-sm-12">
  <div class="card">
    <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i>
      &nbsp;Fee Types List&emsp;<a href="" name="age" id="add" data-toggle="modal" data-target="#add_data_Modal"><span class="add"><i class="fa fa-plus"></i>&nbsp; Add Fee Type </span></a></h6>
      <div class="col-sm-12">
                  <!-- Modal-->
     <div class="card-body">
       
   <div class="table-responsive">
    <br />
    <div id="employee_table">
      <div id="display"></div>
      <div class="no">
     <table id="user_data" class="table table-bordered table-hover table-striped">
      <thead>
      <tr>
        <th >#S.No</th> 
      <th >Voucher Tiltle</th>
      <th >Fee Tiltle</th>
      
      <th>Fee Amount</th>
       <th >Due Date</th>     
       
        <th>Installment Type</th> 
         <th>Type</th>  
         <th>Fine</th>       
       <th >Running Status</th> 
       <th>Update</th>
       <th>Delete</th>
      </tr>
    </thead>
     </table>
   </div>
    </div>
   </div>  
 
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
include 'modals/modal_fee_type.php';
 ?>
<!-- Add data modal end -->

<!-- update data modal start -->


<!-- update Data modal End -->
<script type="text/javascript">  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert_form')[0].reset();
  $('.modal-title').text("Add Class");
  $('#operation').val("Add"); 
  $('#insert').val("Add Data"); 
      }); 
       var dataTable = jQuery('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"req/fee_type/fetch.php",
   type:"POST"
  }
 
 
 });

// ******************************************************************************************************************************************************************************
// insert data
// ********************************************************************************************************************************************************************************
 $(document).on('submit', '#insert_form', function(event){
  event.preventDefault(); 
       $.ajax({
    url:"req/fee_type/insert.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     $('#insert_form')[0].reset();
     $('#add_data_Modal').modal('hide');
     dataTable.ajax.reload();
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

// ******************************************************************************************************************************************************************************
// Update data
// ********************************************************************************************************************************************************************************

$(document).on('click', '.update', function(){
 
  var user_id = $(this).attr("id");
  $.ajax({
   url:"req/fee_type/fetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
  
    $('#add_data_Modal').modal('show');
    $('#v_title').val(data.v_title);     
    $('#title').val(data.title);     
    $('#insta_name').val(data.insta_name);     
    $('#due_date').val(data.due_date);     
    $('#fine').val(data.fine);     
    $('#ft_kind').val(data.ft_kind);     
    $('#install_id').val(data.instaid);     
    $('#def_fee').val(data.def_fee);     
   $('#running_status').val(data.running_status);
   $('#employee_id').val(data.ftid);

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
    url:"req/fee_type/delete.php",
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


   <?php 
}
else{
header('location: login1.php');
 } ?>