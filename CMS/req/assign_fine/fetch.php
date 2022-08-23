<?php
include('../../classes/pdo.php');
function get_total_all_records()
{
include('../../classes/pdo.php');
 $statement = $pcon->prepare("SELECT * FROM students As A 
                 inner join assign_fine As B on A.studentid = B.assign_stu_id inner join fines AS C ON B.fine_id = C.fineid ");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM students As A 
                 inner join assign_fine As B on A.studentid = B.assign_stu_id inner join fines AS C ON B.fine_id = C.fineid inner join class AS D ON A.class_id = D.classid ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE A.stu_first_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR A.stu_last_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR A.stu_reg_no LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= " ORDER BY B.assignid DESC ";
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
 $sub_array[] = $row["stu_first_name"];
 $sub_array[] = $row["stu_last_name"];
 $sub_array[] = $row["class_name"];
 $sub_array[] = $row["fine_name"];
 $sub_array[] = $row["fine_amount"];
 $sub_array[] = $row["collected_fine"];
 // $sub_array[] = '<button type="button" name="view" id="'.$row["classid"].'" class="btn btn-info btn-xs view_data">View</button>';

 $sub_array[] = '<button type="button" name="delete" id="'.$row["assignid"].'" class="btn btn-danger btn-xs delete">Delete</button>';

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