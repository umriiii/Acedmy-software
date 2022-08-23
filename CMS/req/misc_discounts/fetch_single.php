<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM misc_discounts 
  WHERE miscdiscid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["misc_disc_name"] = $row["misc_disc_name"];
  $output["misc_disc_per"] = $row["misc_disc_per"];
  $output["misc_disc_desc"] = $row["misc_disc_desc"];
  $output["misc_disc_status"] = $row["misc_disc_status"];
  $output["miscdiscid"] = $row["miscdiscid"];
 }
 echo json_encode($output);
}
?>