<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM class As A 
  inner join teacher As B on 
  A.teacher_id=B.teacherid 
  WHERE A.classid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["class_name"] = $row["class_name"];
  $output["code_name"] = $row["code_name"];
  $output["classid"] = $row["classid"];
  $output["class_fee"] = $row["class_fee"];
  $output["class_status"] = $row["class_status"];
  $output["running_status"] = $row["running_status"];
  $output["teacherid"] = $row["teacherid"];
 }
 echo json_encode($output);
}
?>