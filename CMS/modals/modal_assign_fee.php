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
          <div class="col-md-12">
            <label>Select Fee Type</label>
            <select class="form-control" id="ft_id" name="ft_id">
                <option value="" selected="">--Select Fee Type--</option>
              <?php 
$query = mysqli_query($conn,"SELECT * FROM fee_type");
while ($row = mysqli_fetch_array($query)) {
 ?>
   <option value="<?php echo $row['ftid']; ?>"><?php echo $row['title']; ?></option>
 <?php 
}
?>
            </select>
          </div>
        <div class="col-md-12">
              <label>Select Classes</label>
          </div>
        <!-- row end -->
    </div>
              <span id="span_product_details"></span>
     <input type="hidden" name="employee_id" id="employee_id" />
     <input type="hidden" name="btn_action" id="btn_action" />
     <div class="col-sm-12" style="margin-top: 20px">
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-outline-success form-control" style="border-radius: 20px" />
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
    <h4 class="modal-title">Fee Details</h4>
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
