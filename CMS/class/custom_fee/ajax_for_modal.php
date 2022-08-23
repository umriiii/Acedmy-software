<?php 
include '../config/db.php'; 
if(isset($_POST['stu_roll_no']))
{
	$stu_roll_no = $_POST['stu_roll_no'];
$query = mysqli_query($connect,"SELECT * FROM students AS A Inner Join class AS B ON A.class_id = B.classid WHERE A.stu_reg_no = '$stu_roll_no'");
 $result = mysqli_fetch_array($query);

 $stu_first_name = $result['stu_first_name'];
 $stu_last_name = $result['stu_last_name'];
 $stu_class = $result['class_name'];
 $image = $result['image'];
?>
<div class="row">
<div class="col-sm-6">
	<label>Student Name</label>
	<input type="text" name="stu_name" class="form-control" value="<?php echo $stu_first_name; ?>" disabled="">
</div>
<div class="col-sm-6">
	<label>Father Name</label>
	<input type="text" name="stu_name" class="form-control" value="<?php echo $stu_last_name; ?>" disabled="">
</div>
<div class="col-sm-6">
	<label>Class</label>
	<input type="text" name="stu_name" class="form-control" value="<?php echo $stu_class; ?>" disabled="">
</div>

</div>
<?php
}
 ?>