<?php 
 include '../config/db.php';
$sql = mysqli_query($connect,"SELECT * FROM settings");
$row = mysqli_fetch_array($sql);
$password = $row['admin_login'];
if($_POST['name'] == $password)
{
 ?>
 <br>
 <input type="submit" name="check_absent" id="check_absent" disabled="" class="btn btn-info" value="Mark Attandance Manually" onclick="Manual_attandance();">

 <?php 
 }else
 {
 	echo "<br><div class='text-danger'>Fail To Login</div>";
 }
?>
 <script type="text/javascript">
               $(document).ready(function() {
                         

    var offSeconds = 0;
    var onSeconds = 5;
    $("#check_absent").attr("disabled", false);
    $("#check_absent").click(function(){
      setTimeout(function(){
        $("input[type='submit']").attr("disabled", true).val("Please wait...").removeClass('btn-outline-info').addClass('btn-danger');
      
    }, offSeconds*1000);
      setTimeout(function(){
        $("input[type='submit']").attr("disabled", false).val("Mark Attandance Manually").removeClass('btn-danger').addClass('btn-outline-info');
      
    }, onSeconds*1000);
      
    });
})
 </script>