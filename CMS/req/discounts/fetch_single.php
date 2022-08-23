<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM discounts 
  WHERE discid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["disc_name"] = $row["disc_name"];
  $output["disc_per"] = $row["disc_per"];
  $output["disc_desc"] = $row["disc_desc"];
  $output["disc_status"] = $row["disc_status"];
  $output["discid"] = $row["discid"];
 }
 echo json_encode($output);
}
?>