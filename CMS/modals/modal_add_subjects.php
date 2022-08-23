<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <label>Subject name</label>
     <input type="text" name="sub_name" id="sub_name" class="form-control" />
     <br />
     <label>Select subject teacher</label>
     <select name="sub_tec" id="sub_tec" class="form-control">
      <option value="" selected="">--Select Teacher--</option>
      <?php 
      $sql=mysqli_query($conn,"SELECT * FROM teacher");
      while ($row=mysqli_fetch_array($sql)) {
       ?>
      <option value="<?php echo $row[0] ?>"><?php echo $row[1]." ".$row[2]; ?></option>  
     <?php } ?>
     </select>
     <br>
     <label>Subject class</label>
     <select name="sub_class" id="sub_class" class="form-control">
      <option selected="" value="">--Select Class--</option>
      <?php 
      $sql=mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
      while ($row=mysqli_fetch_array($sql)) {
       ?>
      <option value="<?php echo $row[0] ?>"><?php echo $row[1]; ?></option>  
     <?php } ?>
     </select>
     <br>
     <input type="hidden" name="employee_id" id="employee_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-outline-success form-control" style="border-radius: 20px;" />

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
    <h4 class="modal-title">Teacher Details</h4>
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