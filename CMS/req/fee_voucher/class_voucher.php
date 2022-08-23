<?php 
include('../../classes/pdo.php');

if(isset($_POST['class_id'])){

	$class_id = $_POST['class_id'];

 $statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS A inner join fee_type AS B ON A.ft_id = B.ftid inner join students AS C ON A.stu_id = C.studentid inner join class AS D ON C.class_id = D.classid 
  WHERE A.class_id = '$class_id' Group by C.studentid");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
 	$i++;
 ?>
 <div class="continer pagebreak">
 	<div class="row">

 		<div class="col-md-4 justify-content-center">
 			<h5 class="t_14 text-center">The Muslim PostGraduate College Gojra</h5>
 			
 			<h6 class="t_12 text-center">Baseline Jalal Town Gojra</h6>
 			<h6 class="t_12 text-center">Mobile # 03324878386</h6>
 			<table class="table table-bordered text-dark">
 				<tr>
 					<th colspan="2" ><span class="t_9 text-center">Fee Voucher</span></th>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Student Name</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['stu_first_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Father Name</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['stu_last_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Class</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['class_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Particulars</span></th>
 					<th><span class="t_9 text-center">Amount(PKR)</span></th>
 				</tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS 
  A inner join fee_type 
  AS B ON A.ft_id = B.ftid 
  inner join students 
  AS C ON A.stu_id = C.studentid 
  inner join class AS D 
  ON C.class_id = D.classid
  inner join discounts AS E ON
  C.discount_category = E.discid
  WHERE A.class_id = '$class_id' AND B.ft_kind = 0 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
 	$discount = $row['disc_per'];
 	$calculation = $row['def_fee'] * $discount;
 	$after_discount = $calculation/100;
 	$actual_fee = $row['def_fee'] - $after_discount; 
 	?>
<tr>
	<th class="t_9"><span class="t_9 text-center"><?php echo $row['title']; ?></span></th>
	<td><span class="t_9 text-center"><?php echo $actual_fee; ?></span></td>
</tr>
 	<?php 
 }
 ?>
 		<tr>
 					<th class="t_9"><span class="t_9 text-center">Miscellaneous</span></th>
 					<th><span class="t_9 text-center">Amount(PKR)</span></th>
 				</tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS A inner join fee_type AS B ON A.ft_id = B.ftid inner join students AS C ON A.stu_id = C.studentid inner join class AS D ON C.class_id = D.classid 
  WHERE A.class_id = '$class_id' AND B.ft_kind = 1 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
 	?>
<tr>
	<th class="t_9"><span class="t_9 text-center"><?php echo $row['title']; ?></span></th>
	<td><span class="t_9 text-center"><?php echo $row['def_fee']; ?></span></td>
</tr>
 	<?php 
 }
 ?>

 			</table>

 		</div>
 		<div class="col-md-4 justify-content-center">
 			<h5 class="t_14 text-center">The Muslim PostGraduate College Gojra</h5>
 			
 			<h6 class="t_12 text-center">Baseline Jalal Town Gojra</h6>
 			<h6 class="t_12 text-center">Mobile # 03324878386</h6>
 			<table class="table table-bordered text-dark">
 				<tr>
 					<th colspan="2" ><span class="t_9 text-center">Fee Voucher</span></th>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Student Name</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['stu_first_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Father Name</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['stu_last_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Class</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['class_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Particulars</span></th>
 					<th><span class="t_9 text-center">Amount(PKR)</span></th>
 				</tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS 
  A inner join fee_type 
  AS B ON A.ft_id = B.ftid 
  inner join students 
  AS C ON A.stu_id = C.studentid 
  inner join class AS D 
  ON C.class_id = D.classid
  inner join discounts AS E ON
  C.discount_category = E.discid
  WHERE A.class_id = '$class_id' AND B.ft_kind = 0 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
 	$discount = $row['disc_per'];
 	$calculation = $row['def_fee'] * $discount;
 	$after_discount = $calculation/100;
 	$actual_fee = $row['def_fee'] - $after_discount; 
 	?>
<tr>
	<th class="t_9"><span class="t_9 text-center"><?php echo $row['title']; ?></span></th>
	<td><span class="t_9 text-center"><?php echo $actual_fee; ?></span></td>
</tr>
 	<?php 
 }
 ?>
 		<tr>
 					<th class="t_9"><span class="t_9 text-center">Miscellaneous</span></th>
 					<th><span class="t_9 text-center">Amount(PKR)</span></th>
 				</tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS A inner join fee_type AS B ON A.ft_id = B.ftid inner join students AS C ON A.stu_id = C.studentid inner join class AS D ON C.class_id = D.classid 
  WHERE A.class_id = '$class_id' AND B.ft_kind = 1 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
 	?>
<tr>
	<th class="t_9"><span class="t_9 text-center"><?php echo $row['title']; ?></span></th>
	<td><span class="t_9 text-center"><?php echo $row['def_fee']; ?></span></td>
</tr>
 	<?php 
 }
 ?>

 			</table>

 		</div>
 		<div class="col-md-4 justify-content-center">
 			<h5 class="t_14 text-center">The Muslim PostGraduate College Gojra</h5>
 			
 			<h6 class="t_12 text-center">Baseline Jalal Town Gojra</h6>
 			<h6 class="t_12 text-center">Mobile # 03324878386</h6>
 			<table class="table table-bordered text-dark">
 				<tr>
 					<th colspan="2" ><span class="t_9 text-center">Fee Voucher</span></th>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Student Name</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['stu_first_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Father Name</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['stu_last_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Class</span></th>
 					<td><span class="t_9 text-center"><?php echo $row['class_name']; ?></span></td>
 				</tr>
 				<tr>
 					<th class="t_9"><span class="t_9 text-center">Particulars</span></th>
 					<th><span class="t_9 text-center">Amount(PKR)</span></th>
 				</tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS 
  A inner join fee_type 
  AS B ON A.ft_id = B.ftid 
  inner join students 
  AS C ON A.stu_id = C.studentid 
  inner join class AS D 
  ON C.class_id = D.classid
  inner join discounts AS E ON
  C.discount_category = E.discid
  WHERE A.class_id = '$class_id' AND B.ft_kind = 0 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
 	$discount = $row['disc_per'];
 	$calculation = $row['def_fee'] * $discount;
 	$after_discount = $calculation/100;
 	$actual_fee = $row['def_fee'] - $after_discount; 
 	?>
<tr>
	<th class="t_9"><span class="t_9 text-center"><?php echo $row['title']; ?></span></th>
	<td><span class="t_9 text-center"><?php echo $actual_fee; ?></span></td>
</tr>
 	<?php 
 }
 ?>
 		<tr>
 					<th class="t_9"><span class="t_9 text-center">Miscellaneous</span></th>
 					<th><span class="t_9 text-center">Amount(PKR)</span></th>
 				</tr>
<?php 
$statement = $pcon->prepare(
  "SELECT * FROM fee_assign AS A inner join fee_type AS B ON A.ft_id = B.ftid inner join students AS C ON A.stu_id = C.studentid inner join class AS D ON C.class_id = D.classid 
  WHERE A.class_id = '$class_id' AND B.ft_kind = 1 Group by A.ft_id");
 $statement->execute();
 $result = $statement->fetchAll();
 $i=0;
 foreach($result as $row)
 {
 	?>
<tr>
	<th class="t_9"><span class="t_9 text-center"><?php echo $row['title']; ?></span></th>
	<td><span class="t_9 text-center"><?php echo $row['def_fee']; ?></span></td>
</tr>
 	<?php 
 }
 ?>

 			</table>

 		</div>

 	</div>

 </div>
 <?php 
 }
}

 ?>