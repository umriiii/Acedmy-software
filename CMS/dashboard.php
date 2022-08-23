<?php
include 'include/top_web.php';
if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
 ?>
 <title>Home</title>
<?php  
include 'include/header.php'; 
include 'include/navigation.php'; 
 ?>
    
    <!-- Side Navbar -->
    
    <div class="page">
      <!-- navbar-->
<?php 
include 'include/web_header.php'; 

?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row dec">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <a href="student_info.php" style="text-decoration: none">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>

                <div class="name"><strong class="text-uppercase">Student</strong>
                  <span>Last 5 days</span>
                <?php 
$sql=mysqli_query($conn,"SELECT * FROM students");
$count=mysqli_num_rows($sql);
                 ?>
                  <div class="count-number"><?php echo $count; ?></div>
                </div>
              </div>
              </a>
            </div>
            
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Teachers</strong><span>Last 5 days</span>
                  <?php 
$sql_tec=mysqli_query($conn,"SELECT * FROM teacher");
$count_tec=mysqli_num_rows($sql_tec);
                 ?>
                  <div class="count-number"><?php echo $count_tec; ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-check"></i></div>
                <div class="name"><strong class="text-uppercase">Subjects</strong><span>Last 2 months</span>
                  <?php 
$sql_subjects = mysqli_query($conn,"SELECT A.sub_name,B.firstname,B.lastname,C.class_name,A.subjectid FROM subjects as A inner join teacher as B on A.sub_tec_id=B.teacherid inner join class as C on A.class_id=C.classid
 WHERE C.running_status = 'Active'");
$count_sub=mysqli_num_rows($sql_subjects);
                   ?>
                  <div class="count-number"><?php echo $count_sub; ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-bill"></i></div>
                <div class="name"><strong class="text-uppercase">Classes</strong><span>Last 2 days</span>
                  <?php 
                  
$sql_class=mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
$count_class=mysqli_num_rows($sql_class);
                 ?>
                   
                  <div class="count-number"><?php echo $count_class; ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list"></i></div>
                <div class="name"><strong class="text-uppercase">Exams</strong><span>Last 3 months</span>
                  <?php 
$sql_exams=mysqli_query($conn,"SELECT * FROM exams WHERE exam_status = 'Active'");
$count_exam=mysqli_num_rows($sql_exams); 
                   ?>
                  <div class="count-number"><?php echo $count_exam; ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->

            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list-1"></i></div>
                <div class="name"><strong class="text-uppercase">Attendance</strong><span>Today Attendance</span>
                   <?php 
$sql_attandance=mysqli_query($conn,"SELECT * FROM attandance WHERE DATE(time_to_show) = DATE(NOW())");
$count_attandacne=mysqli_num_rows($sql_attandance); 
                   ?>
                  <div class="count-number"><?php echo $count_attandacne; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Header Section-->
      <section class="dashboard-header section-padding">
        <div class="container-fluid">
          <div class="row d-flex align-items-md-stretch">
            <!-- To Do List-->
            <div class="col-lg-3 col-md-6">
              <div class="card to-do">
                <h2 class="display h4">To do List</h2>
                <p>This Section of Software is not Active yet</p>
                <ul class="check-lists list-unstyled">
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-1" name="list-1" class="form-control-custom">
                    <label for="list-1">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-2" name="list-2" class="form-control-custom">
                    <label for="list-2">Ed ut perspiciatis unde omnis iste</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-3" name="list-3" class="form-control-custom">
                    <label for="list-3">At vero eos et accusamus et iusto </label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-4" name="list-4" class="form-control-custom">
                    <label for="list-4">Explicabo Nemo ipsam voluptatem</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-5" name="list-5" class="form-control-custom">
                    <label for="list-5">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-6" name="list-6" class="form-control-custom">
                    <label for="list-6">At vero eos et accusamus et iusto </label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-7" name="list-7" class="form-control-custom">
                    <label for="list-7">Similique sunt in culpa qui officia</label>
                  </li>
                  <li class="d-flex align-items-center"> 
                    <input type="checkbox" id="list-8" name="list-8" class="form-control-custom">
                    <label for="list-8">Ed ut perspiciatis unde omnis iste</label>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Pie Chart-->
            <div class="col-lg-3 col-md-6">
              <div class="card project-progress">
                <h2 class="display h4">Project Beta progress</h2>
                <p> This Section of Software is not Active yet</p>
                <div class="pie-chart">
                  <canvas id="pieChart" width="300" height="300"> </canvas>
                </div>
              </div>
            </div>
            <!-- Line Chart -->
            <div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline">
              <div class="card sales-report">
                <h2 class="display h4">Statistics</h2>
                <p> This Section of Software is not Active yet</p>
                <div class="line-chart">
                  <canvas id="lineCahrt"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Statistics Section-->
 
      <!-- Updates Section -->
    
      <?php include 'include/fotter.php'; ?>
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
  var date = new Date();
date.setTime(date.getTime() + (30 * 1000));
$.cookie('username', username, { expires: date });
</script>
 <?php 
}
else{
 header("location:login1.php");

 } ?>