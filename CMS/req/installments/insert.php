<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
  $statement = $pcon->prepare("
   INSERT INTO installments (insta_name) 
   VALUES (:insta_name)
  ");
  $result = $statement->execute(
   array(
    ':insta_name' => $_POST['insta_name']
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }

}
 }
 if($_POST["operation"] == "Edit")
 {

  $statement = $pcon->prepare(
   "UPDATE installments
   SET insta_name = :insta_name  
   WHERE instaid = :id
   "
  );
  $result = $statement->execute(
   array(
     ':insta_name' => $_POST['insta_name'],
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


?>