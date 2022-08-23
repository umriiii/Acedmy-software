<?php
include('../../classes/connection.php');
$connection = new PDO("mysql:host=$host; dbname=$database", $username, $password);
$issue_date = date('d-m-Y');
function fill_product_list($connection)
{
  $query = "
  SELECT * FROM class where running_status = 'Active'";
  $statement = $connection->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $output = '';
  $place = "Select class";
  $output .= '<option value="" selected="">'.$place.'</option>';
  foreach($result as $row)
  {
    $output .= '<option value="'.$row["classid"].'">'.$row["class_name"].'</option>';
  }
  return $output;
}
if(!empty($_POST))
{

    
	if($_POST['btn_action'] == 'Add')
	{
			$ft_id = $_POST['ft_id'];
	$class_id = $_POST['class_id'];
	
			for($count = 0; $count<count($_POST["class_id"]); $count++)
			{


$query = "
  SELECT * FROM fee_type where ftid = '$ft_id'";
  $statement = $connection->prepare($query);
  $statement->execute();
  $vall = $statement->fetch();

$installments = $vall['install_id'];
$fee_kind = $vall['ft_kind'];


if ($fee_kind == 1) {
	
	  $query = "
  SELECT * FROM students WHERE class_id =  '".$_POST["class_id"][$count]."' Group by studentid
  ";
  $statement = $connection->prepare($query);
  $statement->execute();
  $count_row = $statement->rowCount();
  if($count_row > 0){
  	 $result = $statement->fetchAll();
  	  foreach ($result as $row) {
   $stu_id = $row['studentid'];

 $query = "
  SELECT * FROM students AS A 
  inner join balance AS
   B ON A.studentid = B.stu_id 
   inner join discounts AS E
ON A.discount_category = E.discid
inner join misc_discounts AS F 
ON A.misc_disc_cat = F.miscdiscid 
WHERE A.studentid = '$stu_id'";
  $statement = $connection->prepare($query);
  $statement->execute();
  $rowco = $statement->rowCount();

if($rowco > 0){
 $res = $statement->fetch();

$stu_current_balance = $res['stu_balance'];
$stu_current_fee_amount = $vall['def_fee'];


$misc_discount = $res['misc_disc_per'];
  $misc_calculation = $stu_current_fee_amount * $misc_discount;
  $after_misc_discount = $misc_calculation/100;
  $actual_fee_after_discount = $stu_current_fee_amount - $after_misc_discount;



if($stu_current_balance >= $actual_fee_after_discount){
	$calculation = $stu_current_balance - $actual_fee_after_discount;
	$status = 'Paid';
	 $sub_query = "
				INSERT INTO fee_assign (ft_id, balance, class_id, stu_id, fee_status, issue_date) VALUES (:ft_id, :balance, :class_id, :stu_id, :status, :issue_date)
				";
				$statement = $connection->prepare($sub_query);
				$statement->execute(
					array(
						':ft_id'	=>	$ft_id,
						':balance'	=>	$actual_fee_after_discount,
						':stu_id'	=>	$stu_id,
						':status'   =>  $status,
						':issue_date'   =>  $issue_date,
						':class_id'			=>	$_POST["class_id"][$count]
					)
				);
}else if($stu_current_balance == 0){
	$calculation = 0;
	$status = 'Not Paid';
	 $sub_query = "
				INSERT INTO fee_assign (ft_id, balance, class_id, stu_id, fee_status, issue_date) VALUES (:ft_id, :balance, :class_id, :stu_id, :status, :issue_date)
				";
				$statement = $connection->prepare($sub_query);
				$statement->execute(
					array(
						':ft_id'	=>	$ft_id,
						':balance'	=>	0,
						':stu_id'	=>	$stu_id,
						':status'   =>  $status,
						':issue_date'   =>  $issue_date,
						':class_id'			=>	$_POST["class_id"][$count]
					)
				);
}else{
	$calculation = 0;
	$status = 'Not Paid';
	 $sub_query = "
				INSERT INTO fee_assign (ft_id, balance, class_id, stu_id, fee_status, issue_date) VALUES (:ft_id, :balance, :class_id, :stu_id, :status, :issue_date)
				";
				$statement = $connection->prepare($sub_query);
				$statement->execute(
					array(
						':ft_id'	=>	$ft_id,
						':balance'	=>	$stu_current_balance,
						':stu_id'	=>	$stu_id,
						':status'   =>  $status,
						':issue_date'   =>  $issue_date,
						':class_id'			=>	$_POST["class_id"][$count]
					)
				);
}




 $statement = $connection->prepare(
   "UPDATE balance
   SET stu_balance = '$calculation'
   WHERE stu_id = '$stu_id'
   "
  );
  $result = $statement->execute();

}else{
	$status = 'Not Paid';
	 $sub_query = "
				INSERT INTO fee_assign (ft_id, balance, class_id, stu_id, fee_status, issue_date) VALUES (:ft_id, :balance, :class_id, :stu_id, :status, :issue_date)
				";
				$statement = $connection->prepare($sub_query);
				$statement->execute(
					array(
						':ft_id'	=>	$ft_id,
						':balance'	=>	0,
						':stu_id'	=>	$stu_id,
						':status'   =>  $status,
						':issue_date'   =>  $issue_date,
						':class_id'			=>	$_POST["class_id"][$count]
					)
				);
}




			
				}
  	}else{

  	}
}else{

	  $query = "
  SELECT * FROM students AS A inner join fee_type AS
   B ON A.student_fee = B.install_id
   WHERE A.class_id =  '".$_POST["class_id"][$count]."' AND A.student_fee = '$installments' Group by A.studentid
  ";
  $statement = $connection->prepare($query);
  $statement->execute();
  $count_row = $statement->rowCount();
  if($count_row > 0){
  	 $result = $statement->fetchAll();
  	  foreach ($result as $row) {
   $stu_id = $row['studentid'];

 $query = "
  SELECT * FROM students AS A
   inner join balance AS
   B ON A.studentid = B.stu_id
inner join discounts AS E
ON A.discount_category = E.discid
inner join misc_discounts AS F 
ON A.misc_disc_cat = F.miscdiscid 
    WHERE A.studentid = '$stu_id'";
  $statement = $connection->prepare($query);
  $statement->execute();
  $rowco = $statement->rowCount();

if($rowco > 0){
 $res = $statement->fetch();

$stu_current_balance = $res['stu_balance'];
$stu_current_fee_amount = $row['def_fee'];


 $discount = $res['disc_per'];
  $calcu = $row['def_fee'] * $discount;
  $after_discount = $calcu/100;
  $actual_fee_after_discount = $row['def_fee'] - $after_discount;



if($stu_current_balance >= $actual_fee_after_discount){
	$calculation = $stu_current_balance - $actual_fee_after_discount;
	$status = 'Paid';
	 $sub_query = "
				INSERT INTO fee_assign (ft_id, balance, class_id, stu_id, fee_status, issue_date) VALUES (:ft_id, :balance, :class_id, :stu_id, :status, :issue_date)
				";
				$statement = $connection->prepare($sub_query);
				$statement->execute(
					array(
						':ft_id'	=>	$ft_id,
						':balance'	=>	$actual_fee_after_discount,
						':stu_id'	=>	$stu_id,
						':status'   =>  $status,
						':issue_date'   =>  $issue_date,
						':class_id'			=>	$_POST["class_id"][$count]
					)
				);
}else if($stu_current_balance == 0){
	$calculation = 0;
	$status = 'Not Paid';
	 $sub_query = "
				INSERT INTO fee_assign (ft_id, balance, class_id, stu_id, fee_status, issue_date) VALUES (:ft_id, :balance, :class_id, :stu_id, :status, :issue_date)
				";
				$statement = $connection->prepare($sub_query);
				$statement->execute(
					array(
						':ft_id'	=>	$ft_id,
						':balance'	=>	0,
						':stu_id'	=>	$stu_id,
						':status'   =>  $status,
						':issue_date'   =>  $issue_date,
						':class_id'			=>	$_POST["class_id"][$count]
					)
				);
}else{
	$calculation = 0;
	$status = 'Not Paid';
	 $sub_query = "
				INSERT INTO fee_assign (ft_id, balance, class_id, stu_id, fee_status, issue_date) VALUES (:ft_id, :balance, :class_id, :stu_id, :status, :issue_date)
				";
				$statement = $connection->prepare($sub_query);
				$statement->execute(
					array(
						':ft_id'	=>	$ft_id,
						':balance'	=>	$stu_current_balance,
						':stu_id'	=>	$stu_id,
						':status'   =>  $status,
						':issue_date'   =>  $issue_date,
						':class_id'			=>	$_POST["class_id"][$count]
					)
				);
}




 $statement = $connection->prepare(
   "UPDATE balance
   SET stu_balance = '$calculation'
   WHERE stu_id = '$stu_id'
   "
  );
  $result = $statement->execute();

}else{
	$status = 'Not Paid';
	 $sub_query = "
				INSERT INTO fee_assign (ft_id, balance, class_id, stu_id, fee_status, issue_date) VALUES (:ft_id, :balance, :class_id, :stu_id, :status, :issue_date)
				";
				$statement = $connection->prepare($sub_query);
				$statement->execute(
					array(
						':ft_id'	=>	$ft_id,
						':balance'	=>	0,
						':stu_id'	=>	$stu_id,
						':status'   =>  $status,
						':issue_date'   =>  $issue_date,
						':class_id'			=>	$_POST["class_id"][$count]
					)
				);
}




			
				}
  	}else{

  	}
}




 
 	
			}
			
	}
		if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM fee_type AS A inner join fee_assign AS B on A.ftid = B.ft_id WHERE B.feeid = :feeid
		";
		$statement = $connection->prepare($query);
		$statement->execute(
			array(
				':feeid'	=>	$_POST["feeid"]
			)
		);
		$result = $statement->fetchAll();
		$output = array();
		foreach($result as $row)
		{
			
			$output['ft_id'] = $row['ft_id'];
			$fee_type_id = $row['ft_id'];
		}
		$sub_query = "
		SELECT * FROM fee_type AS A inner join fee_assign AS B on A.ftid = B.ft_id inner join class AS C on B.class_id = C.classid WHERE B.ft_id = '".$fee_type_id."'  Group by B.class_id
		";
		$statement = $connection->prepare($sub_query);
		$statement->execute();
		$sub_result = $statement->fetchAll();
		$product_details = '';
		$count = 0;
		foreach($sub_result as $sub_row)
		{
			$product_details .= '
		<script>
			$(document).ready(function(){
				$("#class_id'.$count.'").val('.$sub_row["class_id"].');
			});
			</script>
			<span id="row'.$count.'">
				<div class="row">
					<div class="col-md-8">
						<select name="class_id[]" id="class_id'.$count.'" class="form-control" required>
							'.fill_product_list($connection).'
						</select>
						<input type="hidden" name="hidden_product_id[]" id="hidden_product_id'.$count.'" value="'.$sub_row["class_id"].'" />
					</div>
					<div class="col-md-4">
			';
			if($count == '')
			{
				$product_details .= '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
			}
			else
			{
				$product_details .= '<button type="button" name="remove" id="'.$count.'" class="btn btn-danger btn-xs remove">-</button>';
			}
			$product_details .= '
						</div>
					</div>
				</div><br />
			</span>
			';
			$count = $count + 1;
		}
		$output['product_details'] = $product_details;
		echo json_encode($output);
	}

	}