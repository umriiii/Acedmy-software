<?php
include 'include/top_web.php';

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
   ?>
    <title>Student Result</title>
    <?php  
include 'include/header.php'; 
include 'include/navigation.php'; 
 ?>

    <!-- Side Navbar -->

    <div class="page">

        <?php 
include 'include/web_header.php'; 
?>
        <br><br>
        <!-- content area -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i> &nbsp;Student Result List</h6>
                    </div>
                    <div class="container">
                      <form id="formoid" action="" title="" method="post">
                           <div class="row">
                               <table class="table table-bordered  table-striped">
                                <div class="col-sm-12">
                                  <tr>
                                    <th><label>Select Exam</label></th>
                                    <th><label>Select Class</label></th>
                                    <th> <label>Select Subject</label></th>
                                    <th><label>Marks Out of</label></th>
                                    <th>Manage</th>
                                  </tr>
                            <tr>
                            <td width="35%">
                            <select name="sel_exam" id="sel_exam" class="form-control" required="">
                              <option value="" selected="">--select exam--</option>
                              <?php 
$query=mysqli_query($conn,"SELECT * FROM exams WHERE exam_status='Active'");
while ($row=mysqli_fetch_array($query)) {
                              ?>
                              <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                              <?php } ?>
                            </select>
                           </td>
                           <td width="35%">
                            <select name="sel_class" id="sel_class" class="form-control" required="" onchange="my_function();">
                              <option value="" selected="" >--select class--</option>
                              <?php 
$sql=mysqli_query($conn,"SELECT * FROM class  WHERE running_status = 'Active'");
while ($row1=mysqli_fetch_array($sql)) {
                              ?>
                              <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                              <?php 
                                }
                               ?>
                            </select>
                        </td>
                       <td width="35%">
                          <div id="sho"></div>
                           <select name="sel_sub" id="sel_sub" class="form-control no" disabled="">
                            <option disabled="" selected="">--select class first--</option>
                            </select>
                        </td>
                        <td>
                          <input type="number" name="mark_out" id="mark_out" placeholder="Enter makrs out of" required="" style="height: 35px;color: red;margin-top: 3px">
                        </td>
                        <td width="35%">
                           <input type="submit" id="submitButton"  name="submitButton" class="btn btn-outline-info" onclick="res_fun();" value="manage result" disabled="">

                        </td>
                    </tr>
                          </div>
                          </table>
                        </div>
                       </form>
                          <div id="status" style="position: sticky;
  position: -webkit-sticky;
  top: 0;"></div>
                        <div class="table-responsive">
                            <br />
                            <div id="live_data"></div>
                            <div id="sms_res"></div>
                        </div>
        </div>
      </div>
    </div>
  </div>


                    <!-- JavaScript files-->

                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script type="text/javascript" src="student_fee_script.js"></script>
                    <script src="vendor/popper.js/umd/popper.min.js">
                    </script>
                    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
                    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
                    <script src="vendor/jquery.cookie/jquery.cookie.js">
                    </script>
                    <script src="vendor/chart.js/Chart.min.js"></script>
                    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
                    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
                    <script src="js/charts-home.js"></script>
                    <!-- Main File-->
                    <script src="js/front.js"></script>
                    </body>

                    </html>

                    <script>
                        $(document).ready(function() {
                         

    var offSeconds = 0;
    var onSeconds = 12;
    $("input[type='submit']").attr("disabled", false);
    $("#formoid").submit(function(){
      setTimeout(function(){
        $("input[type='submit']").attr("disabled", true).val("Please wait...").removeClass('btn-outline-info').addClass('btn-danger');
      
    }, offSeconds*1000);
      setTimeout(function(){
        $("input[type='submit']").attr("disabled", false).val("manage result").removeClass('btn-danger').addClass('btn-outline-info');
      
    }, onSeconds*1000);
      
    });
 

                            function fetch_data() {
                                $.ajax({
                                    url: "class/ajax_sql_student_result/select.php",
                                    method: "POST",
                                    data: {
                                           exam_id: $('#sel_exam').val(),
                                           class_id: $('#sel_class').val(),
                                           sub_id: $('#sel_sub').val()
          
                                          },
                                    success: function(data) {
                                        $('#live_data').html(data);
                                    }
                                });
                            }
                            fetch_data();
                          function edit_data(id, text, column_name) {
                                $.ajax({
                                    url: "class/ajax_sql_student_result/edit.php",
                                    method: "POST",
                                    data: {
                                        id: id,
                                        text: text,
                                        column_name: column_name
                                    },
                                    beforeSend:function(){  
                                          $('#status').html("<div class='alert alert-danger'>Updating...</div>");
                                     },  
                                    dataType: "text",
                                    success: function(data) {
                                       
                                          $('#status').html("<div class='alert alert-success'>Updated</div>");
                                    }
                                });
                            }
                            $(document).on('blur', '.total_mark', function() {
                                var id = $(this).data("id1");
                                var total_mark = $(this).text();
                                edit_data(id, total_mark, "total_mark");
                            });
                             $(document).on('blur', '.obt_mark', function() {
                                var id = $(this).data("id2");
                                var obt_mark = $(this).text();
                                edit_data(id, obt_mark, "mark_obt");
                            });
                              $(document).on('blur', '.comment', function() {
                                var id = $(this).data("id3");
                                var comment = $(this).text();
                                edit_data(id, comment, "comment");
                            });
                            
                        });

                    </script>
     



                    <!-- script to enter data -->
                    <script type='text/javascript'>
    /* attach a submit handler to the form */
    $("#formoid").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();

      /* get the action attribute from the <form action=""> element */
      

      /* Send the data using post with element id name and name2*/
      var posting = $.post( "class/ajax_sql_student_result/insert.php", { exam_name: $('#sel_exam').val(),
                                        class_name: $('#sel_class').val(),
                                        mark_out: $('#mark_out').val(),
                                        sub_name: $('#sel_sub').val()} );

      /* Alerts the results */
      posting.done(function( data ) {
        fetch_data();
        reset();
      });
      
    });
</script>
 
<script type="text/javascript">
   function res_fun(){
     
     // alert(sel_class);
     $.ajax({
        url: 'class/ajax_sql_student_result/select.php',
        method: 'POST',
        data: {
          exam_id: $('#sel_exam').val(),
          class_id: $('#sel_class').val(),
          sub_id: $('#sel_sub').val()
          
        },
        success:function(data){
          
        $('#live_data').html(data);

        }
     });
   }
 </script>
         
 

 <!-- show subject accordingly -->
 <script type="text/javascript">
   function my_function(){
     var sel_class=$('#sel_class').val();
     // alert(sel_class);
     $.ajax({
        url: 'class/ajax_sql_student_result/show_sub_resp.php',
        method: 'POST',
        data: {"class_id": sel_class},
        success:function(data){
           $('.no').hide();
        $('#sho').html(data);
        }
     });
   }
 </script>
  <script type="text/javascript">
   function del_res(){
     
     // alert(sel_class);
     $.ajax({
        url: 'class/ajax_sql_student_result/delete_all_res.php',
        method: 'POST',
        data: {
          exam_id: $('#sel_exam').val(),
          class_id: $('#sel_class').val(),
          sub_id: $('#sel_sub').val()
        },
        success:function(data){
        $('#sms_res').html(data);
        $('.not').hide(); 
        }
     });
   }
 </script>
   <?php
}
else{
  header('location: login1.php');
 } ?>