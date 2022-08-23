<?php
include 'include/top_web.php';

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal'])){
  ?>
  <title>Student Attandance</title>
<?php  
include 'include/header.php'; 
include 'include/navigation.php'; 
 ?>
    <!-- Side Navbar -->
    <div class="page">
     
<?php 
include 'include/web_header.php'; 
?>
      <br>
<!-- content area -->
<div class="container">
    <div class="row">
      <?php 
      date_default_timezone_set("Asia/Karachi");
$query = mysqli_query($conn,"SELECT * FROM students");
$row = mysqli_fetch_array($query);
  $StudentID = $row['studentid'];
  $sel = mysqli_query($conn,"SELECT * FROM attandance WHERE student_id = '$StudentID' AND create_on = DATE(NOW())");
  $count = mysqli_num_rows($sel);
if($count > 0){

}else{
  ?>
   <div class="col-md-4">
          <h2>Attendance Button</h2>
           <input type="submit" name="check_absent" id="check_absent" disabled="" class="btn btn-info" value="Mark Attendance" onclick="Manual_attandance();">
            
        </div>
  <?php 
}
       ?>
       
        
         <br>
  <div class="col-md-4 offset-md-8">
           <div class="input-group" id="adv-search">
                <input type="text" class="form-control" id="search" placeholder="Enter Keyword To search Data" style="border:1px solid black;border-top-left-radius: 15px" />
                <button type="button" class="btn btn-primary"><span class="fa fa-search" aria-hidden="true" style="height: 20px"></span></button>
             </div>
       </div>
       <div class="col-md-12">
          <div id="loader" class="text-center" style="display: none;">
            <img src="img/ajax-loader.gif" >
          </div>
        </div>
        <div class="col-md-12">
      
          <div id="live_data"></div>
        <div class="not">
          <br>
             <table class="table table-bordered table-hover">
  <tr>
    <th>#</th>
    <th>R.ID</th>
    <th>Student name</th>
    <th>Father name</th>
    <th>Class</th>
    <th>Status</th>
    <th>Contact No</th>
    <th>Date</th>
    <th colspan="2">Action</th>
  </tr>
  
  <?php 

 
$i = 0;
$select_all = mysqli_query($conn,"SELECT A.id,A.time_to_show,
  A.status,B.stu_first_name,B.stu_last_name,
  B.stu_reg_no,B.phone,B.studentid,C.class_name 
  FROM attandance as A inner join 
  students as B on A.student_id=B.studentid
   inner join class as C on 
   B.class_id=C.classid 
   WHERE status = 'Present' AND DATE(time_to_show) = DATE(NOW())");
while ($value = mysqli_fetch_array($select_all)){
$i++;
 ?>

<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo $value['stu_reg_no']; ?></td>
  <td><?php echo $value['stu_first_name']; ?></td>
  <td><?php echo $value['stu_last_name']; ?></td>
  <td><?php echo $value['class_name']; ?></td>
  <td><?php echo $value['status']; ?></td>
  <td><?php echo $value['phone']; ?></td>
  <td><?php echo $value['time_to_show']; ?></td>
       <td><input type="button" name="absent" value="Absent" id="<?php echo $value["id"]; ?>" class="btn btn-danger btn-sm absent" /></td>
       <td><input type="button" name="leave" value="Leave" id="<?php echo $value["id"]; ?>" class="btn btn-success btn-sm leave" /></td>
</tr>
 <?php } ?>
</table>
</div>
            
        </div>

    </div>
</div>
    <!-- JavaScript files-->
    
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
 <script type="text/javascript">
               $(document).ready(function() {
                         

    var offSeconds = 0;
    var onSeconds = 50;
    $("#check_absent").attr("disabled", false);
    $("#check_absent").click(function(){
      setTimeout(function(){
        $("input[type='submit']").attr("disabled", true).val("Please wait...").removeClass('btn-outline-info').addClass('btn-danger');
      
    }, offSeconds*1000);
      setTimeout(function(){
        $("input[type='submit']").attr("disabled", false).val("Mark Attandance").removeClass('btn-danger').addClass('btn-outline-info');
      
    }, onSeconds*1000);
      
    });
})
 </script>
<script language="JavaScript" type="text/JavaScript">

$(document).on('click', '.absent', function(){  
           var manual_absent_id = $(this).attr("id"); 
           if (confirm('Are you sure you want to Absent this Student??')) { 
           $.ajax({  
                url:"class/ajax_sql_attandance/manual_update.php",  
                method:"POST",  
                data:{manual_absent_id:manual_absent_id},  
                success:function(data){  
                     $('#live_data').html(data);
                     $(".Dont_show").hide();
                     

                }  
           });
           }  
      });
 

</script>
 <script type="text/javascript">
         $(document).on('click', '.leave', function(){  
           var manual_leave_id = $(this).attr("id"); 
            if (confirm('Are you sure you want to Accept Leave??')) {  
           $.ajax({  
                url:"class/ajax_sql_attandance/manual_update.php",  
                method:"POST",  
                data:{manual_leave_id:manual_leave_id},  
                  
                success:function(data){ 
                
                     $('#live_data').html(data);
                     $(".Dont_show").hide();

                }  
           });
           }  
      });
 </script>
<script type="text/javascript">
   function Manual_attandance(){
     
     // alert(sel_class);
     $.ajax({
        url: 'class/ajax_sql_attandance/manual_present_status.php',
        method: 'POST',
         beforeSend:function(){  
                                          $("#loader").show();
                                     },
        success:function(data){
          
        $('#live_data').html(data);
        $("#loader").hide();
        $('.not').hide();
        location.reload();

        }
     });
   }
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
 
           $("#live_data").html("");
          $('.not').show();
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_attandance/search_ajax.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
 
               },
 
               //If result found, this funtion will be called.
                    beforeSend:function(){  
                                          $("#loader").show();
                                     },
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
      
              $("#live_data").html(html).show();      
              $('.not').hide(); 
                $("#loader").hide();
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
