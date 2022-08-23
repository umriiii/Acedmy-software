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
  <label>BISE Registration Fee</label>
  <input type="number" name="bise_reg_fee" id="bise_reg_fee" class="form-control">
</div>
<div class="col-sm-6">
  <label>BISE Exam Fee</label>
  <input type="number" name="bise_exam_fee" id="bise_exam_fee" class="form-control">
</div>
<div class="col-sm-6">
  <label>Paper Fund</label>
  <input type="number" name="paper_fund" id="paper_fund" class="form-control">
</div>
<div class="col-sm-6">
  <label>Party Fund</label>
  <input type="number" name="party_fund" id="party_fund" class="form-control">
</div>
<div class="col-sm-6">
  <label>Miscellaneous</label>
  <input type="number" name="misc_fee" id="misc_fee" class="form-control">
</div>
<div class="col-sm-6">
  <label>Fine</label>
  <input type="number" name="fine" id="fine" class="form-control">
</div>
     <div class="col-sm-12">
     <label>Roll No</label>
     <input type="number" name="roll_num" id="roll_num" class="form-control" onkeyup="submitT(this,this.form)" autofocus=""  />
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