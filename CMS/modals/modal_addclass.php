<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
      <div class="container">
        <div class="row">
    <div class="col-sm-6">
     <label>Class name</label>
     <input type="text" name="class_name" id="class_name" class="form-control" />
   </div>
   <div class="col-sm-6">
     <label>Code name</label>
     <input type="text" name="code_name" id="code_name" class="form-control" />
   </div>
     
     <div class="col-sm-6">
     <label>Class Teacher</label>
     
     <select name="c_teacher" id="c_teacher" class="form-control">
      <option value="" selected="">--Select Class Teacher--</option>
      <?php 
     $sql=mysqli_query($conn,"SELECT * FROM teacher");
     while ($row=mysqli_fetch_array($sql)) {
    
      ?>

      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]." ".$row[2];  ?></option>  
      <?php } ?>
     </select>
     </div>

     <div class="col-sm-6">
       <label>Class Fee</label>
     <input type="number" name="class_fee" id="class_fee" class="form-control" />
     </div>
     <div class="col-sm-6">
       <label>Class Status</label>
     <select name="class_status" id="class_status" class="form-control">
       <option selected="" value="">--Select Status--</option>
       <option>Monthly</option>
       <option>Semester</option>
     </select>
     </div>
     <div class="col-sm-6">
       <label>Running Status</label>
     <select name="running_status" id="running_status" class="form-control">
       <option selected="">Active</option>
       <option>Passout</option>
     </select>
     </div>
     <br />  
     <input type="hidden" name="employee_id" id="employee_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-outline-success form-control" style="margin-top: 25px" />
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
    <h4 class="modal-title">Class Details</h4>
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