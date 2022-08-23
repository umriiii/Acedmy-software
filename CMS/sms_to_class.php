<?php
include 'include/top_web.php';

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
   ?>
   <title>SMS To Class</title>
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
      &nbsp;Class List&emsp;<a href="" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"><span class="add"><i class="fa fa-plus"></i>&nbsp; Send SMS </span></a></h6>
      <div class="col-sm-12">
                  <!-- Modal-->
                  <div class="card-body">
     
        <?php 
 $query = "SELECT * FROM sms_to_class ORDER BY smsid DESC";
$result = mysqli_query($conn,$query);
?>
  </div>
 <div class="container">  
   <br />  
   <div class="table-responsive">
    <br />
    <div id="employee_table">
       <h1 id="display" class="text-center" style="color: red; font-size: 30px;"></h1>
     <table class="table table-bordered">
      <tr>
        <th width="5%">#S.No</th> 
       <th width="20%">Sms Title</th>    
       <th width="40%">Sms Details</th>
       <th width="20%">Date</th>
       <th width="20%">Status</th>
       <th width="20%">Select Class</th>
       <th width="30%" colspan="3">Action</th>
      </tr>
      <?php
     $i=0;
      while($row = mysqli_fetch_array($result))
      {
        $i++;
      ?>
       <tr">
        <td><?php echo $i; ?></td>
       <td><?php echo $row["sms_title"]; ?></td>
       <td><?php echo $row["sms_details"]; ?></td>
       <td><?php echo $row["create_on"]; ?></td>
       <td><?php echo $row["status"]; ?></td>
       <td><select name="class_sms_id" id="class_sms_id">
      <option value="" selected="">--Select Class--</option>
      <?php 
$sql = mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
while ($row1 = mysqli_fetch_array($sql)) {
 
       ?>
      <option value="<?php echo $row1['classid']; ?>"><?php echo $row1['class_name']; ?></option>
    <?php 
}
     ?>
     </select></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["smsid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Send sms" id="<?php echo $row["smsid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
       
      </tr>
      <?php
      }
      ?>
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
include 'modals/modal_sms_to_class.php';
 ?>
<!-- Add data modal end -->


<script>  
 $(document).ready(function(){  
      $(document).on('click', '.edit_data', function(){ 
           var that = $(this); 
           var employee_id = $(this).attr("id"); 
           var sms_class=$('#class_sms_id').val();
           if(sms_class != ''){
           if(confirm("Are you sure you want to send sms?"))  
           {   
           $.ajax({  
                url:"class/sms_to_class/insert.php",  
                method:"POST",  
                data:{
                  employee_id:employee_id,
                  sms_class : sms_class
                },  
                        beforeSend: function() {
        // setting a timeout
        $("#display").html('Wait Please');
    },
                success:function(data){ 
                     
                     $('#employee_id').val(data.smsid);  
                     // $(that).attr("disabled", true).val("message send").removeClass('btn-info').addClass('btn-success'); 
                     $('#employee_table').html(data); 
                }  
           }); 
           }
           } 
           else{
            alert('Please Select Class First');
           }
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#f_name').val() == "")  
  {  
   alert("First name is required");  
  }  
  else if($('#l_name').val() == '')  
  {  
   alert("Last name is required");  
  }  
  else if($('#birthday').val() == '')
  {  
   alert("Birthday is required");  
  }
  else if($('#gender').val() == '')
  {  
   alert("Gender is required");  
  }
  else if($('#religion').val() == '')
  {  
   alert("religion is required");  
  }
  else if($('#blood').val() == '')
  {  
   alert("Blood group is required");  
  }
   else if($('#address').val() == '')
  {  
   alert("Address is required");  
  }
   else if($('#phone').val() == '')
  {  
   alert("Phone number is required");  
  }
           else  
           {  
                $.ajax({  
                     url:"class/sms_to_class/insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#employee_table').html(data);  
                     }  
                });  
           }  
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
                     url:"class/sms_to_class/delete.php",  
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