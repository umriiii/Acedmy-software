<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">
    <h4>Add Teacher</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form" enctype="multipart/form-data">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">

     <label>First name</label>
     <input type="text" required data-parsley-pattern="/^[a-zA-Z ]*$/" data-parsley-trigger="keyup" name="f_name" id="f_name" class="form-control" />
   </div>
      <div class="col-sm-6">
     <label>Last name</label>
     <input type="text" name="l_name" id="l_name" required data-parsley-pattern="/^[a-zA-Z ]*$/" data-parsley-trigger="keyup" class="form-control" />
   </div>
     <br />
      <div class="col-sm-6">
     <label>Birthday</label>
     <input type="date" name="birthday" id="birthday" class="form-control" />
   </div>
      <div class="col-sm-6">
     <label>Select Gender</label>
     <select name="gender" data-parsley-required="true" id="gender" class="form-control">
      <option value="Male">Male</option>  
      <option value="Female">Female</option>
     </select>
   </div>
     <br />
      <div class="col-sm-6">
     <label>Select Religion</label>
     <select name="religion" id="religion" data-parsley-required="true" class="form-control">
      <option value="Islam">Islam</option>  
      <option value="Christianity">Christianity</option>
      <option value="Hinduism">Hinduism</option>
      <option value="Buddhism ">Buddhism </option>
     </select>
   </div>
     <div class="col-sm-6">
     <label>Blood Group</label>
     <select name="blood" id="blood" data-parsley-required="true" class="form-control">
      <option selected="">--Select Blood Group--</option>
      <option value="O+">O+</option>  
      <option value="O-">O-</option>
      <option value="A+">A+</option>
      <option value="A- ">A- </option>
      <option value="B- ">B- </option>
      <option value="B+ ">B+ </option>
      <option value="AB- ">AB- </option>
      <option value="AB+ ">AB+ </option>
     </select>
   </div>
     <br />
      <div class="col-sm-12">
     <label>Enter Address</label>
     <textarea name="address" id="address" data-parsley-required="true" class="form-control"></textarea>
   </div>
     <br />
      <div class="col-sm-6">
     <label>Phone number</label>
     <input type="number" name="phone" id="phone" data-parsley-required="true"  data-parsley-type="number" data-parsley-length="[12, 12]" data-parsley-trigger="keyup" class="form-control" />
   </div>
    <!-- <div class="col-sm-6">
      <label>Email</label>
     <input type="email" name="email" id="email" data-parsley-trigger="keyup" class="form-control" />
   </div>
     <br />
     <div class="col-sm-12">
      <label>Qualification</label>
     <input type="text" name="t_qtion" id="t_qtion" class="form-control" />
   </div>
   <div class="col-sm-6">
      <label>Communication Skills</label>
     <input type="number" name="c_skill" id="c_skill" class="form-control" />
   </div>
     
     <div class="col-sm-6">
      <label>Teaching Method</label>
     <input type="number" name="t_method" id="t_method" class="form-control" />
   </div>
   <br>
   <div class="col-sm-6">
      <label>Experience</label>
     <input type="number" name="t_exp" id="t_exp" class="form-control" />
   </div>
   <div class="col-sm-6">
      <label>Achivements</label>
     <input type="number" name="t_achiv" id="t_achiv" class="form-control" />
   </div>
     <br />
      <div class="col-sm-12">
     <label>Teacher Discription</label>
     <textarea name="t_disc" id="t_disc" class="form-control"></textarea>
   </div> -->
     <br />
     <div class="col-sm-6">
       <label >Select Pictur : </label>
       <label for=""><input type="file" name="pic" id="pic" class="btn btn-primary"></label>
     </div>
      
     <br>
     <input type="hidden" name="employee_id" id="employee_id" />
      <div class="col-sm-12">
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-outline-success form-control" style="margin-top: 20px" />
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