<?php
include 'include/top_web.php';


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
 <h1  style="text-align: center;">Set Sms Here</h1>
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
            url:"class/Sms_settings/select.php",  
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
            url:"class/Sms_settings/edit.php",  
            method:"POST",  
            data:{id:id, text:text, column_name:column_name},  
            dataType:"text",  
            success:function(data){  
                //alert(data);
        $('#result').html(data);
            }  
        });  
    }  
    $(document).on('blur', '.absent_sms', function(){  
        var id = $(this).data("id1");  
        var absent_sms = $(this).text();  
        edit_data(id, absent_sms, "absent_sms");  
    });  
    $(document).on('blur', '.leave_sms', function(){  
        var id = $(this).data("id2");  
        var leave_sms = $(this).text();  
        edit_data(id,leave_sms, "leave_sms");  
    });
     $(document).on('blur', '.late_sms', function(){  
        var id = $(this).data("id3");  
        var defaulter_sms = $(this).text();  
        edit_data(id,defaulter_sms, "late_sms");  
    });
      $(document).on('blur', '.normal_sms', function(){  
        var id = $(this).data("id4");  
        var visitor_sms = $(this).text();  
        edit_data(id,visitor_sms, "normal_sms");  
    });
    $(document).on('blur', '.early_sms', function(){  
        var id = $(this).data("id5");  
        var early_sms = $(this).text();  
        edit_data(id,early_sms, "early_sms");  
    });
    $(document).on('blur', '.late_n_early_sms', function(){  
        var id = $(this).data("id6");  
        var late_n_early_sms = $(this).text();  
        edit_data(id,late_n_early_sms, "late_n_early_sms");  
    });    
});  
</script>
  <?php 
 ?>
