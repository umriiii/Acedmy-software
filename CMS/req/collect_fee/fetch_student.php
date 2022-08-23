<?php
include('../../classes/pdo.php');
function get_total_all_records()
{
include('../../classes/pdo.php');
 $statement = $pcon->prepare("SELECT * FROM students as A inner join class as B on A.class_id=B.classid inner join fee_assign as C on A.studentid=C.stu_id inner join fee_type AS D ON C.ft_id = D.ftid  WHERE A.studentid = '".$_POST['stu_id']."' ");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "
SELECT * FROM students as A 
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
   ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE (A.stu_first_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR A.stu_last_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR B.class_name LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= "AND A.studentid = '".$_POST["stu_id"]."'  ";
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $pcon->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$i=0;

foreach($result as $row)
{
  $actual_fee  = 0;
$due_amount = 0;
	$i++;
$actual_fee = 0;
 $sub_array = array();
 $sub_array[] = $i;
 $sub_array[] = $row["title"];
 $sub_array[] = $row["stu_first_name"];
 $sub_array[] = $row["stu_last_name"];
 $sub_array[] = $row["class_name"];
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
  $sub_array[] = $row["def_fee"];
   $sub_array[] = $actual_fee;


 $sub_array[] = $row["balance"];

$due_amount = $actual_fee - $row['balance'];

 
 $fee_status = $row['fee_status'];
if($actual_fee == $row['balance']){
	 $sub_array[] = "<h6 class='text-center' style='background-color:green;color:white;padding:7px;border-radius:10px;'>Paid</h6>";
}else if($row['balance'] == 0){
	 $sub_array[] = "<h6 class='text-center' style='background-color:red;color:white;padding:7px;border-radius:10px;'>Not Paid</h6>";
	}
 else if($actual_fee > $row['balance']){
 	 $sub_array[] = "<h6 class='text-center' style='background-color:#ff9900;color:white;padding:7px;border-radius:10px;'>RS ".$due_amount." Dues</h6>";
 	}else{
 	}
 $sub_array[] = '<button type="button" name="view" id="'.$row["feeid"].'" class="btn btn-info btn-sm collect_fee">Collect Fee</button>';
 // $sub_array[] = '<button type="button" name="update" id="'.$row["feeid"].'" class="btn btn-warning btn-xs update">Update</button>';
 // $sub_array[] = '<button type="button" name="delete" id="'.$row["feeid"].'" class="btn btn-danger btn-xs delete">Delete</button>';

 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records(),
 "data"    => $data
);
echo json_encode($output);
?>