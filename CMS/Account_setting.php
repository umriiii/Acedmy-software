<?php
include 'include/top_web.php';
if(!isset($_SESSION["principal"])){
   // && empty($_SESSION['username'])
 header("location:login1.php");
}
else{
?>
<title>Account Settings</title>
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
 <h1  style="text-align: center;">Verify a Admin’s identity with extra security</h1>
 <br>
<div class="container">
    <div class="row">
        
        <div class="col-sm-12">
          <br>
           <div id="result"></div>
            <div id="live_data"></div>
            
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
 <script>  
$(document).ready(function(){  
    function fetch_data()  
    {  
        $.ajax({  
            url:"class/Account_settings/select.php",  
            method:"POST",  
            success:function(data){  
        $('#live_data').html(data);  
            }  
        });  
    }  
    fetch_data();      
  function edit_data(id, text, column_name)  
    {  
        $.ajax({  
            url:"class/Account_settings/edit.php",  
            method:"POST",  
            data:{id:id, text:text, column_name:column_name},  
            dataType:"text",  
            success:function(data){  
                //alert(data);
        $('#result').html(data);
            }  
        });  
    }  
    $(document).on('blur', '.user_name', function(){  
        var id = $(this).data("id1");  
        var user_name = $(this).text();  
        edit_data(id, user_name, "user_name");  
    });  
    $(document).on('blur', '.user_pass', function(){  
        var id = $(this).data("id2");  
        var user_pass = $(this).text();  
        edit_data(id,user_pass, "user_pass");  
    });
  
});  
</script>


<?php } ?>
