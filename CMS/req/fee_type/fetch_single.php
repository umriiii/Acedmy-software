<?php
include('../../classes/pdo.php');

if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $pcon->prepare(
  "SELECT * FROM 
  fee_type AS A inner join
   installments AS B on
   A.install_id = B.instaid 
  WHERE ftid = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["title"] = $row["title"];
  $output["v_title"] = $row["v_title"];
  $output["def_fee"] = $row["def_fee"];
  $output["due_date"] = $row["due_date"];
  $output["instaid"] = $row["instaid"];
  $output["ft_kind"] = $row["ft_kind"];
  $output["fine"] = $row["fine"];
  $output["running_status"] = $row["running_status"];
  $output["ftid"] = $row["ftid"];
 }
 echo json_encode($output);
}
?>