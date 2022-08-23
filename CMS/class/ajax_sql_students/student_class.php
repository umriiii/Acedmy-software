<?php 
  include '../config/db.php'; 
 ?>
 <br>

<br>    
<div class="container"> 
<div class="row">
<div class="col-sm-12">
   
  <div class="card">
    <h6 class="card-header primary-color st_head"><i class="fa fa-bars"></i>
      &nbsp;Class List&emsp;
      <a href="student_info.php" id="bac_button"  style="text-decoration: none;color: white"><i class="fa fa-hand-o-left"></i> Back</a>&emsp;
      <a href="" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"><span class="add"><i class="fa fa-plus"></i>&nbsp; Add Student </span></a>

    </h6>
      <!-- Modal-->
  
      
                  <div class="card-body">
      <div class="count" style="height: 100px;font-size: 25px">
        <?php 
$sql=mysqli_query($connect,"SELECT * FROM class where classid='$_POST[class_id]'");
$row=mysqli_fetch_array($sql);
         ?>
         <h1><?php echo $row[1]; ?></h1>
<?php 
$query = "SELECT * FROM students WHERE class_id='$_POST[class_id]' ORDER BY studentid DESC";
$result = mysqli_query($connect,$query);
$cou=mysqli_num_rows($result);
         ?>
     <?php echo $cou; ?> Students
       </div>
       <br>
       <div class="col-md-4 offset-md-8">
           <div class="input-group" id="adv-search">
                <input type="text" class="form-control" id="search" placeholder="Enter Keyword To search Data" style="border:1px solid black;border-top-left-radius: 15px" />
                <button type="button" class="btn btn-primary"><span class="fa fa-search" aria-hidden="true" style="height: 20px"></span></button>
             </div>
       </div>
    </div>
 <div class="container">    
   <div class="table-responsive">
    <div id="employee_table">
       <div id="display">
            
        </div>
        <div id="after_search">
          <div class="not">
     <table class="table table-bordered">
      <tr>
        <th width="10%">#S.No</th> 
        <th width="30%">image</th> 
       <th width="30%">Student name</th>    
       <th width="30%">Father name</th>    
       <th width="30%">Address</th>
       <th width="20%">Phone Number</th>
       <th width="30%">roll num</th>
       <th width="30%" colspan="4">Action</th>
      </tr>
      <?php
     $i=0;
      while($row = mysqli_fetch_array($result))
      {
        $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><img src="class/ajax_sql_students/students_upload/<?php echo $row['image']; ?>" height="50" width="100" class="img-thumbnail" /></td>
       <td ><?php echo $row['stu_first_name']; ?></td>
       <td><?php echo $row["stu_last_name"]; ?></td>
       <td><?php echo $row["address"]; ?></td>
       <td><?php echo $row["phone"]; ?></td>
       <td><?php echo $row["stu_reg_no"]; ?></td>
       <td><input type="button" name="view" value="view" id="<?php echo $row["studentid"]; ?>" class="btn btn-info btn-sm view_data" /></td>
       <td><button type="button" name="delete_btn" id="<?php echo $row["studentid"]; ?>" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i></button></td> 
       <td><input type="button" name="edit" value="Edit" id="<?php echo $row["studentid"]; ?>" class="btn btn-info btn-sm edit_data" /></td>
      
       
     
       <!--  <td>
                <form  method="post">
                    <input type="hidden" style="border-radius: 0px;" name="text" class="form-control" autocomplete="off"  value="<?php echo $row[3]; ?>">
                    <button type="submit"  id="gen_card" class="btn btn-block btn-md btn-outline-success gen_id_card">Generate</button>
                </form>
        </td> -->
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
  </div>        <br /><br />








  <script type="text/javascript">
    
 
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
 
   $("#search").keyup(function() {
 
       //Assigning search box value to javascript variable named as "name".
 
       var name = $('#search').val();
       var class_id = $('#search_class_id').val();

       //Validating, if "name" is empty.
 
       if (name == "") {
 
           //Assigning empty value to "display" div in "search.php" file.
 
           $("#display").html("");
           $('.not').show();
 
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "class/ajax_sql_students/search_ajax.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
              
 
               },
 
               //If result found, this funtion will be called.
 
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
              $("#display").html(html).show(); 
              $('.not').hide();     
 
               }
 
           });
 
       }
 
   });
 

  </script>