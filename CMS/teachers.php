<?php
include 'include/top_web.php';

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
   ?>
   <title>Teacher</title>
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
      &nbsp;Class List&emsp;<a href="" id="add" data-toggle="modal" data-target="#add_data_Modal"><span class="add"><i class="fa fa-plus"></i>&nbsp; Add Teacher </span></a></h6>
      <div class="col-md-12">
                  <!-- Modal-->
                  <div class="card-body">
      <div class="col-md-4 offset-md-4">
        <label><h4>Select Designation for Teachers</h4></label>
           <select name="sel_des" id="sel_des" class="form-control">
      <option value="">--Select Designation--</option>
      <?php 
      $sql=mysqli_query($conn,"SELECT * FROM designation");
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
        <th>Teacher name</th>
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
include 'modals/modal_addteacher.php';
 ?>
<!-- Add data modal end -->

<!-- update data modal start -->
<script type="text/javascript">  
 $(document).ready(function(){ 

        $('#insert_form').parsley(); 
 });  
 </script> 

<!-- update Data modal End -->
<script type="text/javascript">

 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $("#insert_form")[0].reset();
      });
function fill_datatable(teacherid = '')
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"req/teacher/fetch.php",  
     type:"POST",
     data:{
      teacherid:teacherid
     }
    },
        
   });
        
  }


  $(document).on('change', '#sel_des', function(){

   var teacherid = $(this).val();
   if(teacherid != '')
   {
    $('#user_data').DataTable().destroy();
    fill_datatable(teacherid);
   }
   else
   {
    alert('Select filter option');
    $('#user_data').DataTable().destroy();
    fill_datatable();
   }
  });
  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
                $.ajax({  
                     url:"class/ajax_sql_teachers/insert.php",  
                     method:"POST",  
                     data:  new FormData(this),
                      contentType: false,
                      cache: false,
                      processData:false,  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){ 
                        
                    $('#insert_form')[0].reset();  
                    $('#add_data_Modal').modal('hide');  
                    $('#f_name').val('');  
                     $('#l_name').val('');  
                     $('#birthday').val('');  
                     $('#gender').val('');  
                     $('#religion').val('');  
                     $('#blood').val('');  
                     $('#address').val('');  
                     $('#phone').val('');  
                     $('#email').val('');   
                     $('#employee_id').val('');   
                     }  
                });  
           // }  
      });   
 });  
 </script>

 <script type="text/javascript">
    $(document).on('click', '.btn_delete', function(){  
           // var id=$(this).data("id3");
            var el = this;
        var id = this.id;
        var splitid = id.split("_");

        // Delete id
        var deleteid = splitid[1];  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                    // url:"class/ajax_sql_teachers/delete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                           $(el).closest('tr').css('background','#d31027');
                $(el).closest('tr').fadeOut(800, function(){      
                    $(this).remove();
                });  
                            
                     }  
                });  
           }  
      }); 
 </script>
 
<?php
}
else{
header('location: login1.php');
 } ?>