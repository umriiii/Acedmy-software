<?php
include('../../classes/pdo.php');
function get_total_all_records()
{
include('../../classes/pdo.php');
 $statement = $pcon->prepare("
  SELECT * FROM students as A inner join
   class as B on A.class_id = B.classid inner join
    raw_data as C on A.studentid = C.enrollmentNo 
      WHERE B.classid = '".$_POST['class_id']."' ");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "
SELECT * FROM students as A inner join
   class as B on A.class_id = B.classid inner join
    raw_data as C on A.studentid = C.enrollmentNo 
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
 $query .= "AND B.classid = '".$_POST["class_id"]."'  ";
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
$status = '';
$att_msg_status = '';
	$i++;

 $sub_array = array();
 $sub_array[] = $i;

 $sub_array[] = $row["stu_reg_no"];
 $sub_array[] = $row["stu_first_name"];
 $sub_array[] = $row["stu_last_name"];
 $sub_array[] = $row["class_name"];
 if ($row['att_status'] == 0) {
 	$status = '<span class="text-success"><b>Normal</b></span>';
 }else if($row['att_status'] == 1){
    $status = '<span class="text-danger"><b>Absent</b></span>';
 }else if($row['att_status'] == 2){
  $status = '<span class="text-info"><b>Late</b></span>';
 	   
 }else if($row['att_status'] == 3){
  $status = '<span class="text-warning"><b>Leave</b></span>';
 }else if($row['att_status'] == 4){
  $status = '<span class="text-secondary"><b>Early Leave</b></span>';
 }else if($row['att_status'] == 5){
  $status = '<b>Late & Early Leave</b>';
    
 }else{
    $status = 'Undef';
 }
 $sub_array[] = $status;
 if($row['att_msg_status'] == 0){
  $att_msg_status = 'Not send';
   
 }else if($row['att_msg_status'] == 1){
   $att_msg_status = 'Message Sent';
   
 }else if($row['att_msg_status'] == 2){
       $att_msg_status = 'second time Sent';
 }else{
      $att_msg_status = 'Unknown';
 }
 
  $sub_array[] = $att_msg_status;
 $sub_array[] = $row["entryDate"];

 $sub_array[] = '<button type="button" name="view" id="'.$row["id"].'" class="btn btn-primary normal">Normal</button>';
     $sub_array[] = '<button type="button" name="view" id="'.$row["id"].'" class="btn btn-danger absent">Absent</button>';

     $sub_array[] = '<button type="button" name="view" id="'.$row["id"].'" class="btn btn-info late">Late</button>';
      $sub_array[] = '<button type="button" name="view" id="'.$row["id"].'" class="btn btn-warning leave">Leave</button>';
      $sub_array[] = '<button type="button" name="view" id="'.$row["id"].'" class="btn btn-secondary e_leave">Early Leave</button>';
 
  

      $sub_array[] = '<button type="button" name="view" id="'.$row["id"].'" class="btn btn-dark late_e_leave">Late & Early Leave</button>';


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