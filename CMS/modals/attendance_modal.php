<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Add Balance</h3>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
      <div class="container">
        <div class="row">
         
     
      <div class="col-md-12">
     <label>Select Student</label>
     
      <select class="form-control selectpicker"  data-live-search="true" id="stu_att_id" name="stu_att_id">
            <option value="" selected="" disabled="">--Select Student--</option>
             <?php 
$query = mysqli_query($conn,"SELECT * FROM students");
while ($row = mysqli_fetch_array($query)) {

            ?> 
            <option value="<?php echo $row['studentid']; ?>"><?php echo $row['stu_reg_no']."-".$row['stu_first_name']." S/o ".$row['stu_last_name']; ?></option>
       <?php } ?>
        </select>
     </div>

     <div class="col-md-12">
      <br>
       <label>Select Attendance Status</label>
    <select class="form-control" id="att_status" name="att_status">
            <option value="" selected="" disabled="">--Select Attendance Status--</option>
            <option value="0">Normal</option>
            <option value="1">Absent</option>
            <option value="2">Late</option>
            <option value="3">Leave</option>
            <option value="4">Early Leave</option>
            <option value="5">Late & Early Leave</option>  
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

