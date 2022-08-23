<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
    <h3>Add Student Fee</h3>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">

    <form method="post" id="insert_form">
    <div id="sho"></div>
      
      <div class="container">
      <div class="row">        
        <div class="col-sm-6">
          <div class="before">
     <label>Student name</label>
     <input type="text" name="stu_name" id="stu_name" class="form-control" readonly="" />
   </div>
     </div>
     <div class="col-sm-6">
      <div class="before">
     <label>Father name</label>
     <input type="text" name="fat_name" id="fat_name" class="form-control" readonly="" />
     </div>
     </div>
     <br>
     <div class="col-sm-6">
       <div class="before">
     <label>Phone number</label>
     <input type="number" name="phone" id="phone" class="form-control" readonly="" />
       </div>
     </div>
     <div class="col-sm-6">
      <div class="before">
      <label>class</label>
     <input type="text"  name="stu_class" id="stu_class" class="form-control" readonly="">
     </div>
   </div>
   
     <div class="col-sm-6">
      
     <label>Current Amount in Hand</label>
     <input type="number" name="stu_fee" id="stu_fee" class="form-control" />
 
   </div>
   <div class="col-sm-6">
      
     <label>Fee Status</label>
     <select class="form-control" name="fee_status" id="fee_status">
       <option>Monthly Fee Paid</option>
       <option>Semester Fee Paid</option>
       <option>Fee Refund</option>
     </select>
 
   </div>
     <div class="col-sm-6">
      <div class="before">
     <label>Addmission Date</label>
     <input type="date" name="create_on" id="create_on" class="form-control" readonly="" />
   </div>
   </div>
 
  <div class="col-sm-12">
     <label>Roll No</label>
     
  <input id="sub" type="text" name="ajax_fee" onkeyup="submitT(this,this.form)" autofocus="" class="form-control">

     </div>
     <br>
     <input type="hidden" name="employee_id" id="employee_id" />
     <div class="col-sm-12">
     <input type="submit" name="insert" id="insert" onclick="myFunction()" value="Insert" class="btn btn-outline-success form-control" style="margin-top: 25px" />
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
   <div class="modal-header no-print">
    <h4 class="modal-title">Fee Details</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
  
   <div class="modal-body" id="employee_detail">

    
   </div>

   <div class="modal-footer">
    <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
  
   </div>
  </div>
 </div>
</div>





