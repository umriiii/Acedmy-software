<?php
include('../../classes/pdo.php');
if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
 {
  $statement = $pcon->prepare("
   INSERT INTO discounts (disc_name, disc_per, disc_desc, disc_status) 
   VALUES (:disc_name, :disc_per, :disc_desc, :disc_status)
  ");
  $result = $statement->execute(
   array(
    ':disc_name' => $_POST['disc_name'],
    ':disc_per' => $_POST['disc_per'],
    ':disc_desc' => $_POST['disc_desc'],
    ':disc_status' => $_POST['disc_status']
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
   "UPDATE discounts
   SET disc_name = :disc_name, disc_per = :disc_per, disc_desc = :disc_desc, disc_status = :disc_status  
   WHERE discid = :id
   "
  );
  $result = $statement->execute(
   array(
     ':disc_name' => $_POST['disc_name'],
    ':disc_per' => $_POST['disc_per'],
    ':disc_desc' => $_POST['disc_desc'],
    ':disc_status' => $_POST['disc_status'],
    ':id'   => $_POST["employee_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }


?>