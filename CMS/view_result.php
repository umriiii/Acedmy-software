<?php
include 'include/top_web.php';


if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal'])){
   ?>
     <title>View Result</title>
    <style type="text/css">
       @media print {

 div { position: static !important; display: inline; 
    }

}
    </style>
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
                    <div class="card no-print">
                        <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i> &nbsp;Student Result List</h6>
                    </div>
                    <div class="container no-print">
                      <form id="result_view_form" action="class/ajax_sql_student_result/insert_con.php" title="" method="post">
                           <div class="row">
                               <table class="table table-responsive table-bordered">
                                <div class="col-sm-12">
                                  <tr>
                                    <th><label>Select Exam</label></th>
                                    <th><label>Select Class</label></th>
                                  </tr>
                            <tr>
                            <td width="50%">
                            <select name="sel_exam" id="sel_exam" class="form-control" required="">
                              <option disabled="" selected="">--select exam--</option>
                              <?php 
$query=mysqli_query($conn,"SELECT * FROM exams WHERE exam_status='Active'");
while ($row=mysqli_fetch_array($query)) {
                              ?>
                              <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                              <?php } ?>
                            </select>
                           </td>
                           <td width="50%">
                            <select name="sel_class" id="sel_class" class="form-control" required="" onchange="my_function();">
                              <option disabled="" selected="" >--select class--</option>
                              <?php 
$sql=mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
while ($row1=mysqli_fetch_array($sql)) {
                              ?>
                              <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                              <?php 
                                }
                               ?>
                            </select>
                       
            <td>
              
            </td>
                    </tr>
                          </div>
                          </table>
                        </div>
                       </form>
                        </div>  
                        <div class="table-responsive">
                            <br />
                            <div id="live_data"></div>
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
                    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
                    <!-- Main File-->
                    <script src="js/front.js"></script>


                    </body>

                    </html>

                

  
          
                   
 
<script type="text/javascript">

$(document).ready(function() {

                            function fetch_data() {
                                $.ajax({
                                    url: "class/ajax_sql_student_result/insert_con.php",
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
                     });






   function my_function(){

     var sel_exam=$('#sel_exam').val();
     var sel_class=$('#sel_class').val();
     // alert(sel_class);
     $.ajax({
        url: 'class/ajax_sql_student_result/insert_con.php',
        method: 'POST',
        data: {
          "exam_id" : sel_exam,
          "class_id": sel_class
          
        },
        success:function(data){
           
        $('#live_data').html(data);

        }
     });
     
   }
 </script>
   <?php 
}
else{
header('location: login1.php');
 } ?>
        

 