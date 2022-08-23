<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM installments 
  WHERE instaid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["insta_name"] = $row["insta_name"];
  $output["instaid"] = $row["instaid"];
 }
 echo json_encode($output);
}
?>