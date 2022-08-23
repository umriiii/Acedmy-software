<?php
include 'classes/connection.php';
$connection = new PDO("mysql:host=$host; dbname=$database", $username, $password);
include 'include/top_web.php';
if(isset($_SESSION['gm_manager']) || isset($_SESSION['principal']) || isset($_SESSION['fc_manager'])){
?>
<title>Assign Fee</title>
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
<br>    
<div class="container "> 
<div class="row">
<div class="col-md-12">
  <div class="card">
    <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i>
      &nbsp;Class List&emsp;<a href="" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"><span class="add" id="add"><i class="fa fa-plus"></i>&nbsp; Assign Fee </span></a></h6>
      <div class="col-md-12">
        <!-- <div id="response"></div> -->

 <div class="container">  
   <div class="table-responsive">
    <br />
    <div id="employee_table">
      <div id="display"></div>
      <div class="no">
     <table id="user_data" class="table table-bordered table-hover table-striped">
      <thead>
      <tr>
       <th>#S.No</th> 
       <th>Fee Type</th>    
       <th>View</th>
      </tr>
      </thead>
     </table>
   </div>
    </div>
   </div>  
  </div>
</div>
</div>
</div>
        <br /><br />  
 <?php 
include 'include/fotter.php';
  ?>
  </body>
</html>

<!-- Add data modal start -->

<?php 
 
include 'modals/modal_assign_fee.php';
function fill_product_list($connection)
{
  $query = "
  SELECT * FROM class where running_status = 'Active'";
  $statement = $connection->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $output = '';
  $place = "Select class";
  $output .= '<option value="" selected="">'.$place.'</option>';
  foreach($result as $row)
  {
    $output .= '<option value="'.$row["classid"].'">'.$row["class_name"].'</option>';
  }
  return $output;
}
 ?>
<!-- Add data modal end -->

<!-- update data modal start -->


<?php
}
else{
   header("location:login1.php");
 } 
 ?>

<script type="text/javascript">
    $(document).ready(function(){

  
    $('#add').click(function(){
    
      $('#add_data_Modal').modal('show');
      $('#insert_form')[0].reset();
      $('#span_product_details').html('');
        $('#btn_action').val('Add');
       add_product_row();
    });


 var dataTable = jQuery('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"req/assign_fee/fetch.php",
   type:"POST"
  }
 
 
 });

  $('#insert_form').on("submit", function(event){  
           event.preventDefault();   
                $.ajax({  
                     url:"class/ajax_assign_fee/insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){
                     alert(data);  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');
                          dataTable.ajax.reload();  
                         

                     }  
                });  
      });

      });

    function add_product_row(count = '')
    {
      var html = '';
      html += '<span id="row'+count+'"><div class="row">';
      html += '<div class="col-md-10">';
      html += '<select name="class_id[]" id="class_id'+count+'" class="form-control" required>';
      html += '<?php echo fill_product_list($connection); ?>';
      html += '</select><input type="hidden" name="hidden_product_id[]" id="hidden_product_id'+count+'" />';
      html += '</div>';
   
      html += '<div class="col-md-2">';
      if(count == '')
      {
        html += '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
      }
      else
      {
        html += '<button type="button" name="remove" id="'+count+'" class="btn btn-danger btn-xs remove">-</button>';
      }
      html += '</div>';
      html += '</div></span>';
      $('#span_product_details').append(html);
    }
     var count = 0;

    $(document).on('click', '#add_more', function(){
      count = count + 1;
      add_product_row(count);
    });
    $(document).on('click', '.remove', function(){
      var row_no = $(this).attr("id");
      $('#row'+row_no).remove();
    });

  
          $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"class/ajax_assign_fee/select.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      }); 

      
        $(document).on('click', '.edit_data', function(){
      var feeid = $(this).attr("id");
      var btn_action = 'fetch_single';
      $.ajax({
        url:"class/ajax_assign_fee/insert.php",
        method:"POST",
        data:{feeid:feeid, btn_action:btn_action},
        dataType:"json",
        success:function(data)
        {
                $('#add_data_Modal').modal('show'); 
               $('#ft_id').val(data.ft_id);   
               $('#employee_id').val(data.feeid);
          $('#span_product_details').html(data.product_details);
          $('#action').val('Edit');
          $('#btn_action').val('Edit');
        }
      })
    }); 




</script>