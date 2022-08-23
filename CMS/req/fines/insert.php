<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
  $statement = $pcon->prepare("
   INSERT INTO fines (fine_name, fine_amount, fine_desc, fine_status) 
   VALUES (:fine_name, :fine_amount, :fine_desc, :fine_status)
  ");
  $result = $statement->execute(
   array(
    ':fine_name' => $_POST['fine_name'],
    ':fine_amount' => $_POST['fine_amount'],
    ':fine_desc' => $_POST['fine_desc'],
    ':fine_status' => $_POST['fine_status']
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
   "UPDATE fines
   SET fine_name = :fine_name, fine_amount = :fine_amount, fine_desc = :fine_desc, fine_status = :fine_status  
   WHERE fineid = :id
   "
  );
  $result = $statement->execute(
   array(
     ':fine_name' => $_POST['fine_name'],
    ':fine_amount' => $_POST['fine_amount'],
    ':fine_desc' => $_POST['fine_desc'],
    ':fine_status' => $_POST['fine_status'],
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


?>