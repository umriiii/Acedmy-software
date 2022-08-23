<?php
include 'include/top_web.php';


if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
?>
<title>Classes</title>
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
      &nbsp;Class List&emsp;</h6>
      <div class="col-sm-12">
                  <!-- Modal-->
        
  
        <?php 
 $query = "SELECT 
       * 
           FROM settings";
$result = mysqli_query($conn,$query);
$cou=mysqli_num_rows($result);
         ?>
  
       </div>
       
    </div>
  
 <div class="container">  
    
 
   <div class="table-responsive">
    <br />
    <div id="employee_table">
      <div id="display"></div>
      <div class="no">
     <table class="table table-bordered table-hover table-striped">
      <tr> 
        <th width="15%">Logo</th>
       <th width="20%">System Name</th>    
       <th width="20%">Phone No</th>
       <th width="30%" colspan="2">Action</th>
      </tr>
      <?php
   
      while($row = mysqli_fetch_array($result))
      {
        
      ?>
      <tr>
      
       <td><img src="class/personal_settings/files/<?php echo $row['logo']; ?>" height="100" width="100"></td>
       <td><?php echo $row["name"]; ?></td>
       <td><?php echo '+'.$row["phone"]; ?></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["settingid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["settingid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
      <?php
      }
      ?>
     </table>
   </div>
    </div>
   </div>  
  </div>        <br /><br />  
   
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
 
include 'modals/modal_personal.php';

 ?>
<!-- Add data modal end -->

<!-- update data modal start -->


<!-- update Data modal End -->
<script type="text/javascript">  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"class/personal_settings/fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#system_name').val(data.name);  
                     $('#phone').val(data.phone);    
                     $('#logo').val(data.logo);    
                     $('#employee_id').val(data.settingid);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });
        $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
       
                $.ajax({  
                     url:"class/personal_settings/insert.php",  
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
                          $('#employee_table').html(data);  
                     }  
                });  
            
      });     
 });  



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
                     url:"class/personal_settings/delete.php",  
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