<?php
include('../../classes/pdo.php');

if (isset($_POST['fee_id'])) {
	$fee_id = $_POST['fee_id'];
?>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h4>Student Details</h4>
			<br>
		</div>
		<div class="col-md-12 text-center">
			<?php 
$query = "SELECT * FROM students as A 
inner join class as B 
on A.class_id = B.classid
inner join fee_assign as C
on A.studentid = C.stu_id 
inner join fee_type AS D
 ON C.ft_id = D.ftid
inner join discounts AS E
ON A.discount_category = E.discid
inner join misc_discounts AS F 
ON A.misc_disc_cat = F.miscdiscid
 WHERE C.feeid = '$fee_id'";
 $stat = $pcon->prepare($query);
$stat->execute();
$value = $stat->fetch();
			 ?>
<table class="table table-bordered">
	<tr>
		<th width="5" rowspan="2"><img src="class/ajax_sql_students/students_upload/<?php echo $value['image']; ?>" class="img-rounded" height="120" width="120"></th>
		<th>Student Name</th>
		<th>Father Name</th>
		<th>Class</th>
		<th>Fee Type</th>
	</tr>
	<tr>
			<td><?php echo $value['stu_first_name'] ?></td>
			<td><?php echo $value['stu_last_name']; ?></td>
			<td><?php echo $value['class_name']; ?></td>
			<td><?php echo $value['title']; ?></td>
	</tr>
</table>
	<div id="display"></div>
<table class="table table-bordered not-show">
	<tr>
		<th>Fee Title</th>
		<th>Fee Amount</th>
		<th>Fee After Discount</th>
		<th>Amount Collected</th>
		<th>Due Amount</th>
	</tr>
	<tr>
			<td><?php echo $value['title'] ?></td>
			<td><?php echo $value['def_fee']; ?></td>
			<?php 
 if($value["ft_kind"] == 0){
 	 $discount = $value['disc_per'];
  $calculation = $value['def_fee'] * $discount;
  $after_discount = $calculation/100;
  $actual_fee = $value['def_fee'] - $after_discount; 
 }else{
 	$misc_discount = $value['misc_disc_per'];
  $misc_calculation = $value['def_fee'] * $misc_discount;
  $after_misc_discount = $misc_calculation/100;
  $actual_fee = $value['def_fee'] - $after_misc_discount;
 }
			 ?>
			<td><?php echo $actual_fee; ?></td>
			<td><?php echo $value['balance']; ?></td>
<?php 
$due_amount = $actual_fee - $value['balance'];
?>
            <td><?php echo $due_amount; ?></td>
			
			
	</tr>
</table>
			<br>
		</div>
<div class="col-md-4 offset-md-4">
	<form>
		<h5>Enter Fee to Collect</h5>
		<input type="number" class="form-control colted_amount" name="colted_amount" id="colted_amount">
		<input type="hidden" name="hidden_feeid" id="hidden_feeid" value="<?php echo $value['feeid']; ?>">
		
	</form>
</div>
	</div>
</div>
<?php } ?>