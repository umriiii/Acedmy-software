<?php
 include 'classes/connection.php';
$connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
$get_all_table_query = "SHOW TABLES";
$statement = $connect->prepare($get_all_table_query);
$statement->execute();
$result = $statement->fetchAll();

if(isset($_POST['table']))
{
 $output = '';
 foreach($_POST["table"] as $table)
 {
  $show_table_query = "SHOW CREATE TABLE " . $table . "";
  $statement = $connect->prepare($show_table_query);
  $statement->execute();
  $show_table_result = $statement->fetchAll();

  foreach($show_table_result as $show_table_row)
  {
   $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
  }
  $select_query = "DELETE FROM " . $table . "";
  $statement = $connect->prepare($select_query);
  $statement->execute();
  $total_row = $statement->rowCount();

 
 }
 
}

?>
<?php
include 'include/top_web.php';
$expireAfter = 5;
 
//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        session_unset();
        session_destroy();
    }
    
}
 
//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();

if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
?>
<title>Delete Record</title>
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
<br />
  <div class="container">
   <div class="row">
    <div class="col-sm-12">
    <h2 align="center">Delete Data From DataBase</h2>
  </div>
    <br />
    <form method="post" id="export_form">
      <div class="col-sm-12">
     <h3>Select Tables for Delete</h3>
   </div>
    <div class="table-responsive">
    <table class="table table-bordered" style="width: 1000px">
     <tr>
      <th width="70">Table Name</th>
     
      <th width="10">Select</th>
     </tr>
    <?php
    foreach($result as $table)
    {
    ?>
      <tr>
     <div class="checkbox">
     
      
        
        <td>
         <?php echo $table["Tables_in_my_sms_project"]; ?>
        </td>
        <td><input type="checkbox" class="checkbox_table" name="table[]" value="<?php echo $table["Tables_in_my_sms_project"]; ?>" />
        </td>
      
   
     </div>
 </tr> 
    <?php
    }
    ?>
  </table>
     <div class="form-group">
      <input type="submit" name="submit" id="submit" class="btn btn-outline-danger form-control" value="Delete Record" />
     </div>
    </form>
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
<script>
$(document).ready(function(){
 $('#submit').click(function(){
  var count = 0;
  $('.checkbox_table').each(function(){
   if($(this).is(':checked'))
   {
    count = count + 1;
   }
  });
  if(count > 0)
  {
   $('#export_form').submit();
  }
  else
  {
   alert("Please Select Atleast one table for Export");
   return false;
  }
 });
});
</script>
<?php 
}
else{
  header('location: login1.php');
 } ?>