<?php
include('../../classes/pdo.php');
function get_total_all_records()
{
include('../../classes/pdo.php');
 $statement = $pcon->prepare("SELECT * FROM fee_type AS A inner join installments AS B on A.install_id = B.instaid ");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM fee_type AS A inner join installments AS B ON A.install_id = B.instaid ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE A.title LIKE "%'.$_POST["search"]["value"].'%" ';
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
 $sub_array[] = $row["v_title"];
 $sub_array[] = $row["title"];
 
 $sub_array[] = $row["def_fee"];
 $sub_array[] = $row["due_date"];

 $sub_array[] = $row["insta_name"];
 if($row["ft_kind"] == 0){
 	$kind = "Particulars";
 }else{
 	$kind = "Miscellaneous";
 }
 $sub_array[] = $kind;
  $sub_array[] = $row["fine"];
 $sub_array[] = $row["running_status"];
 
 // $sub_array[] = '<button type="button" name="view" id="'.$row["classid"].'" class="btn btn-info btn-xs view_data">View</button>';
 $sub_array[] = '<button type="button" name="update" id="'.$row["ftid"].'" class="btn btn-warning btn-xs update">Update</button>';
 $sub_array[] = '<button type="button" name="delete" id="'.$row["ftid"].'" class="btn btn-danger btn-xs delete">Delete</button>';

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