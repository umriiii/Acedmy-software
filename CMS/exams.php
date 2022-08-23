<?php
include 'include/top_web.php';

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal'])){
 ?>
 <title>Exams</title>
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
      &nbsp;Class List&emsp;<a href="" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"><span class="add"><i class="fa fa-plus"></i>&nbsp; Add exam </span></a></h6>
      <div class="col-sm-12">
                  <!-- Modal-->
                  <div class="card-body">
     
        <?php 
 $query = "SELECT * FROM exams WHERE exam_status = 'Active' ORDER BY examid DESC";
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
    
   <br />  
   <div class="table-responsive">
    <br />
    <div id="employee_table">
      <div id="display"></div>
      <div class="no">
     <table class="table table-bordered">
      <tr>
        <th width="10%">#S.No</th> 
       <th width="30%">Exam Name</th>    
       <th width="30%">Exam date</th>
       <th width="30%">Exam Status</th>
       <th width="20%">Comments</th>
       <th width="30%" colspan="3">Action</th>
      </tr>
      <?php
     $i=0;
      while($row = mysqli_fetch_array($result))
      {
        $i++;
      ?>
       <tr id="<?php echo $row['examid']; ?>">
        <td><?php echo $i; ?></td>
       <td  data-target="teachername"><?php echo $row["exam_name"]; ?></td>
       <td  data-target="address"><?php echo $row["exam_date"]; ?></td>
       <td  data-target="address"><?php echo $row["exam_status"]; ?></td>
       <td  data-target="address"><?php echo $row["exam_comment"]; ?></td>
       <td><input type="button" name="view" value="view" id="<?php echo $row["examid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["examid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["examid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
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
include 'modals/modal_add_exams.php';
 ?>
<!-- Add data modal end -->


<script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"class/ajax_sql_exams/fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){ 

                     $('#ex_name').val(data.exam_name);  
                     $('#ex_date').val(data.exam_date);  
                     $('#ex_com').val(data.exam_comment);  
                     $('#employee_id').val(data.examid);
                     $('#exam_status').val(data.exam_status);
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#ex_name').val() == "")  
  {  
   alert("Enter Exam Name");  
  }  
  else if($('#ex_date').val() == '')  
  {  
   alert("Enter Exam Date");  
  }  
  else if($('#ex_com').val() == '')
  {  
   alert("Enter Any Comments");  
  }
 
 
           else  
           {  
                $.ajax({  
                     url:"class/ajax_sql_exams/insert.php",  
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
                     url:"class/ajax_sql_exams/select.php",  
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
                     url:"class/ajax_sql_exams/delete.php",  
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
            $('.no').show(); 
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_exams/search_ajax.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
 
               },
 
               //If result found, this funtion will be called.
 
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
      
              $("#display").html(html).show();      
               $('.no').hide();  
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