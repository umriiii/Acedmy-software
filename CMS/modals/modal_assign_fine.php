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
     <label>Select Fine Type</label>
     
     <select name="fine_id" id="fine_id" class="form-control selectpicker"  data-live-search="true">
      <option value="" selected="">--Select Fine Type--</option>
      <?php 
     $sql=mysqli_query($conn,"SELECT * FROM fines");
     while ($row=mysqli_fetch_array($sql)) {
    
      ?>

      <option value="<?php echo $row[0]; ?>"><?php echo $row[1];  ?></option>  
      <?php } ?>
     </select>
     </div>
     <div class="col-sm-6">
     <label>Select Student</label>
     
     <select name="assign_stu_id" id="assign_stu_id" class="form-control selectpicker"  data-live-search="true">
      <option value="" selected="">--Select Student--</option>
      <?php 
     $sql=mysqli_query($conn,"SELECT * FROM students");
     while ($row=mysqli_fetch_array($sql)) {
    
      ?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]." ".$row[2];  ?></option>  
      <?php } ?>
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
    <h4 class="modal-title">Collect Fine</h4>
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