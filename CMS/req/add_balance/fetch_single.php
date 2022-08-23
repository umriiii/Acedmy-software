<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM balance 
  WHERE balid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["stu_id"] = $row["stu_id"];
  $output["balance"] = $row["stu_balance"];
  $output["bal_disc"] = $row["bal_disc"];
  $output["balid"] = $row["balid"];
 }
 echo json_encode($output);
}
?>