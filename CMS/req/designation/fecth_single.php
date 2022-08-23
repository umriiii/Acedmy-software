<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM designation
  WHERE designation_id = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["designation_title"] = $row["designation_title"];
 }
 echo json_encode($output);
}
?>