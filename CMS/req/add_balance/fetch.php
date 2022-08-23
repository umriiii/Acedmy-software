<?php
include('../../classes/pdo.php');
function get_total_all_records()
{
include('../../classes/pdo.php');
 $statement = $pcon->prepare("SELECT * FROM balance ");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM balance AS A inner join students AS B ON A.stu_id = B.studentid inner join class AS C ON B.class_id = C.classid ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE B.stu_first_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= " ";
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
	$i++;

 $sub_array = array();
 $sub_array[] = $i;
 $sub_array[] = $row["stu_reg_no"];
 $sub_array[] = $row["stu_first_name"];
 
 $sub_array[] = $row["stu_last_name"];
 $sub_array[] = $row["class_name"];

 $sub_array[] = $row["stu_balance"];
 $sub_array[] = $row["bal_disc"];
 
 
 // $sub_array[] = '<button type="button" name="view" id="'.$row["classid"].'" class="btn btn-info btn-xs view_data">View</button>';
 $sub_array[] = '<button type="button" name="update" id="'.$row["balid"].'" class="btn btn-warning btn-xs update">Update</button>';


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