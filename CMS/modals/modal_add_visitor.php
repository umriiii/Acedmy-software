<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Visitor Form</h3>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <div class="container">
  <div class="row">


  <div class="col-sm-6">
   <div class="form-group">
    <label>Student Name</label>
    <input type="test" name="std_name" id="std_name" class="form-control">
   </div>
   </div>


   <div class="col-sm-6">
   <div class="form-group">
    <label>Father Name</label>
    <input type="test" name="sf_name" id="sf_name" class="form-control">
   </div>
   </div>

   <div class="col-sm-6">
   <div class="form-group">
    <label>Father Occupation</label>
    <input type="test" name="ftocu_name" id="ftocu_name" class="form-control">
   </div>
   </div>


   <div class="col-sm-6">
   <div class="form-group">
    <label>Privoius Institute</label>
    <input type="test" name="p_ins_name" id="p_ins_name" class="form-control">
   </div>
   </div>


   <div class="col-sm-6">
    <div class="form-group">
      
      <label>Class</label>
      <select class="form-control" name="std_class" id="std_class">
        <option>--Select Your Class--</option>
        <?php
        $sql = mysqli_query($conn,"SELECT * FROM class WHERE running_status='Active'"); 
while ($row=mysqli_fetch_array($sql)) {
      ?>
      <option><?php echo $row['class_name']; ?></option>
      <?php 
}
         ?>
   
      </select>
    </div>
   </div>
   <div class="col-sm-6">
   <div class="form-group">
    <label>Contact Number</label>
    <input type="test" name="mob_num" id="mob_num" class="form-control">
   </div>
   </div>
   <div class="col-sm-12">
   <div class="form-group">
    <label>Address</label>
    <textarea class="form-control" name="stu_add" id="stu_add"></textarea>
   </div>
   </div>
 <div class="col-sm-6">
    <div class="form-group">
      <label>Addmission Status</label>
      <select class="form-control" name="status" id="status">
        <option>--Status--</option>
        <option>Confirmed</option>
        <option>Pending</option>
      </select>
    </div>
   </div>
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
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Visitors Details</h4>
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














   