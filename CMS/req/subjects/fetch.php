<?php
include('../../classes/pdo.php');
function get_total_all_records()
{
include('../../classes/pdo.php');
 $statement = $pcon->prepare("SELECT * FROM subjects as A inner join teacher as B on A.sub_tec_id=B.teacherid inner join class as C on A.class_id=C.classid WHERE A.class_id = '".$_POST['class_id']."' ");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM subjects as A inner join teacher as B on A.sub_tec_id = B.teacherid inner join class as C on A.class_id = C.classid ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE (A.sub_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR B.firstname LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR C.class_name LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= "AND A.class_id = '".$_POST["class_id"]."'  ";
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
 $sub_array[] = $row["sub_name"];
 $sub_array[] = $row["firstname"];
 $sub_array[] = $row["class_name"];
 
 // $sub_array[] = '<button type="button" name="view" id="'.$row["classid"].'" class="btn btn-info btn-xs view_data">View</button>';
 $sub_array[] = '<button type="button" name="update" id="'.$row["subjectid"].'" class="btn btn-warning btn-xs update">Update</button>';
 $sub_array[] = '<button type="button" name="delete" id="'.$row["subjectid"].'" class="btn btn-danger btn-xs delete">Delete</button>';

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