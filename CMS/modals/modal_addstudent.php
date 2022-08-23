<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Add Student</h3>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
      <div class="container">
      <div class="row">
        <div class="col-sm-6">
     <label>Student name</label>
     <input type="text" name="stu_name" id="stu_name" required="" data-parsley-pattern="/^[a-zA-Z ]*$/"  data-parsley-trigger="keyup" class="form-control" />
     </div>
     <div class="col-sm-6">
     <label>Father name</label>
     <input type="text" name="fat_name" id="fat_name" required="" data-parsley-pattern="/^[a-zA-Z ]*$/"  data-parsley-trigger="keyup"  class="form-control" />
     </div>
     <br>
     <!-- <div class="col-sm-6">
      <label>Mother name</label>
     <input type="text" name="mot_name" id="mot_name" class="form-control" />
     </div> -->
     <div class="col-sm-6">
     <label>Birthday</label>
     <input type="date" name="birthday" id="birthday" class="form-control" />
     </div>
     <br />
     <div class="col-sm-6">
     <label>Select Gender</label>
     <select name="gender" id="gender" class="form-control">
      <option value="Male">Male</option>  
      <option value="Female">Female</option>
     </select>
   </div>
     <div class="col-sm-6">
     <label>Select Religion</label>
     <select name="religion" id="religion" data-parsley-required="true" class="form-control">
      <option value="Islam">Islam</option>  
      <option value="Christianity">Christianity</option>
      <option value="Hinduism">Hinduism</option>
      <option value="Buddhism ">Buddhism </option>
     </select>
   </div>
     <br />
     <div class="col-sm-6">
     <label>Blood Group</label>
     <select name="blood" id="blood" data-parsley-required="true" class="form-control">
      <option selected="">--Select Blood Group--</option>
      <option value="O+">O+</option>  
      <option value="O-">O-</option>
      <option value="A+">A+</option>
      <option value="A- ">A- </option>
      <option value="B- ">B- </option>
      <option value="B+ ">B+ </option>
      <option value="AB- ">AB- </option>
      <option value="AB+ ">AB+ </option>
     </select>
   </div>
    <div class="col-sm-6">
     <label>Phone number</label>
     <input type="number" name="phone" id="phone" data-parsley-required="true" data-parsley-type="number" data-parsley-length="[12, 12]" data-parsley-trigger="keyup" class="form-control" />
     </div>
   <br>
     <div class="col-sm-12">
     <label>Enter Address</label>
     <textarea name="address" id="address" class="form-control"></textarea>
   </div>
     <br />
    
     <div class="col-sm-6">
      <label>class</label>
     <select name="add_stu_class" id="add_stu_class" class="form-control" data-parsley-required="true" onchange="stu_fee();" >
       <option value="" selected="">--Select class--</option>
       <?php 
       $sql=mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
       while ($row=mysqli_fetch_array($sql)) {
        ?>
       <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
     <?php } ?>
     </select>
   </div>
    <div class="col-sm-6">
     <label>Number of Installment</label>
      <select name="stu_class_fee" id="stu_class_fee" class="form-control">
      <option value="" selected="">--Number of installment--</option>
      <?php 
     $sql=mysqli_query($conn,"SELECT * FROM installments");
     while ($row=mysqli_fetch_array($sql)) {
      ?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1];  ?></option>  
      <?php } ?>
     </select>
     </div>
     <div class="col-sm-6">
     <label>Particular Discount Type</label>
     <select name="dis_cat" id="dis_cat" class="form-control">
      <option value="" selected="">--Select Discount Type--</option>
      <?php 
     $sql=mysqli_query($conn,"SELECT * FROM discounts");
     while ($row=mysqli_fetch_array($sql)) {
      ?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1];  ?></option>  
      <?php } ?>
     </select>
   </div>
   <div class="col-sm-6">
     <label>Miscellaneous Discount Type</label>
     <select name="misc_disc_cat" id="misc_disc_cat" class="form-control">
      <option value="" selected="">--Select Discount Type--</option>
      <?php 
     $sql=mysqli_query($conn,"SELECT * FROM misc_discounts");
     while ($row=mysqli_fetch_array($sql)) {
      ?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1];  ?></option>  
      <?php } ?>
     </select>
   </div>
     <br />
     <div class="col-sm-6">
     <label>Roll No</label>
     <input type="text" name="stu_reg" data-parsley-required="true" id="stu_reg" class="form-control" />
     </div>
     <div class="col-sm-6">
     <label>Addmission Date</label>
     <input type="date" name="create_on" data-parsley-required="true" id="create_on" class="form-control" />
   </div>
     <br />
     <div class="col-sm-6">
       <label >Select Pictur : </label>
       <label for=""><input type="file" name="pic" id="pic" class="btn btn-primary"></label>
     </div>
      
     <br>
     <br>
     <input type="hidden" name="employee_id" id="employee_id" />
     <div class="col-sm-12">
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-outline-success form-control" style="margin-top: 25px" />
   </div>
    </div>
    </div>
    </form>
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<div id="dataModal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Student Details</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body" id="employee_detail">
    
   </div>
   <div class="modal-footer">
  
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>





