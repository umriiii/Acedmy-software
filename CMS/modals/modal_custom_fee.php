<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
      <div class="container">
        <div id="result"></div>
        <div class="row">
          <div class="col-sm-6">
  <label>Memo</label>
  <input type="text" name="memo" id="memo" class="form-control">
</div>
<div class="col-sm-6">
 <label>Select Classes For This Fee</label>
     <select id="custom_class" name="custom_class[]" multiple class="form-control" >
    <?php 
 $query = mysqli_query($conn,"SELECT * FROM class WHERE running_status = 'Active'");
 while ($row = mysqli_fetch_array($query)) {
   ?>
   <option value="<?php echo $row['classid'] ?>"><?php echo $row['class_name']; ?></option>
   <?php 
 }
     ?>
     </select>
</div>
<div class="col-sm-6">
  <label>Declare Fee</label>
  <input type="number" name="custom_fee" id="custom_fee" class="form-control">
</div>
<div class="col-sm-6">
  <label>Status</label>
  <select name="status" id="status" class="form-control">
    <option value="" selected="">--Select Status--</option>
    <option value="Active">Active</option>
    <option value="Deactivate">Deactivate</option>
  </select>
</div>
     <div class="col-sm-6">
     <label>Due Date</label>
     <input type="date" name="due_date" id="due_date" class="form-control" autofocus=""  />
     </div>
     <input type="hidden" name="employee_id" id="employee_id" />
     <div class="col-sm-12" style="margin-top: 20px">
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-outline-success form-control" style="border-radius: 20px" />
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
    <h4 class="modal-title">Custom Fee</h4>
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
