<?php
include 'include/top_web.php';


if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
 ?>
 <title>Visitors Form</title>
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
      &nbsp;Class List&emsp;<a href="" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"><span class="add"><i class="fa fa-plus"></i>&nbsp; Add Visitor </span></a></h6>
      <div class="col-sm-12">
                  <!-- Modal-->
                  <div class="card-body">
    
        <?php 
 $query = "SELECT * FROM guest_student ORDER BY id DESC";
$result = mysqli_query($conn,$query);
?>
      
       
    </div>
     <div class="col-md-4 offset-md-8">
           <div class="input-group" id="adv-search">
                <input type="text" class="form-control" id="search" placeholder="Enter Keyword To search Data" style="border:1px solid black;border-top-left-radius: 15px" />
                <button type="button" class="btn btn-primary"><span class="fa fa-search" aria-hidden="true" style="height: 20px"></span></button>
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
      <th>#</th>
      <th>Student Name</th>
      <th>Father Name</th>
      <th>Father Business</th>
      <th>Prevoius institute</th>
      <th>class</th>
      <th>Contact Number</th>
      <th>Address</th>
      <th>Stauts</th>
      <th colspan="4">Action</th>
    </tr>
  
      <?php
     $i=0;
      while($row = mysqli_fetch_array($result))
      {
        $i++;
      ?>
      <tr id="<?php echo $row['id']; ?>">
        <td><?php echo $i; ?></td>
        <td><?php echo $row["student_name"]; ?></td>
       <td><?php echo $row["father_name"]; ?></td>
       <td><?php echo $row["father_business"]; ?></td>
       <td><?php echo $row["previous_institute"]; ?></td>
       <td><?php echo $row["class"]; ?></td>
       <td><?php echo $row["contact_number"]; ?></td>
       <td><?php echo $row["address"]; ?></td>
       <td><?php echo $row["Add_status"]; ?></td>
       
        <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
       <td><input type="button" name="Send_SMS" value="Send_SMS" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm Send_SMS" /></td>
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
include 'modals/modal_add_visitor.php';
 ?>
<!-- Add data modal end -->

<!-- update data modal start -->


<!-- update Data modal End -->
<script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"class/Ajax_sql_visitors/fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#std_name').val(data.student_name);  
                     $('#sf_name').val(data.father_name);  
                     $('#ftocu_name').val(data.father_business);  
                     $('#p_ins_name').val(data.previous_institute);  
                     $('#std_class').val(data.class);  
                     $('#mob_num').val(data.contact_number);  
                     $('#stu_add').val(data.address);    
                     $('#status').val(data.Add_status);  
                     $('#employee_id').val(data.id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
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
                     url:"class/Ajax_sql_visitors/insert.php",  
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
      $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"class/Ajax_sql_visitors/select.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      }); 
       $(document).on('click', '.Send_SMS', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"class/Ajax_sql_visitors/send_sms.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
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
                     url:"class/Ajax_sql_visitors/delete.php",  
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



  <script type="text/javascript">
  function fill(Value) {
 
   //Assigning value to "search" div in "search.php" file.
 
   $('#search').val(Value);
 
   //Hiding "display" div in "search.php" file.
}
    $(document).ready(function() {
 
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
 
   $("#search").keyup(function() {
 
       //Assigning search box value to javascript variable named as "name".
 
       var name = $('#search').val();


 
       //Validating, if "name" is empty.
 
       if (name == "") {
 
           //Assigning empty value to "display" div in "search.php" file.
 
           $("#display").html("");
          $(".no").show();
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/Ajax_sql_visitors/search_ajax.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
 
               },
 
               //If result found, this funtion will be called.
 
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
      
              $("#display").html(html).show();      
              $(".no").hide(); 
               }
 
           });
 
       }
 
   });
 
});
 </script>
 <?php 
}
else{
header('location: login1.php');
 } ?>