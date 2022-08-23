<?php
 include '../../../config/db.php'; 
include('crud_functions.php');
if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $connection->prepare(
  "SELECT * FROM advertises AS A inner join packages AS B ON A.pkg_id = B.pkgid 
  WHERE A.adid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["ad_title"] = $row["ad_title"];
  $output["ad_price"] = $row["ad_price"];
  $output["pkg_id"] = $row["pkg_id"];
  $output["link"] = $row["link"];
  $output["ad_status"] = $row["ad_status"];
 }
 echo json_encode($output);
}
?>