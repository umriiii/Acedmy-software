<?php
include('../../classes/pdo.php');
if(isset($_POST["user_id"]))
{
 
 $statement = $pcon->prepare(
  "DELETE FROM class WHERE classid = :id"
 );
 $result = $statement->execute(
  array(
   ':id' => $_POST["user_id"]
  )
 );
 
 if(!empty($result))
 {
  echo 'Data Deleted';
 }
}



?>