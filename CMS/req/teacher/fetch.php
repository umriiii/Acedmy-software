<?php
$pcon = new PDO( 
    'mysql:host=localhost;dbname=cms', 
    'root', 
    '', 
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") 
);
function get_total_all_records()
{
$pcon = new PDO( 
    'mysql:host=localhost;dbname=cms', 
    'root', 
    '', 
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") 
);
 $statement = $pcon->prepare("SELECT * FROM teacher AS A inner join designation AS B ON A.desig_id=B.designation_id WHERE B.designation_title='".$_POST['teacherid']."'");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM teacher AS A inner join designation AS B ON A.desig_id=B.designation_id  ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE A.firstname LIKE "%'.$_POST["search"]["value"].'%" ';
  $query .= 'OR B.designation_title LIKE "%'.$_POST["search"]["value"].'%" ';
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
 $sub_array[] = $row["firstname"];
 $sub_array[] = '<button type="button" name="update" id="'.$row["teacherid"].'" class="btn btn-warning btn-xs update">Update</button>';
 $sub_array[] = '<button type="button" name="delete" id="'.$row["teacherid"].'" class="btn btn-danger btn-xs delete">Delete</button>';

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
