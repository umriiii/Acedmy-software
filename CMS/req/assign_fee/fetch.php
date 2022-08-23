<?php
include('../../classes/pdo.php');
function get_total_all_records()
{
include('../../classes/pdo.php');
 $statement = $pcon->prepare("SELECT * FROM class As A 
                 inner join teacher As B on A.teacher_id=B.teacherid WHERE (A.running_status = 'Active') ORDER BY A.classid DESC");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT 
           * 
           FROM fee_type AS A inner join fee_assign AS B ON A.ftid = B.ft_id  ";
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
 $query .= "Group by B.ft_id ";
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
 $sub_array[] = $row["title"];
 
 $sub_array[] = '<button type="button" name="view" id="'.$row["feeid"].'" class="btn btn-info btn-xs view_data">View</button>';
 // $sub_array[] = '<button type="button" name="update" id="'.$row["feeid"].'" class="btn btn-warning btn-xs edit_data">Update</button>';
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