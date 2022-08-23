<?php 
include '../config/db.php';

if(isset($_POST['name'])){
	$stu_reg_num=$_POST['name'];
	$sql = mysqli_query($connect,
    "SELECT A.stu_reg_no,B.student_fee as stu_fee,B.feeid
     FROM students as A 
     inner join student_fee as B on 
     A.studentid = B.student_id  
     WHERE A.stu_reg_no='$stu_reg_num'
     Order By B.feeid DESC
     ");
  $row1 = mysqli_fetch_array($sql);
	$query=mysqli_query($connect,
    "SELECT 
    A.stu_first_name,
    A.stu_last_name,
    A.image,
    A.phone,
    A.create_on,
    A.student_fee,
    A.discount_category,
    B.class_fee,
    B.class_name,
    B.class_status
FROM students as A 
    inner join class as B on
     A.class_id = B.classid  
WHERE A.stu_reg_no='$stu_reg_num'
AND B.running_status = 'Active'
     ");
	while ($row=mysqli_fetch_array($query)) {
	?>
 <?php 
 // Code For Due Fee
          // $discount = 0;
          // $discount = $row['class_fee'] * $row['student_fee'];
          // $discount = $discount/100;
          $due_fee = 0;
          $due_fee = $row['class_fee'] - $row1['stu_fee'] - $row['student_fee'];
          $Calculation_For_Fee_Per = $row['class_fee'] - $row['student_fee'];
 // Code TO Calculate Fee Per Semester or Month
 $Fee_Per_Sem = ceil($Calculation_For_Fee_Per/3);
 $Fee_Per_Mon = ceil($Calculation_For_Fee_Per/12);
  ?>
	<div class="container">
  <div class="row">
     <div class="col-sm-6">
    
   <img src="class/ajax_sql_students/students_upload/<?php echo $row['image']; ?>" height="50" width="100" class="img-thumbnail"  style="margin-left: 90px;">
  </div>

  <div class="col-sm-6">
     <label>Student name</label>
     <input type="text" name="stu_name" id="stu_name" class="form-control" readonly="" value="<?php echo $row['stu_first_name']; ?>" />
  </div>
 <br>
  <div class="col-sm-6">
     <label>Father name</label>
     <input type="text" name="fat_name" id="fat_name" class="form-control" readonly="" value="<?php echo $row['stu_last_name']; ?>" />
  </div>
  <div class="col-sm-6">
    <label>Phone number</label>
     <input type="number" name="phone" id="phone" class="form-control" readonly="" value="<?php echo $row['phone']; ?>" />
     </div>
     <div class="col-sm-6">
      <label>class</label>
     <input type="text"  name="stu_class" id="stu_class" class="form-control" readonly="" value="<?php echo $row['class_name'];?>">
   </div>
   <div class="col-sm-6">
      <label>class Fee</label>
     <input type="number"  name="stu_class_fee" id="stu_class_fee" class="form-control" readonly="" value="<?php echo $row['class_fee'];?>">
   </div>
   <div class="col-sm-6">
      <label>Discount</label>
     <input type="number"  name="stu_dis_fee" id="stu_dis_fee" class="form-control" readonly="" value="<?php echo $row['student_fee'];?>">
   </div>
   <div class="col-sm-6">
      <label>Discount Category</label>
     <input type="text"  name="discount_category" id="discount_category" class="form-control" readonly="" value="<?php echo $row['discount_category']; ?>">
   </div>
   <div class="col-sm-6">
      <label>Student Fee</label>
     <input type="text"  name="Fee_After_Discount" id="Fee_After_Discount" class="form-control" readonly="" value="<?php echo $Calculation_For_Fee_Per; ?>">
   </div>
   <div class="col-sm-6">
      <label>Class Status</label>
     <input type="text"  name="class_status" id="class_status" class="form-control" readonly="" value="<?php echo $row['class_status']; ?>">
   </div>

<?php
$Class_Status = $row['class_status'];  
if($Class_Status == "Semester"){
?>
<div class="col-sm-6">
      <label>Fee Per Semester</label>
     <input type="text"  name="Fee_Per" id="Fee_Per" class="form-control" readonly="" value="<?php echo $Fee_Per_Sem; ?>">
   </div>
<?php
}
else if($Class_Status == "Monthly"){
 ?>
<div class="col-sm-6">
      <label>Fee Per Month</label>
     <input type="text"  name="Fee_Per" id="Fee_Per" class="form-control" readonly="" value="<?php echo $Fee_Per_Mon; ?>">
   </div>
<?php } ?>

   <div class="col-sm-6">
      <label>Due Amount</label>
     <input type="number"  name="due_fee" id="due_fee" class="form-control" readonly="" value="<?php echo $due_fee; ?>">
   </div>
   <div class="col-sm-6">
      <label>Current Balance</label>
     <input type="number"  name="current_balacne" id="current_balacne" class="form-control" readonly="" value="<?php echo $row1['stu_fee']; ?>">
   </div>
   <div class="col-sm-6">
     <label>Addmission Date</label>
     <input type="date" name="create_on" id="create_on" class="form-control" readonly="" value="<?php echo $row['create_on']; ?>" />
   </div>
   
  </div>
  </div>
	<?php
	}
}
?>
