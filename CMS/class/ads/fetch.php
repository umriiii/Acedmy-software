<?php
 include '../../classes/pdo.php';
include('crud_functions.php');
$query = '';
$output = array();
$query .= "SELECT * FROM advertises ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE ad_title LIKE "%'.$_POST["search"]["value"].'%" ';

}

if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$i = 0;
foreach($result as $row)
{
	$i++;
 $sub_array = array();
$sub_array[] = $i;
$sub_array[] = $row["ad_title"];

$sub_array[] = $row["ad_price"];
$sub_array[] = $row["link"];
 $sub_array[] = '<button type="button" name="update" id="'.$row["adid"].'" class="btn btn-warning btn-xs update">Update</button>';
 $sub_array[] = '<button type="button" name="delete" id="'.$row["adid"].'" class="btn btn-danger btn-xs delete">Delete</button>';

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