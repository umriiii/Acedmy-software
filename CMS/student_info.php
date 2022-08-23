<?php
include 'include/top_web.php';
if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
 ?>
 <title>Students</title>
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
<div class="no">
<div class="container "> 
<div class="row">
<div class="col-sm-6 st_pnl">
  <div class="card">
    <h3 class="card-header primary-color st_head">Select Class</h3>
    <div class="card-body st_bd">
  
        <select class="form-control col-sm-10" id="stu_class" onchange="clas(this.value)">
            <option disabled="" selected="">--Select Class--</option>
            <?php 
            $sql=mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
            while ($row=mysqli_fetch_array($sql)) {
             ?>
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
             <?php } ?>
        </select>
   
        
    </div>
</div>
 </div> 
</div>
</div> 
</div>

          <div id="stu_class_data"></div> 
      

<!-- content end -->
<script type="text/javascript">
    function clas(src)
    {
     var stu_class=$('#stu_class').val();
     // alert(sel_class);
     $.ajax({
        url: 'class/ajax_sql_students/student_class.php',
        method: 'POST',
        data: {
          "class_id": stu_class
          
        },
        success:function(data){
           $('.no').hide();
        $('#stu_class_data').html(data);
        }
     });
    }

</script>  
   
<?php 
include 'include/fotter.php';
 ?>
   
  </body>
</html>

<!-- Add data modal start -->

<?php 
include 'modals/modal_addstudent.php';
 ?>
<!-- Add data modal end -->

 <script type="text/javascript">  
 $(document).ready(function(){ 

        $('#insert_form').parsley(); 
 });  
 </script>
<!-- student fee with respect to class -->
//  <script type="text/javascript">
//   $("#add_stu_class").on('change',function stu_fee(){
     
//      // alert(sel_class);
//      $.ajax({
//         url: 'class/ajax_sql_students/stu_fee_acc_to_class.php',
//         method: 'POST',
//         data: {
//           stu_class_id: $('#add_stu_class').val(),
//         },
//         success:function(data){
//         $('#show_fee').html(data);
//         $('.hide_fee').hide(); 
//         }
//      });
//   })
//  </script>



<!-- print modal start -->
<script type="text/javascript">
 function printContent(el){
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(el).innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
}

</script>
<!-- print modal End -->
<script type="text/javascript" >
  
 $(document).ready(function(){
 // $('#insert_form').parsley();
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"class/ajax_sql_students/fetch.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){
                
                     $('#stu_name').val(data.stu_first_name);  
                     $('#fat_name').val(data.stu_last_name);
                     $('#stu_reg').val(data.stu_reg_no);
                     $('#birthday').val(data.birthday);  
                     $('#gender').val(data.sex); 
                     $('#religion').val(data.religion);
                     $('#blood').val(data.blood_group);  
                     $('#address').val(data.address);  
                     $('#phone').val(data.phone);  
                     $('#add_stu_class').val(data.class_id);  
                     // $('#mot_name').val(data.mother_name);  
                     $('#create_on').val(data.create_on);  
                     $('#stu_class_fee').val(data.student_fee);  
                     $('#dis_cat').val(data.discount_category);  
                     $('#misc_disc_cat').val(data.misc_disc_cat);  
                     $('#employee_id').val(data.studentid);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){ 


    var stu_class=$('#stu_class').val();
           event.preventDefault();  
           if($('#stu_name').val() == "")  
  {  
   alert("Student name is required");  
  }  
  else if($('#fat_name').val() == '')  
  {  
   alert("Father name is required");  
  }  
  else if($('#gender').val() == '')
  {  
   alert("Gender is required");  
  }
  else if($('#religion').val() == '')
  {  
   alert("religion is required");  
  }
   else if($('#address').val() == '')
  {  
   alert("Address is required");  
  }
   else if($('#phone').val() == '')
  {  
   alert("Phone number is required");  
  }
   else if($('#add_stu_class').val() == '')
  {  
   alert("Add a Class ");  
  }
     else if($('#stu_class_fee').val() == '')
  {  
   alert("Add Discount");  
  }
   else if($('#dis_cat').val() == '')
  {  
   alert("Add Discount Category");  
  }
     else if($('#stu_reg').val() == '')
  {  
   alert("Roll number is required");  
  }
    else if($('#create_on').val() == '')
  {  
   alert("Addmission Date is required");  
  }
    else if($('#stu_reg').val() == '')
  {  
   alert("Roll number is required");  
  }
           else  
           { 
  // zaid bhai send this class_id on my request but there is no need of this 
               
                $.ajax({  
                     url:"class/ajax_sql_students/insert.php",  
                     method:"POST",  
                     data:  new FormData(this),
                      contentType: false,
                      cache: false,
                      processData:false,  
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
                     url:"class/ajax_sql_students/select.php",  
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
                     url:"class/ajax_sql_students/delete.php",  
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
 <?php  
}
else{
header('location: login1.php');
 } ?>




 <!-- search -->

