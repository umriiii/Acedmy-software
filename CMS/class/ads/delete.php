<?php
 include '../../../config/db.php'; 
include('crud_functions.php');

if(isset($_POST["user_id"]))
{
 
 $statement = $connection->prepare(
  "DELETE FROM advertises WHERE adid = :id"
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