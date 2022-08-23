<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {

  $statement = $pcon->prepare("
   INSERT INTO designation (designation_title) 
   VALUES (:designation_title)
  ");
  $result = $statement->execute(
   array(
    ':designation_title' => $_POST['designation_title']
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
   "UPDATE designation
   SET designation_title = :designation_title  
   WHERE designation_id = :id
   "
  );
  $result = $statement->execute(
   array(
      ':designation_title' => $_POST['designation_title'],
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


?>