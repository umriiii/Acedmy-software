<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
      <div class="container">
      <div class="row">
         <div class="col-sm-6">
     <label>Date</label>
     <input type="date" name="notice_date" id="notice_date" class="form-control" />
     </div>
      <div class="col-sm-6">  
     <label>Title</label>
     <input type="text" name="notice_title" id="notice_title" class="form-control" />
     </div>
    
     <div class="col-sm-12">
     <label>Notice</label>
     <textarea name="notice" id="notice" class="col-sm-12"></textarea>
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
    <h4 class="modal-title">Exam Details</h4>
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