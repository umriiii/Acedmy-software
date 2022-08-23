<?php
include('../../classes/pdo.php');

if (isset($_POST['feeid'])) {
	$colted_amount = $_POST['colted_amount'];
	$feeid = $_POST['feeid'];
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
 WHERE C.feeid = '$feeid'";
 $stat = $pcon->prepare($query);
$stat->execute();
$row = $stat->fetch();

if($row["ft_kind"] == 0){
 	 $discount = $row['disc_per'];
  $calculation = $row['def_fee'] * $discount;
  $after_discount = $calculation/100;
  $actual_fee = $row['def_fee'] - $after_discount; 
 }else{
 	$misc_discount = $row['misc_disc_per'];
  $misc_calculation = $row['def_fee'] * $misc_discount;
  $after_misc_discount = $misc_calculation/100;
  $actual_fee = $row['def_fee'] - $after_misc_discount;
 }



if($actual_fee == $colted_amount){
	 $status = "Paid";
}else if($colted_amount == 0){
	  $status = "Not Paid";
	}
 else if($actual_fee > $colted_amount){
 	 $status = "Not Paid";
 	}else{
 	}






	 $statement = $pcon->prepare(
   "UPDATE fee_assign
   SET balance = '$colted_amount',fee_status = '$status'
   WHERE feeid = '$feeid'
   "
  );
  $result = $statement->execute();
   if(!empty($result))
  {
   ?>

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
 WHERE C.feeid = '$feeid'";
 $stat = $pcon->prepare($query);
$stat->execute();
$value = $stat->fetch();
			 ?>

<table class="table table-bordered">
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
		
   <?php 
  }

}
?>