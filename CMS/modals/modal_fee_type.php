<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Fee Type</h3>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
          <label>Fee Title</label>
          <input type="text" name="title" id="title" class="form-control" required="">
          </div>
          <div class="col-md-6">
          <label>Voucher Title</label>
          <input type="text" name="v_title" id="v_title" class="form-control" required="">
          </div>
          <div class="col-md-6">
            <label>Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label>Fine</label>
            <input type="number" name="fine" id="fine" class="form-control" required />
          </div>
      <div class="col-md-6">
            <label>Type of Fee</label>
            <select class="form-control" name="ft_kind" id="ft_kind">
              <option value="" selected="">--Select Status--</option>
              <option value="0">Particulars</option>
              <option value="1">Miscellaneous</option>
            </select>
          </div>
      <div class="col-sm-6">
     <label>Assign to Installment</label>
      <select name="install_id" id="install_id" class="form-control">
      <option value="" selected="">--Number of installment--</option>
      <?php 
     $sql=mysqli_query($conn,"SELECT * FROM installments");
     while ($row=mysqli_fetch_array($sql)) {
      ?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1];  ?></option>  
      <?php } ?>
     </select>
     </div>
         <div class="col-md-6">
            <label>Fee</label>
            <input type="number" name="def_fee" id="def_fee" class="form-control"/>
          </div>
          <div class="col-md-6">
            <label>Running Status</label>
            <select name="running_status" id="running_status" class="form-control">
              <option selected="" value="">--Running Status--</option>
              <option value="Active">Active</option>
              <option value="Deactive">Deactive</option>
            </select>
          </div>
        </div>
        <br>
        <input type="hidden" name="employee_id" id="employee_id" />
          <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-outline-success form-control" style="border-radius: 20px;" />
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