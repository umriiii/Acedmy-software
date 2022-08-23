<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM fines 
  WHERE fineid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["fine_name"] = $row["fine_name"];
  $output["fine_amount"] = $row["fine_amount"];
  $output["fine_desc"] = $row["fine_desc"];
  $output["fine_status"] = $row["fine_status"];
  $output["fineid"] = $row["fineid"];
 }
 echo json_encode($output);
}
?>