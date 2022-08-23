<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM subjects 
  WHERE subjectid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["sub_name"] = $row["sub_name"];
  $output["sub_tec_id"] = $row["sub_tec_id"];
  $output["class_id"] = $row["class_id"];
  $output["subjectid"] = $row["subjectid"];
 }
 echo json_encode($output);
}
?>