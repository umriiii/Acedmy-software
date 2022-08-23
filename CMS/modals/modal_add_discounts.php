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
     <label>Discount Head</label>
     <input type="text" name="disc_name" id="disc_name" class="form-control" />
   </div>
     
     <div class="col-sm-6">
     <label>Discount Percentage</label>
     <input type="number" name="disc_per" id="disc_per" class="form-control" />
     </div>

     <div class="col-sm-6">
       <label>Description</label>
     <input type="text" name="disc_desc" id="disc_desc" class="form-control" />
     </div>
     <div class="col-sm-6">
       <label>Discount Status</label>
     <select name="disc_status" id="disc_status" class="form-control">
       <option selected="" value="1">Active</option>
       <option value="0">Disable</option>
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