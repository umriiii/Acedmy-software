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
  <label>System Name</label>
  <input type="text" name="system_name" id="system_name" class="form-control">
</div>
<div class="col-sm-6">
  <label>Phone</label>
  <input type="number" name="phone" id="phone" class="form-control">
</div>
<div class="col-sm-6 col-sm-offset-4">
  <label>Logo</label>
  <input type="file" name="pic" id="pic" class="btn btn-primary">
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

