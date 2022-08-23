<?php
include 'include/top_web.php';
if(isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
  ?>
  <style type="text/css">
     @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
<title>Student Fee</title>
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
<div class="col-sm-12">
  <div class="card ">
      <div class="no-print">
    <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i>
      &nbsp;Student Fee List&emsp;<a href="" onmouseup="bleep.play()" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"><span class="add"><i class="fa fa-plus"></i>&nbsp; Add Monthly Fee </span></a>
 <a href="previous_month_fees.php"><span class="add"> Previous Month Fees </span></a>
 <a href="fee_defaulters.php"><span class="add"> Monthly Fee Defaulters </span></a>
 <a href="Semester_fee_defaulters.php"><span class="add"> Semester Fee Defaulters </span></a>
    </h6>
    </div>
  </div>
      <div class="col-sm-12">
                  <!-- Modal-->
    </div>
    <br>
    <div class="col-md-4 offset-md-8">
           <div class="input-group no-print" id="adv-search">
                <input type="text" class="form-control" id="search" autofocus="" placeholder="Enter Keyword To search Data" style="border:1px solid black;border-top-left-radius: 15px" />
                <button type="button" class="btn btn-primary"><span class="fa fa-search" aria-hidden="true" style="height: 20px"></span></button>
             </div>
       </div>
 <div class="container">  
    
   <div class="table-responsive">
   <br>
    <div id="employee_table">
      <div id="display"></div>
      <div class="no-print">
      <div class="no">
     <table class="table table-bordered table-hover table-striped">  
        <tr>
             <th width="10%">#S.No</th> 
             <th width="30%">Student Name</th> 
             <th width="30%">Father Name</th> 
             <th width="30%">Roll No</th>   
             <th width="30%">Class</th> 
             <th width="30%">Total Fee</th> 
             <th width="30%">Fee Status</th>
             <th width="30%">submission Date</th>  
             <th width="30%" colspan="4">Action</th>
       </tr> 
      <?php
     $i=0;
         $select=mysqli_query($conn,"SELECT A.stu_first_name,A.stu_last_name,A.stu_reg_no,B.running_status,B.class_name,A.address,A.phone,A.create_on,C.submit_on,C.status,C.student_fee,C.feeid FROM students as A inner join class as B on A.class_id=B.classid inner join student_fee as C on A.studentid=C.student_id WHERE Month(C.submit_on) = Month(NOW()) AND B.running_status = 'Active' ORDER BY C.feeid DESC");
            while ($row1=mysqli_fetch_array($select)) {
             
           $i++; 
      ?>
                     <tr id="<?php echo $row1['feeid']; ?>">
        <td><?php echo $i; ?></td>
       <td  data-target="teachername"><?php echo $row1["stu_first_name"]; ?></td>
       <td  data-target="teachername"><?php echo $row1["stu_last_name"]; ?></td>
       <td  data-target="address"><?php echo $row1["stu_reg_no"]; ?></td>
       <td  data-target="phone"><?php echo $row1["class_name"]; ?></td>
       <td  data-target="phone"><?php echo $row1["student_fee"]; ?></td>
        <td  data-target="email"><?php echo $row1["status"]; ?></td>
       <td  data-target="email"><?php echo $row1["submit_on"]; ?></td>
 
      <td><input type="button" name="view" onmouseup="bleep.play()" value="view" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
      <td><a href="reports/fee_slip.php?feeid=<?php echo $row1["feeid"]; ?>" target="_blank"><input type="button" name="view" onmouseup="bleep.play()" value="Fee Slip" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm" /></a></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row1["feeid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row1["feeid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      </tr>
      <?php 
}

       ?>
     </table>
   </div>
 </div>
    </div>
   </div>  
  </div>     

<audio id="audio">
    <source src="audio/clicking.mp3" type="audio/mpeg" />
</audio>

<?php 
include 'modals/modal_addfee.php';
 ?>
    <!-- JavaScript files-->





    
<script src="vendor/jquery/jquery.min.js"></script>
 <script type="text/javascript" src="student_fee_script.js"></script>
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
  var bleep = new Audio();
  bleep.src = "audio/bleep.mp3";
</script>
<script type="text/javascript">
 

     function printContent() {
        var divToPrint=document.getElementById("employee_detail");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    

</script>
<script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"class/ajax_add_student_fee/fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#stu_name').val(data.stu_first_name);     
                     $('#fat_name').val(data.stu_last_name);
                     $('#phone').val(data.phone);
                     $('#stu_class').val(data.class_name);
                     $('#create_on').val(data.create_on);
                     $('#fee_status').val(data.status);    
                     $('#sub').val(data.stu_reg_no);
                     // $( "#sub" ).prop( "disabled", true );    
                     $('#employee_id').val(data.feeid);
                     $('#discount_category').val(data.discount_category);
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');
                     $('#sub').focus();


                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
          var valid_fee = $('#stu_fee').val();
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
  //  else if($('#stu_fee').val() == $('#due_fee').val())
  // {  
  //  alert(valid_fee);  
  // }
           else  
           {  
            
                $.ajax({  
                     url:"class/ajax_add_student_fee/insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#employee_table').html(data); 
                          $('#insert').val("Insert");
                    document.getElementById("stu_name").value = "";
                    document.getElementById("fat_name").value = "";
                    document.getElementById("phone").value = "";
                    document.getElementById("stu_class").value = "";
                    document.getElementById("employee_id").value = "";
                    document.getElementById("create_on").value = "";
                    document.getElementById("stu_fee").value = "";
                    alert(document.getElementById('Fee_Per_Sem').value);
                     }  
                });
              
              
               
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"class/ajax_add_student_fee/select.php",  
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
  var audio = document.getElementById('audio');
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
                     url:"class/ajax_add_student_fee/delete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){
                     audio.play(); 

                           $(el).closest('tr').css('background','#d31027');
                $(el).closest('tr').fadeOut(800, function(){      
                    $(this).remove();
                });  
                            
                     }  
                });  
           }  
      }); 
 </script>

<!-- student feee -->

<script language="JavaScript" type="text/JavaScript">

function submitT(t,f){
  if(t.value.length >= 4 || t.value.length <= 7){
    $.ajax({
      url: 'class/ajax_add_student_fee/show_fee_rec.php',
      type: 'post',
      data:{
        'name': t.value
      },
      success:function(data){
        $('.before').hide();
        $('#sho').html(data);

      }
    });
    
    /*f.submit();*/
  }
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
 
               url: "class/ajax_add_student_fee/search_ajax.php",
 
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